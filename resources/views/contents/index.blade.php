@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Contents</h1>
    <a href="{{ route('contents.create') }}" class="btn btn-primary mb-3">Add Content</a>
    <ul class="list-group">
        @foreach($contents as $content)
            <li class="list-group-item d-flex justify-content-between">
                <span>{{ $content->title }} (Module: {{ $content->module->title }})</span>
                <div>
                    <a href="{{ route('contents.edit', $content) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('contents.destroy', $content) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>
@endsection
