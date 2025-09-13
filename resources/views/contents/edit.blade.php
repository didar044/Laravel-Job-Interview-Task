@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Content</h1>
    <form action="{{ route('contents.update', $content) }}" method="POST">
        @csrf @method('PUT')
        <select name="module_id" class="form-control mb-2">
            @foreach($modules as $module)
                <option value="{{ $module->id }}" {{ $content->module_id == $module->id ? 'selected' : '' }}>
                    {{ $module->title }}
                </option>
            @endforeach
        </select>
        <input type="text" name="title" value="{{ $content->title }}" class="form-control mb-2">
        <select name="type" class="form-control mb-2">
            <option value="text" {{ $content->type == 'text' ? 'selected' : '' }}>Text</option>
            <option value="video" {{ $content->type == 'video' ? 'selected' : '' }}>Video</option>
            <option value="file" {{ $content->type == 'file' ? 'selected' : '' }}>File</option>
        </select>
        <textarea name="body" class="form-control mb-2">{{ $content->body }}</textarea>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
