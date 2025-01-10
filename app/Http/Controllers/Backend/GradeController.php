<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Grade;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GradeController extends Controller
{

    public function index()
    {
        $grades = Grade::all();
        return view('backend.grades.index', compact('grades'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => [
                    'required',
                    Rule::unique('grades')->whereNull('deleted_at'),
                ],
                'code' => [
                    'required',
                    Rule::unique('grades')->whereNull('deleted_at'),
                ],
                'description' => 'nullable'
            ]);

            Grade::create($validated);

            return redirect()->route('grades.index')
                ->with('success', __('messages.grade_created_successfully'));
        } catch (\Exception $e) {
            return redirect()->route('grades.index')
                ->with('error', __('messages.grade_create_error'));
        }
    }

    public function update(Request $request, Grade $grade)
    {
        try {
            $validated = $request->validate([
                'name' => [
                    'required',
                    Rule::unique('grades')->ignore($grade->id)->whereNull('deleted_at'),
                ],
                'code' => [
                    'required',
                    Rule::unique('grades')->ignore($grade->id)->whereNull('deleted_at'),
                ],
                'description' => 'nullable',
                'is_active' => 'boolean'
            ]);

            $validated['is_active'] = $request->has('is_active');
            
            $grade->update($validated);

            return redirect()->route('grades.index')
                ->with('success', __('messages.grade_updated_successfully'));
        } catch (\Exception $e) {
            return redirect()->route('grades.index')
                ->with('error', __('messages.grade_update_error'));
        }
    }
 
    public function destroy(Grade $grade)
    {
        try {
            $grade->delete();
            return redirect()->route('grades.index')
                ->with('success', __('messages.grade_deleted_successfully'));
        } catch (\Exception $e) {
            return redirect()->route('grades.index')
                ->with('error', __('messages.grade_delete_error'));
        }
    }
}
