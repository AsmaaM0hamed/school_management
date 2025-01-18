<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Teacher;
use App\Models\Backend\Specialization;
use App\Models\Backend\Grade;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $grades = Grade::with(['teachers' => function($query) {
            $query->with(['specialization', 'grade']);
        }])->get();
        return view('backend.teachers.index', compact('grades'));
    }

    public function create()
    {
        $specializations = Specialization::all();
        $grades = Grade::all();
        $statusOptions = Teacher::getStatusOptions();
        return view('backend.teachers.create', compact('specializations', 'grades', 'statusOptions'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers',
            'phone' => 'nullable|string|max:20',
            'specialization_id' => 'required|exists:specializations,id',
            'grade_id' => 'required|exists:grades,id',
            'joining_date' => 'required|date',
            'address' => 'nullable|string',
            'gender' => 'required|in:male,female',
            'status' => 'required|in:active,suspended'
        ]);

        $validatedData['status'] = $validatedData['status'] ?? Teacher::STATUS_ACTIVE;

        Teacher::create($validatedData);
        return redirect()->route('teachers.index')->with('success', __('messages.created'));
    }

    public function edit(Teacher $teacher)
    {
        $specializations = Specialization::all();
        $grades = Grade::all();
        return view('backend.teachers.edit', compact('teacher', 'specializations', 'grades'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email,'.$teacher->id,
            'phone' => 'nullable|string|max:20',
            'specialization_id' => 'required|exists:specializations,id',
            'grade_id' => 'required|exists:grades,id',
            'joining_date' => 'required|date',
            'address' => 'nullable|string',
            'gender' => 'required|in:male,female',
            'status' => 'required|in:active,suspended'
        ]);

        $teacher->update($validatedData);
        return redirect()->route('teachers.index')->with('success', __('messages.updated'));
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('teachers.index')->with('success', __('messages.deleted'));
    }
}
