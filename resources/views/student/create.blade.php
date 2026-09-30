@extends('layouts.app')
@section('title', 'Create Student')
@section('content')
<h1>Create Student</h1>

<form action="{{ route('students.store') }}" method="POST">
    @csrf
    @include('student._form')
    <button type="submit">Create Student</button>
</form>

<br>
<a href="{{ route('students.index') }}">Back to Students</a>
@endsection
