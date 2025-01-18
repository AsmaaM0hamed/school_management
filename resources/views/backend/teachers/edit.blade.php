@extends('backend.layouts.master')

@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
        .card-success:not(.card-outline) > .card-header {
            background-color: #28a745;
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
    </style>
@endsection

@section('title')
    {{ __('messages.edit_teacher') }}
@endsection

@section('page_name')
    {{ __('messages.edit_teacher') }}
@endsection

@section('content')
<div class="content-wrapper" style="margin-left: 0;">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('messages.teacher_info') }}</h3>
                        </div>
                        <form action="{{ route('teachers.update', $teacher->id) }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="row">
                                    <!-- Personal Information -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">{{ __('messages.teacher_name') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                                                value="{{ old('name', $teacher->name) }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">{{ __('messages.email') }} <span class="text-danger">*</span></label>
                                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" 
                                                value="{{ old('email', $teacher->email) }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">{{ __('messages.phone') }}</label>
                                            <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" 
                                                value="{{ old('phone', $teacher->phone) }}" dir="ltr">
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="gender">{{ __('messages.gender') }} <span class="text-danger">*</span></label>
                                            <select name="gender" id="gender" class="form-control select2 @error('gender') is-invalid @enderror" required>
                                                <option value="">{{ __('messages.select_gender') }}</option>
                                                <option value="male" {{ old('gender', $teacher->gender) == 'male' ? 'selected' : '' }}>{{ __('messages.male') }}</option>
                                                <option value="female" {{ old('gender', $teacher->gender) == 'female' ? 'selected' : '' }}>{{ __('messages.female') }}</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Academic Information -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="specialization_id">{{ __('messages.specialization') }} <span class="text-danger">*</span></label>
                                            <select name="specialization_id" id="specialization_id" class="form-control select2 @error('specialization_id') is-invalid @enderror" required>
                                                <option value="">{{ __('messages.select_specialization') }}</option>
                                                @foreach($specializations as $specialization)
                                                    <option value="{{ $specialization->id }}" {{ old('specialization_id', $teacher->specialization_id) == $specialization->id ? 'selected' : '' }}>
                                                        {{ $specialization->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('specialization_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="grade_id">{{ __('messages.grade') }} <span class="text-danger">*</span></label>
                                            <select name="grade_id" id="grade_id" class="form-control select2 @error('grade_id') is-invalid @enderror" required>
                                                <option value="">{{ __('messages.select_grade') }}</option>
                                                @foreach($grades as $grade)
                                                    <option value="{{ $grade->id }}" {{ old('grade_id', $teacher->grade_id) == $grade->id ? 'selected' : '' }}>
                                                        {{ $grade->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('grade_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="joining_date">{{ __('messages.joining_date') }} <span class="text-danger">*</span></label>
                                            <input type="date" name="joining_date" id="joining_date" class="form-control @error('joining_date') is-invalid @enderror" 
                                                value="{{ date('Y-m-d', strtotime($teacher->joining_date)) }}" required>
                                            @error('joining_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">{{ __('messages.address') }}</label>
                                            <textarea name="address" id="address" rows="1" class="form-control @error('address') is-invalid @enderror">{{ old('address', $teacher->address) }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status">{{ __('messages.status') }}</label>
                                            <select class="form-control" id="status" name="status" required>
                                                <option value="active" {{ old('status', $teacher->status) == 'active' ? 'selected' : '' }}>
                                                    {{ __('messages.active') }}
                                                </option>
                                                <option value="suspended" {{ old('status', $teacher->status) == 'suspended' ? 'selected' : '' }}>
                                                    {{ __('messages.suspended') }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> {{ __('messages.save') }}
                                </button>
                                <a href="{{ route('teachers.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> {{ __('messages.cancel') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2({
                theme: 'bootstrap4'
            });
        });
    </script>
@endsection
