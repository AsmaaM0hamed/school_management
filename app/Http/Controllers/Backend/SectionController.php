<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BackEnd\Classroom;
use App\Models\BackEnd\Grade;
use App\Models\BackEnd\Section;
use App\Models\BackEnd\Teacher;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $grades = Grade::with(['sections' => function($query) {
            $query->with(['classroom']);
        }])->where('is_active', true)->get();
        return view('backend.sections.index', compact('grades'));
    }

    public function create()
    {
        $teachers = Teacher::where('status', 1)
                         ->with('specialization')
                         ->get();
        $grades = Grade::all();
        
        return view('backend.sections.create', compact('grades', 'teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'grade_id' => 'required|exists:grades,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'teacher_ids' => 'required|array',
            'teacher_ids.*' => 'exists:teachers,id'
        ]);

        $section = Section::create($request->except('teacher_ids'));
        $section->teachers()->attach($request->teacher_ids);
        
        return redirect()->route('sections.index')->with('success', __('messages.added_successfully'));
    }

    public function edit(Section $section)
    {
        $grades = Grade::all();
        $classrooms = Classroom::where('grade_id', $section->grade_id)->get();
        $teachers = Teacher::where('status', 1)
                         ->with('specialization')
                         ->get();
        
        return view('backend.sections.edit', compact('section', 'grades', 'classrooms', 'teachers'));
    }

    public function update(Request $request, Section $section)
    {
        $request->validate([
            'name' => 'required',
            'grade_id' => 'required|exists:grades,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'teacher_ids' => 'required|array',
            'teacher_ids.*' => 'exists:teachers,id'
        ]);

        $section->update($request->except('teacher_ids'));
        $section->teachers()->sync($request->teacher_ids);
        
        return redirect()->route('sections.index')->with('success', __('messages.updated_successfully'));
    }

    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('sections.index')->with('success', __('messages.deleted_successfully'));
    }

    public function getClassrooms($grade_id)
    {
        try {
            $classrooms = Classroom::where('grade_id', $grade_id)
                                 ->where('is_active', true)
                                 ->get(['id', 'name']);
            
            if ($classrooms->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => __('messages.no_classrooms_found')
                ]);
            }

            return response()->json([
                'status' => 'success',
                'data' => $classrooms
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => __('messages.error_occurred')
            ], 500);
        }
    }

    public function getSections($grade_id)
    {
        $sections = Section::where('grade_id', $grade_id)->get();
        return response()->json($sections);
    }
}
