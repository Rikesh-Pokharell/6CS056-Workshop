@extends('layouts.app')
@section('title', 'Create Course')
@section('content')
<h1>Create Course</h1>

<form action="{{ route('courses.store') }}" method="POST">
    @csrf
    @include('course._form')
    <button type="submit">Create Course</button>
</form>

<br>
<a href="{{ route('courses.index') }}">Back to Courses</a>
@endsection
