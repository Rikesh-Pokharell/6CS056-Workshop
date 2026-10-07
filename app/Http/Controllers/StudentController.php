<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();

        return view('student.list', [
            'students' => $students,
        ]);
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);

        return view('student.detail', [
            'student' => $student,
        ]);
    }
    public function create()
    {
        return view('student.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:students,email',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:500',
            'date_of_birth' => 'nullable|date',
        ]);

        $student = Student::create($validated);

        return redirect()->route('students.index')
            ->with('success', "Student {$student->name} created successfully!");
    }//
}
