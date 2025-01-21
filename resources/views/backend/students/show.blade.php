@extends('backend.layouts.master')

@section('title')
    {{ __('messages.student_details') }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('messages.student_details') }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> {{ __('messages.edit') }}
                        </a>
                        <a href="{{ route('students.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-list"></i> {{ __('messages.back') }}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center mb-4">
                            @if($student->photo && file_exists(public_path($student->photo)))
                                <img src="{{ asset($student->photo) }}" 
                                     alt="{{ $student->name }}" 
                                     class="img-fluid rounded shadow" 
                                     style="max-height: 200px;">
                            @else
                                <div class="img-thumbnail d-flex align-items-center justify-content-center mx-auto" 
                                     style="width: 200px; height: 200px; background-color: #f8f9fa;">
                                    <i class="fas fa-user-graduate text-secondary" style="font-size: 5rem;"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 200px;">{{ __('messages.student_name') }}</th>
                                    <td>{{ $student->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('messages.student_email') }}</th>
                                    <td>{{ $student->email }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('messages.birth_date') }}</th>
                                    <td>{{ $student->birth_date }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('messages.gender') }}</th>
                                    <td>{{ __('messages.' . $student->gender) }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('messages.national_id') }}</th>
                                    <td>{{ $student->national_id }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('messages.grade') }}</th>
                                    <td>{{ $student->grade->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('messages.classroom') }}</th>
                                    <td>{{ $student->classroom->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('messages.section') }}</th>
                                    <td>{{ $student->section->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('messages.academic_year') }}</th>
                                    <td>{{ $student->academic_year }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('messages.parent') }}</th>
                                    <td>
                                        <a href="{{ route('parents.show', $student->parent_id) }}">
                                            {{ $student->parent->father_name }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('messages.status') }}</th>
                                    <td>
                                        @if($student->status == 'active')
                                            <span class="badge badge-success">{{ __('messages.active') }}</span>
                                        @elseif($student->status == 'inactive')
                                            <span class="badge badge-danger">{{ __('messages.inactive') }}</span>
                                        @else
                                            <span class="badge badge-info">{{ __('messages.graduated') }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @if($student->notes)
                                <tr>
                                    <th>{{ __('messages.notes') }}</th>
                                    <td>{{ $student->notes }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <th>{{ __('messages.created_at') }}</th>
                                    <td>{{ $student->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('messages.updated_at') }}</th>
                                    <td>{{ $student->updated_at->format('Y-m-d H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
