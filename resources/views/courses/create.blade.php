@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Course</h2>
    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Course Info --}}
        <div class="card mb-4 p-3">
            <h4>Course Info</h4>

            <div class="mb-3">
                <label class="form-label">Course Title</label>
                <input type="text" name="title" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Feature Video (URL)</label>
                <input type="text" name="feature_video" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Level</label>
                <input type="text" name="level" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category" class="form-control">
                    <option value="">-- Select Category --</option>
                    <option value="Web Development">Web Development</option>
                    <option value="Data Science">Data Science</option>
                    <option value="Design">Design</option>
                    <option value="Business">Business</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Price ($)</label>
                <input type="number" step="0.01" name="price" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Course Summary</label>
                <textarea name="summary" id="summary" class="form-control" placeholder="Write course summary..."></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Feature Image</label>
                <input type="file" name="feature_image" class="form-control">
            </div>
        </div>

        {{-- Add Module button --}}
        <button type="button" class="btn btn-sm btn-primary mb-3" onclick="addModule()">+ Add Module</button>

        {{-- Modules list --}}
        <div id="modules-wrapper"></div>

        {{-- Save --}}
        <div class="d-flex mt-4 mb-4">
            <button type="submit" class="btn btn-success me-2">Save</button>
            <a href="{{ route('courses.index') }}" class="btn btn-danger">Cancel</a>
        </div>
    </form>
</div>


<script>
let moduleCount = 0;

// Add Module
function addModule() {
    let moduleIndex = moduleCount++;
    let moduleHtml = `
        <div class="card p-3 mb-3 module-item">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h5>Module ${moduleIndex + 1}</h5>
                <button type="button" class="btn btn-sm btn-danger delete-module d-none" onclick="deleteModule(this)">❌</button>
            </div>

            <div class="mb-2">
                <label class="form-label">Module Title</label>
                <input type="text" name="modules[${moduleIndex}][title]" class="form-control">
            </div>
            <div class="mb-2">
                <label class="form-label">Module Description</label>
                <textarea name="modules[${moduleIndex}][description]" class="form-control"></textarea>
            </div>

            <div class="contents-wrapper"></div>
            <button type="button" class="btn btn-sm btn-primary mt-2" onclick="addContent(this, ${moduleIndex})">+ Add Content</button>
        </div>`;

    let wrapper = document.getElementById('modules-wrapper');
    wrapper.insertAdjacentHTML('beforeend', moduleHtml);

    // Add at least one content inside this module
    let lastModule = wrapper.lastElementChild;
    let addBtn = lastModule.querySelector('.btn-primary');
    addContent(addBtn, moduleIndex);

    updateDeleteButtons();
}

// Add Content
function addContent(button, moduleIndex) {
    let wrapper = button.previousElementSibling;
    let contentCount = wrapper.children.length;
    let contentHtml = `
        <div class="border p-2 mb-2 content-item">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <strong>Content ${contentCount + 1}</strong>
                <button type="button" class="btn btn-sm btn-danger delete-content d-none" onclick="deleteContent(this)">❌</button>
            </div>
            <div class="mb-2">
                <label class="form-label">Content Title</label>
                <input type="text" name="modules[${moduleIndex}][contents][${contentCount}][title]" class="form-control">
            </div>
            <div class="mb-2">
                <label class="form-label">Content Body</label>
                <textarea name="modules[${moduleIndex}][contents][${contentCount}][body]" class="form-control"></textarea>
            </div>
        </div>`;
    wrapper.insertAdjacentHTML('beforeend', contentHtml);

    updateDeleteButtons();
}

// Delete Module
function deleteModule(button) {
    button.closest('.module-item').remove();
    updateDeleteButtons();
}

// Delete Content
function deleteContent(button) {
    button.closest('.content-item').remove();
    updateDeleteButtons();
}

// Show/Hide delete buttons
function updateDeleteButtons() {
    let modules = document.querySelectorAll('.module-item');

    modules.forEach((module, i) => {
        let moduleDeleteBtn = module.querySelector('.delete-module');

        if (i > 0) {
            moduleDeleteBtn.classList.remove('d-none');
        } else {
            moduleDeleteBtn.classList.add('d-none');
        }

        let contents = module.querySelectorAll('.content-item');
        contents.forEach((content, j) => {
            let contentBtn = content.querySelector('.delete-content');
            if (j > 0) {
                contentBtn.classList.remove('d-none');
            } else {
                contentBtn.classList.add('d-none');
            }
        });
    });
}

// Load initial module + content
window.onload = () => {
    addModule();
};
</script>
@endsection
