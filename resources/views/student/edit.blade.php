@extends('layouts.app')
@section('title', 'Edit Student')
@section('content')
<h1>Edit Student</h1>

<form action="{{ route('students.update', $student->id) }}" method="POST">
    @csrf
    @method('PUT')
    @include('student._form')
    <button type="submit">Update Student</button>
</form>

<br>
<a href="{{ route('students.index') }}">Back to Students</a>
@endsection
