<?php

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use App\Http\Controllers\StudentController;
Route::get('/', function () {
    return view('welcome');
});

/* ---------------- STUDENTS ---------------- */

Route::get('/students', [StudentController::class, 'index'])
    ->name('students.index');

// must come BEFORE /students/{id}
Route::get('/students/create', [StudentController::class, 'create'])
    ->name('students.create');

Route::post('/students', [StudentController::class, 'store'])
    ->name('students.store');

Route::get('/students/{id}', [StudentController::class, 'show'])
    ->name('students.show');

Route::get('/students/{id}/edit', [StudentController::class, 'edit'])
    ->name('students.edit');

Route::put('/students/{id}', [StudentController::class, 'update'])
    ->name('students.update');

Route::delete('/students/{id}', [StudentController::class, 'destroy'])
    ->name('students.destroy');

/* ---------------- COURSES ---------------- */

Route::get('/courses', function () {
    $courses = Course::all();
    return view('course.list', ['courses' => $courses]);
})->name('courses.index');

Route::get('/courses/create', function () {
    return view('course.create');
})->name('courses.create');

Route::post('/courses', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
        'duration' => 'required|integer|min:1',
        'fee' => 'required|numeric|min:0',
        'difficulty' => ['required', Rule::in(['Easy', 'Medium', 'Hard'])],
        'is_active' => 'boolean',
    ]);

    $course = Course::create($validated);

    return redirect()->route('courses.index')
        ->with('success', "Course {$course->name} created successfully!");
})->name('courses.store');

Route::get('/courses/{id}', function ($id) {
    $course = Course::findOrFail($id);
    return view('course.detail', ['course' => $course]);
})->name('courses.show');

Route::get('/courses/{id}/edit', function ($id) {
    $course = Course::findOrFail($id);
    return view('course.edit', ['course' => $course]);
})->name('courses.edit');

Route::put('/courses/{id}', function (Request $request, $id) {
    $course = Course::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
        'duration' => 'required|integer|min:1',
        'fee' => 'required|numeric|min:0',
        'difficulty' => ['required', Rule::in(['Easy', 'Medium', 'Hard'])],
        'is_active' => 'boolean',
    ]);

    $course->update($validated);

    return redirect()->route('courses.show', $course->id)
        ->with('success', 'Course updated successfully!');
})->name('courses.update');

Route::delete('/courses/{id}', function ($id) {
    $course = Course::findOrFail($id);
    $course->delete();

    return redirect()->route('courses.index')
        ->with('success', 'Course deleted successfully!');
})->name('courses.destroy');
