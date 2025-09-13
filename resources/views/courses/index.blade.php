@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Courses</h2>
    <a href="{{ route('courses.create') }}" class="btn btn-primary">+ New Course</a>
</div>

@if($courses->count())
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Title</th>
            <th>Category</th>
            <th>Level</th>
            <th>Price</th>
            <th>Feature Video</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($courses as $course)
        <tr>
            <td>{{ $course->title }}</td>
            <td>{{ $course->category }}</td>
            <td>{{ $course->level }}</td>
            <td>${{ $course->price }}</td>
            <td>{{ $course->feature_video }}</td>
            <td>
                @if($course->feature_image)
                    <img src="{{ asset('storage/'.$course->feature_image) }}" width="80">
                @endif
            </td>
            <td>
                <a href="{{ route('courses.show', $course) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('courses.edit', $course) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('courses.destroy', $course) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $courses->links() }}

@else
<p>No courses found.</p>
@endif
@endsection
