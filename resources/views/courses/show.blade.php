@extends('layouts.app')

@section('content')
<h2>{{ $course->title }}</h2>
<p><strong>Category:</strong> {{ $course->category }}</p>
<p><strong>Level:</strong> {{ $course->level }}</p>
<p><strong>Price:</strong> ${{ $course->price }}</p>
<p><strong>Feature Video:</strong> {{ $course->feature_video }}</p>
<p><strong>Summary:</strong> {{ $course->summary }}</p>
@if($course->feature_image)
    <img src="{{ asset('storage/'.$course->feature_image) }}" width="300">
@endif
<a href="{{ route('courses.index') }}" class="btn btn-secondary mt-3">Back</a>
@endsection
