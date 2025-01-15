<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Specialization;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    public function index()
    {
        $specializations = Specialization::withCount('teachers')->get();
        return view('backend.specializations.index', compact('specializations'));
    }

    public function create()
    {
        return view('backend.specializations.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:specializations',
        ]);

        Specialization::create($validatedData);
        return redirect()->route('specializations.index')->with('success', __('messages.created'));
    }

    public function edit(Specialization $specialization)
    {
        return view('backend.specializations.edit', compact('specialization'));
    }

    public function update(Request $request, Specialization $specialization)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:specializations,name,'.$specialization->id,
        ]);

        $specialization->update($validatedData);
        return redirect()->route('specializations.index')->with('success', __('messages.updated'));
    }

    public function destroy(Specialization $specialization)
    {
        if($specialization->teachers()->count() > 0) {
            return redirect()->route('specializations.index')->with('error', __('messages.cannot_delete_related'));
        }
        
        $specialization->delete();
        return redirect()->route('specializations.index')->with('success', __('messages.deleted'));
    }
}
