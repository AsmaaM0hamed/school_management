<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Promotion;
use App\Models\Backend\Student;
use App\Models\Backend\Classroom;
use App\Models\Backend\Section;
use App\Models\Backend\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::all();
        return view('backend.promotions.index', compact('promotions'));
    }

    public function create()
    {
        $students = Student::all();
        $classrooms = Classroom::all();
        $sections = Section::all();
        $grades = Grade::all();
        return view('backend.promotions.create', compact('students', 'classrooms', 'sections', 'grades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'from_class_id' => 'required',
            'to_class_id' => 'required',
            'from_section_id' => 'required',
            'to_section_id' => 'required',
            'from_grade_id' => 'required',
            'to_grade_id' => 'required',
            'promotion_date' => 'required|date',
        ]);

        $students = Student::where('grade_id', $request->from_grade_id)
        ->where('classroom_id', $request->from_class_id)
                            ->where('section_id', $request->from_section_id)
                            ->get();

        $promotionData = [];

        foreach ($students as $student) {
            $promotionData[] = [
                'student_id' => $student->id,
                'from_class_id' => $request->from_class_id,
                'to_class_id' => $request->to_class_id,
                'from_section_id' => $request->from_section_id,
                'to_section_id' => $request->to_section_id,
                'from_grade_id' => $request->from_grade_id,
                'to_grade_id' => $request->to_grade_id,
                'promotion_date' => $request->promotion_date,
                'notes' => $request->notes,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            Promotion::insert($promotionData);

            // Update student's class and section
            $student->update([
                'grade_id' => $request->to_grade_id,
                'classroom_id' => $request->to_class_id,
                'section_id' => $request->to_section_id,
            ]);
        }

 

        return redirect()->route('backend.students.index')->with('success', __('messages.students_promoted_successfully'));
    }

    public function show($id)
    {
        // This method is not used, but required by ResourceController
        abort(404);
    }

    public function manage()
    {
        $promotions = Promotion::with(['student', 'fromClass', 'toClass', 'fromSection', 'toSection', 'fromGrade', 'toGrade'])
            ->select('promotions.*')
            ->join(DB::raw('(SELECT MAX(id) as max_id FROM promotions GROUP BY student_id) as latest_promotions'), 'promotions.id', '=', 'latest_promotions.max_id')
            ->get();
        return view('backend.promotions.manage', compact('promotions'));
    }

    public function revertPromotion($promotionId)
    {
        try {
            $promotion = Promotion::findOrFail($promotionId);
            $student = $promotion->student;

            if (!$student) {
                return back()->with('error', 'الطالب غير موجود');
            }

            // Revert student's class and section
            $student->update([
                'grade_id' => $promotion->from_grade_id,
                'classroom_id' => $promotion->from_class_id,
                'section_id' => $promotion->from_section_id,
            ]);

            // Delete the promotion record
            $promotion->delete();

            return back()->with('success', __('messages.promotion_reverted_successfully'));

        } catch (\Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء التراجع عن الترقية');
        }
    }

    public function bulkRevert(Request $request)
    {
        $promotionIds = $request->input('promotions', []);

        if (empty($promotionIds)) {
            return redirect()->route('backend.promotions.manage')->with('error', __('messages.no_promotions_selected'));
        }

        $promotions = Promotion::whereIn('id', $promotionIds)->get();

        foreach ($promotions as $promotion) {
            $student = $promotion->student;

            // Revert student's class and section
            $student->update([
                'grade_id' => $promotion->from_grade_id,
                'classroom_id' => $promotion->from_class_id,
                'section_id' => $promotion->from_section_id,
            ]);

            // Delete the promotion record
            $promotion->delete();
        }

        return redirect()->route('backend.promotions.manage')->with('success', __('messages.promotions_reverted_successfully'));
    }

    public function destroy($id)
    {
        $promotion = Promotion::findOrFail($id);
        $student = $promotion->student;

        // Revert student's class and section
        $student->update([
            'grade_id' => $promotion->from_grade_id,
            'classroom_id' => $promotion->from_class_id,
            'section_id' => $promotion->from_section_id,
        ]);

        // Delete the promotion record
        $promotion->delete();

        return redirect()->route('backend.students.index')->with('success', __('messages.promotion_deleted_successfully'));
    }
}
