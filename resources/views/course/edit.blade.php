@extends('layouts.app')
@section('title', 'Edit Course')
@section('content')
<h1>Edit Course</h1>

<form action="{{ route('courses.update', $course->id) }}" method="POST">
    @csrf
    @method('PUT')
    @include('course._form')
    <button type="submit">Update Course</button>
</form>

<br>
<a href="{{ route('courses.index') }}">Back to Courses</a>
@endsection
