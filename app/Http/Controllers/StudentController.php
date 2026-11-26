<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\StoreStudentRequest;
use App\Http\Requests\Student\UpdateStudentRequest;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(): View
    {
        return view('student.list', [
            'students' => Student::all(),
        ]);
    }

    public function create(): View
    {
        return view('student.create');
    }

    public function store(StoreStudentRequest $request): RedirectResponse
    {
        $student = Student::create($request->validated());

        return redirect()
            ->route('students.show', $student)
            ->with('success', 'Student created successfully!');
    }

    public function show(Student $student): View
    {
        return view('student.detail', [
            'student' => $student,
        ]);
    }

    public function edit(Student $student): View
    {
        return view('student.edit', [
            'student' => $student,
        ]);
    }

    public function update(UpdateStudentRequest $request, Student $student): RedirectResponse
    {
        $student->update($request->validated());

        return redirect()
            ->route('students.show', $student)
            ->with('success', 'Student updated successfully!');
    }

    public function destroy(Student $student): RedirectResponse
    {
        $student->delete();

        return redirect()
            ->route('students.index')
            ->with('success', 'Student deleted successfully!');
    }
}
