@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Content</h1>
    <form action="{{ route('contents.store') }}" method="POST">
        @csrf
        <select name="module_id" class="form-control mb-2">
            <option value="">Select Module</option>
            @foreach($modules as $module)
                <option value="{{ $module->id }}">{{ $module->title }}</option>
            @endforeach
        </select>
        <input type="text" name="title" placeholder="Content Title" class="form-control mb-2">
        <select name="type" class="form-control mb-2">
            <option value="text">Text</option>
            <option value="video">Video</option>
            <option value="file">File</option>
        </select>
        <textarea name="body" placeholder="Content Body" class="form-control mb-2"></textarea>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection
