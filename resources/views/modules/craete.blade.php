@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Module</h1>
    <form action="{{ route('modules.store') }}" method="POST">
        @csrf
        <select name="course_id" class="form-control mb-2">
            <option value="">Select Course</option>
            @foreach($courses as $course)
                <option value="{{ $course->id }}">{{ $course->title }}</option>
            @endforeach
        </select>
        <input type="text" name="title" placeholder="Module Title" class="form-control mb-2">
        <textarea name="description" placeholder="Module Description" class="form-control mb-2"></textarea>
        <input type="number" name="order" placeholder="Order" class="form-control mb-2">
        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection
