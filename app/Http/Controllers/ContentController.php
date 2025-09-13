<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Module;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index()
    {
        $contents = Content::with('module')->get();
        return view('contents.index', compact('contents'));
    }

    public function create()
    {
        $modules = Module::all();
        return view('contents.create', compact('modules'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'module_id' => 'required|exists:modules,id',
            'title' => 'required|string|max:255',
            'type' => 'required|in:text,video,file',
            'body' => 'nullable|string',
        ]);

        Content::create($data);
        return redirect()->route('contents.index')->with('success', 'Content created!');
    }

    public function edit(Content $content)
    {
        $modules = Module::all();
        return view('contents.edit', compact('content', 'modules'));
    }

    public function update(Request $request, Content $content)
    {
        $data = $request->validate([
            'module_id' => 'required|exists:modules,id',
            'title' => 'required|string|max:255',
            'type' => 'required|in:text,video,file',
            'body' => 'nullable|string',
        ]);

        $content->update($data);
        return redirect()->route('contents.index')->with('success', 'Content updated!');
    }

    public function destroy(Content $content)
    {
        $content->delete();
        return redirect()->route('contents.index')->with('success', 'Content deleted!');
    }
}
