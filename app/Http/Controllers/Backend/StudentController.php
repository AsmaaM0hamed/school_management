<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Grade;
use App\Models\Backend\Classroom;
use App\Models\Backend\Section;
use App\Models\Backend\Student;
use App\Models\Backend\ParentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with(['grade', 'classroom', 'section', 'parent'])->latest()->get();
        return view('backend.students.index', compact('students'));
    }

    public function create()
    {
        $grades = Grade::where('is_active', true)->get();
        $classrooms = [];
        $sections = [];
        $parents = ParentModel::where('status', 1)->get();
        return view('backend.students.create', compact('grades', 'classrooms', 'sections', 'parents'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:students,email',
                'password' => 'required|string|min:6',
                'birth_date' => 'required|date',
                'gender' => 'required|in:male,female',
                'national_id' => 'required|string|unique:students,national_id',
                'grade_id' => 'required|exists:grades,id',
                'classroom_id' => 'required|exists:classrooms,id',
                'section_id' => 'required|exists:sections,id',
                'academic_year' => 'required|string',
                'parent_id' => 'required|exists:parents,id',
                'status' => 'nullable|in:active,inactive,graduated',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $data = $request->all();
            
            $data['password'] = bcrypt($request->password);
      
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $filename = time() . '_' . str_replace(' ', '_', $photo->getClientOriginalName());
                
             
                if (!file_exists(public_path('uploads/students'))) {
                    mkdir(public_path('uploads/students'), 0777, true);
                }
                
        
                $photo->move(public_path('uploads/students'), $filename);
                $data['photo'] = 'uploads/students/' . $filename;
            }

            if (!isset($data['status'])) {
                $data['status'] = 'active';
            }

            Student::create($data);

            return redirect()
                ->route('students.index')
                ->with('success', __('messages.student_added_successfully'));

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()
                ->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', __('messages.error_occurred'))
                ->withInput();
        }
    }

    public function edit(Student $student)
    {
        $grades = Grade::all();
        $classrooms = Classroom::where('grade_id', $student->grade_id)->get();
        $sections = Section::where('classroom_id', $student->classroom_id)->get();
        $parents = ParentModel::all();

        return view('backend.students.edit', compact('student', 'grades', 'classrooms', 'sections', 'parents'));
    }

    public function update(Request $request, Student $student)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:students,email,' . $student->id,
                'password' => 'nullable|min:6',
                'national_id' => 'required|string|max:255|unique:students,national_id,' . $student->id,
                'birth_date' => 'required|date',
                'gender' => 'required|in:male,female',
                'grade_id' => 'required|exists:grades,id',
                'classroom_id' => 'required|exists:classrooms,id',
                'section_id' => 'required|exists:sections,id',
                'parent_id' => 'required|exists:parents,id',
                'academic_year' => 'required|string|max:255',
                'status' => 'required|in:active,inactive,graduated',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'notes' => 'nullable|string',
            ]);

        
            if ($request->filled('password')) {
                $data['password'] = bcrypt($request->password);
            } else {
                unset($data['password']);
            }

    
            if ($request->hasFile('photo')) {
        
                if ($student->photo && file_exists(public_path($student->photo))) {
                    unlink(public_path($student->photo));
                }

                $photo = $request->file('photo');
                $filename = time() . '_' . str_replace(' ', '_', $photo->getClientOriginalName());
                
             
                if (!file_exists(public_path('uploads/students'))) {
                    mkdir(public_path('uploads/students'), 0777, true);
                }
                
       
                if ($photo->move(public_path('uploads/students'), $filename)) {
                    $data['photo'] = 'uploads/students/' . $filename;
                } else {
                    throw new \Exception(__('messages.error_uploading_photo'));
                }
            }

            if ($student->update($data)) {
                return redirect()
                    ->route('students.index')
                    ->with('success', __('messages.student_updated_successfully'));
            } else {
                throw new \Exception(__('messages.error_while_updating_student'));
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()
                ->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', __('messages.validation_error'));
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function destroy(Student $student)
    {
        try {
        
            if ($student->photo && file_exists(public_path($student->photo))) {
                unlink(public_path($student->photo));
            }
            
   
            if ($student->delete()) {
                return redirect()
                    ->route('students.index')
                    ->with('success', __('messages.student_deleted_successfully'));
            } else {
                throw new \Exception(__('messages.error_while_deleting_student'));
            }
        } catch (\Exception $e) {
            return redirect()
                ->route('students.index')
                ->with('error', __('messages.error_while_deleting_student'));
        }
    }

    public function show(Student $student)
    {
        return view('backend.students.show', compact('student'));
    }


    public function getClassrooms($gradeId)
    {
        $classrooms = Classroom::where('grade_id', $gradeId)
            ->where('is_active', true)
            ->get();
        return response()->json($classrooms);
    }

  
    public function getSections($classroomId)
    {
        $sections = Section::where('classroom_id', $classroomId)
            ->where('status', true)
            ->get();
        return response()->json($sections);
    }
}
