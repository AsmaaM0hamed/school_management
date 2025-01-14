<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BackEnd\Classroom;
use App\Models\BackEnd\Grade;
use App\Models\BackEnd\Section;
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
        $grades = Grade::all();
        return view('backend.sections.create', compact('grades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'grade_id' => 'required|exists:grades,id',
            'classroom_id' => 'required|exists:classrooms,id',
        ]);

        Section::create($request->all());
        return redirect()->route('sections.index')->with('success', __('messages.added_successfully'));
    }

    public function edit(Section $section)
    {
        $grades = Grade::all();
        $classrooms = Classroom::where('grade_id', $section->grade_id)->get();
        return view('backend.sections.edit', compact('section', 'grades', 'classrooms'));
    }

    public function update(Request $request, Section $section)
    {
        $request->validate([
            'name' => 'required',
            'grade_id' => 'required|exists:grades,id',
            'classroom_id' => 'required|exists:classrooms,id',
        ]);

        $section->update($request->all());
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
