@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Module</h1>
    <form action="{{ route('modules.update', $module) }}" method="POST">
        @csrf @method('PUT')
        <select name="course_id" class="form-control mb-2">
            @foreach($courses as $course)
                <option value="{{ $course->id }}" {{ $module->course_id == $course->id ? 'selected' : '' }}>
                    {{ $course->title }}
                </option>
            @endforeach
        </select>
        <input type="text" name="title" value="{{ $module->title }}" class="form-control mb-2">
        <textarea name="description" class="form-control mb-2">{{ $module->description }}</textarea>
        <input type="number" name="order" value="{{ $module->order }}" class="form-control mb-2">
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
