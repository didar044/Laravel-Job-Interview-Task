<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Course;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::with('course')->get();
        return view('modules.index', compact('modules'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('modules.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        Module::create($data);
        return redirect()->route('modules.index')->with('success', 'Module created!');
    }

    public function edit(Module $module)
    {
        $courses = Course::all();
        return view('modules.edit', compact('module', 'courses'));
    }

    public function update(Request $request, Module $module)
    {
        $data = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        $module->update($data);
        return redirect()->route('modules.index')->with('success', 'Module updated!');
    }

    public function destroy(Module $module)
    {
        $module->delete();
        return redirect()->route('modules.index')->with('success', 'Module deleted!');
    }
}

