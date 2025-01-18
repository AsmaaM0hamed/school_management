<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BackEnd\ParentModel;
use App\Models\BackEnd\Nationality;
use App\Models\BackEnd\BloodType;
use App\Models\BackEnd\Religion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ParentController extends Controller
{
    public function index()
    {
        $parents = ParentModel::all();
        return view('backend.parents.index', compact('parents'));
    }

    public function create()
    {
        $nationalities = Nationality::all();
        $bloodTypes = BloodType::all();
        $religions = Religion::all();
        return view('backend.parents.create', compact('nationalities', 'bloodTypes', 'religions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:parents,email',
            'password' => 'required|min:6',
            'father_name' => 'required|string|max:255',
            'father_national_id' => 'required|string|unique:parents,father_national_id',
            'father_passport_id' => 'nullable|string',
            'father_phone' => 'required|string',
            'father_job' => 'required|string|max:255',
            'father_nationality_id' => 'required|exists:nationalities,id',
            'father_blood_type_id' => 'required|exists:blood_types,id',
            'father_religion_id' => 'required|exists:religions,id',
            'father_address' => 'required|string',
            'mother_name' => 'required|string|max:255',
            'mother_national_id' => 'required|string|unique:parents,mother_national_id',
            'mother_passport_id' => 'nullable|string',
            'mother_phone' => 'required|string',
            'mother_job' => 'required|string|max:255',
            'mother_nationality_id' => 'required|exists:nationalities,id',
            'mother_blood_type_id' => 'required|exists:blood_types,id',
            'mother_religion_id' => 'required|exists:religions,id',
            'mother_address' => 'required|string'
        ]);

        $validated['password'] = Hash::make($validated['password']);

        ParentModel::create($validated);

        return redirect()->route('parents.index')
            ->with('success', __('messages.parent_created_successfully'));
    }

    public function edit($id)
    {
        try {
            $data = [
                'parent' => ParentModel::findOrFail($id),
                'nationalities' => Nationality::all(),
                'bloodTypes' => BloodType::all(),
                'religions' => Religion::all(),
                'title' => __('messages.edit_parent_info')
            ];
            return view('backend.parents.edit', $data);
        } catch (\Exception $e) {
            return redirect()->route('parents.index')
                ->with('error', __('messages.parent_not_found'));
        }
    }

    public function update(Request $request, $id)
    {
        $parent = ParentModel::findOrFail($id);

        $rules = [
            'email' => 'required|email|unique:parents,email,' . $id,
            'password' => 'nullable|min:6',
            'father_name' => 'required|string|min:3|max:255',
            'father_national_id' => 'required|string|min:10|max:20|unique:parents,father_national_id,' . $id,
            'father_passport_id' => 'nullable|string|min:10|max:20',
            'father_phone' => 'required|string|min:10|max:20',
            'father_job' => 'required|string|max:255',
            'father_nationality_id' => 'required|exists:nationalities,id',
            'father_blood_type_id' => 'required|exists:blood_types,id',
            'father_religion_id' => 'required|exists:religions,id',
            'father_address' => 'required|string',
            'mother_name' => 'required|string|min:3|max:255',
            'mother_national_id' => 'required|string|min:10|max:20|unique:parents,mother_national_id,' . $id,
            'mother_passport_id' => 'nullable|string|min:10|max:20',
            'mother_phone' => 'required|string|min:10|max:20',
            'mother_job' => 'required|string|max:255',
            'mother_nationality_id' => 'required|exists:nationalities,id',
            'mother_blood_type_id' => 'required|exists:blood_types,id',
            'mother_religion_id' => 'required|exists:religions,id',
            'mother_address' => 'required|string',
        ];

        $validatedData = $request->validate($rules);

        if ($request->filled('password')) {
            $validatedData['password'] = bcrypt($request->password);
        } else {
            unset($validatedData['password']);
        }

        $parent->update($validatedData);

        return redirect()->route('parents.index')
            ->with('success', __('messages.parent_updated_successfully'));
    }

    public function show(ParentModel $parent)
    {
        return view('backend.parents.show', compact('parent'));
    }

    public function destroy(ParentModel $parent)
    {
        $parent->delete();
        return redirect()->route('parents.index')
            ->with('success', __('messages.parent_deleted_successfully'));
    }
}
