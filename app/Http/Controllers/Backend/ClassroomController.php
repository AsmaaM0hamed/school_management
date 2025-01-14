<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BackEnd\Classroom;
use App\Models\BackEnd\Grade;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClassroomController extends Controller
{
    public function index()
    {
        $classrooms = Classroom::with('grade')->get();
        $grades = Grade::where('is_active', true)->get();
        return view('backend.classrooms.index', compact('classrooms', 'grades'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => [
                    'required',
                    Rule::unique('classrooms')->whereNull('deleted_at'),
                ],
                'grade_id' => [
                    'required',
                    'exists:grades,id'
                ],
                'capacity' => [
                    'required',
                    'integer',
                    'min:1'
                ],
                'description' => 'nullable'
            ]);

            $validated['is_active'] = $request->has('is_active');
            
            Classroom::create($validated);

            return redirect()->route('classrooms.index')
                ->with('success', __('messages.classroom_created'));
        } catch (\Exception $e) {
            return redirect()->route('classrooms.index')
                ->with('error', __('messages.error_while_creating_classroom'));
        }
    }

    public function update(Request $request, Classroom $classroom)
    {
        try {
            $validated = $request->validate([
                'name' => [
                    'required',
                    Rule::unique('classrooms')->ignore($classroom->id)->whereNull('deleted_at'),
                ],
                'grade_id' => [
                    'required',
                    'exists:grades,id'
                ],
                'capacity' => [
                    'required',
                    'integer',
                    'min:1'
                ],
                'description' => 'nullable'
            ]);

            $validated['is_active'] = $request->has('is_active');
            
            $classroom->update($validated);

            return redirect()->route('classrooms.index')
                ->with('success', __('messages.classroom_updated'));
        } catch (\Exception $e) {
            return redirect()->route('classrooms.index')
                ->with('error', __('messages.error_while_updating_classroom'));
        }
    }

    public function destroy(Classroom $classroom)
    {
        try {
            $classroom->delete();
            return redirect()->route('classrooms.index')
                ->with('success', __('messages.classroom_deleted'));
        } catch (\Exception $e) {
            return redirect()->route('classrooms.index')
                ->with('error', __('messages.error_while_deleting_classroom'));
        }
    }
}
