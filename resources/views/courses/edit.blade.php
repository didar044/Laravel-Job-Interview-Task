@extends('layouts.app')

@section('content')
<h2>Edit Course</h2>
<form action="{{ route('courses.update', $course) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Course Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $course->title) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Feature Video</label>
        <input type="text" name="feature_video" class="form-control" value="{{ old('feature_video', $course->feature_video) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Level</label>
        <input type="text" name="level" class="form-control" value="{{ old('level', $course->level) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Category</label>
        <input type="text" name="category" class="form-control" value="{{ old('category', $course->category) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Course Price</label>
        <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $course->price) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Summary</label>
        <textarea name="summary" class="form-control">{{ old('summary', $course->summary) }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Feature Image</label>
        <input type="file" name="feature_image" class="form-control">
        @if($course->feature_image)
            <img src="{{ asset('storage/'.$course->feature_image) }}" width="120" class="mt-2">
        @endif
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
