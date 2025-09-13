<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Module;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->paginate(10);
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'title'         => 'required|string|max:255',
        'feature_video' => 'nullable|string|max:255',
        'level'         => 'nullable|string|max:100',
        'category'      => 'required|in:Web Development,Data Science,Design,Business',
        'price'         => 'required|numeric|min:0',
        'summary'       => 'nullable|string',
        'feature_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'modules'       => 'array',
        'modules.*.title'       => 'required|string|max:255',
        'modules.*.description' => 'nullable|string',
        'modules.*.contents'    => 'array',
        'modules.*.contents.*.title' => 'required|string|max:255',
        'modules.*.contents.*.body'  => 'nullable|string',
    ]);

    if ($request->hasFile('feature_image')) {
        $validated['feature_image'] = $request->file('feature_image')->store('courses', 'public');
    }

    $course = Course::create($validated);

    if (!empty($request->modules)) {
        foreach ($request->modules as $moduleData) {
            $module = $course->modules()->create([
                'title' => $moduleData['title'],
                'description' => $moduleData['description'] ?? null,
            ]);

            if (!empty($moduleData['contents'])) {
                foreach ($moduleData['contents'] as $contentData) {
                    $module->contents()->create([
                        'title' => $contentData['title'],
                        'body'  => $contentData['body'] ?? null,
                    ]);
                }
            }
        }
    }

    return redirect()->route('courses.index')->with('success', 'Course created successfully!');
}


    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

public function update(Request $request, Course $course)
{
    $validated = $request->validate([
        'title'         => 'required|string|max:255',
        'feature_video' => 'nullable|string|max:255',
        'level'         => 'nullable|string|max:100',
        'category'      => 'required|in:Web Development,Data Science,Design,Business',
        'price'         => 'required|numeric|min:0',
        'summary'       => 'nullable|string',
        'feature_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        'modules' => 'array',
        'modules.*.id'          => 'nullable|exists:modules,id',
        'modules.*.title'       => 'required|string|max:255',
        'modules.*.description' => 'nullable|string',

        'modules.*.contents' => 'array',
        'modules.*.contents.*.id'    => 'nullable|exists:contents,id',
        'modules.*.contents.*.title' => 'required|string|max:255',
        'modules.*.contents.*.body'  => 'nullable|string',
    ]);

    // handle feature image update
    if ($request->hasFile('feature_image')) {
        if ($course->feature_image && \Storage::disk('public')->exists($course->feature_image)) {
            \Storage::disk('public')->delete($course->feature_image);
        }
        $validated['feature_image'] = $request->file('feature_image')->store('courses', 'public');
    }

    $course->update($validated);

    $existingModuleIds = $course->modules()->pluck('id')->toArray();
    $newModuleIds = [];

    if (!empty($request->modules)) {
        foreach ($request->modules as $moduleData) {
            if (!empty($moduleData['id'])) {
                $module = Module::find($moduleData['id']);
                $module->update([
                    'title'       => $moduleData['title'],
                    'description' => $moduleData['description'] ?? null,
                ]);
            } else {
                $module = $course->modules()->create([
                    'title'       => $moduleData['title'],
                    'description' => $moduleData['description'] ?? null,
                ]);
            }

            $newModuleIds[] = $module->id;

            $existingContentIds = $module->contents()->pluck('id')->toArray();
            $newContentIds = [];

            if (!empty($moduleData['contents'])) {
                foreach ($moduleData['contents'] as $contentData) {
                    if (!empty($contentData['id'])) {
                        $content = Content::find($contentData['id']);
                        $content->update([
                            'title' => $contentData['title'],
                            'body'  => $contentData['body'] ?? null,
                        ]);
                    } else {
                        $content = $module->contents()->create([
                            'title' => $contentData['title'],
                            'body'  => $contentData['body'] ?? null,
                        ]);
                    }

                    $newContentIds[] = $content->id;
                }
            }

            $toDeleteContents = array_diff($existingContentIds, $newContentIds);
            Content::destroy($toDeleteContents);
        }
    }

    $toDeleteModules = array_diff($existingModuleIds, $newModuleIds);
    Module::destroy($toDeleteModules);

    return redirect()->route('courses.index')->with('success', 'Course updated successfully!');
}


    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully!');
    }
}
