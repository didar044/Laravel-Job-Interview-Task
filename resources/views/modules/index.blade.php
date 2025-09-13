@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modules</h1>
    <a href="{{ route('modules.create') }}" class="btn btn-primary mb-3">Add Module</a>
    <ul class="list-group">
        @foreach($modules as $module)
            <li class="list-group-item d-flex justify-content-between">
                <span>{{ $module->title }} (Course: {{ $module->course->title }})</span>
                <div>
                    <a href="{{ route('modules.edit', $module) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('modules.destroy', $module) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>
@endsection
