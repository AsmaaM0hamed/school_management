@extends('backend.layouts.master')

@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('title')
    {{ __('messages.add_teacher') }}
@endsection

@section('content')
<div class="content-wrapper" style="margin-left: 0;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('messages.add_teacher') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('messages.home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('teachers.index') }}">{{ __('messages.teachers') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('messages.add_teacher') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('messages.teacher_info') }}</h3>
                        </div>
                        <form action="{{ route('teachers.store') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">{{ __('messages.teacher_name') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                                                value="{{ old('name') }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">{{ __('messages.teacher_email') }} <span class="text-danger">*</span></label>
                                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" 
                                                value="{{ old('email') }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">{{ __('messages.teacher_phone') }} <span class="text-danger">*</span></label>
                                            <input type="tel" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" 
                                                value="{{ old('phone') }}" required>
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="joining_date">{{ __('messages.teacher_joining_date') }} <span class="text-danger">*</span></label>
                                            <input type="date" name="joining_date" id="joining_date" class="form-control @error('joining_date') is-invalid @enderror" 
                                                value="{{ old('joining_date') }}" required>
                                            @error('joining_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">{{ __('messages.teacher_address') }}</label>
                                            <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" 
                                                rows="1">{{ old('address') }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="gender">{{ __('messages.teacher_gender') }} <span class="text-danger">*</span></label>
                                            <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror" required>
                                                <option value="">{{ __('messages.select_gender') }}</option>
                                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>{{ __('messages.male') }}</option>
                                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>{{ __('messages.female') }}</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="specialization_id">{{ __('messages.teacher_specialization') }} <span class="text-danger">*</span></label>
                                            <select name="specialization_id" id="specialization_id" class="form-control select2 @error('specialization_id') is-invalid @enderror" required>
                                                <option value="">{{ __('messages.select_specialization') }}</option>
                                                @foreach($specializations as $specialization)
                                                    <option value="{{ $specialization->id }}" {{ old('specialization_id') == $specialization->id ? 'selected' : '' }}>
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
                                            <label for="grade_id">{{ __('messages.teacher_grade') }} <span class="text-danger">*</span></label>
                                            <select name="grade_id" id="grade_id" class="form-control select2 @error('grade_id') is-invalid @enderror" required>
                                                <option value="">{{ __('messages.select_grade') }}</option>
                                                @foreach($grades as $grade)
                                                    <option value="{{ $grade->id }}" {{ old('grade_id') == $grade->id ? 'selected' : '' }}>
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
                                            <label for="status">{{ __('messages.teacher_status') }} <span class="text-danger">*</span></label>
                                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                                <option value="">{{ __('messages.select_status') }}</option>
                                                @foreach($statusOptions as $value => $label)
                                                    <option value="{{ $value }}" {{ old('status') == $value ? 'selected' : '' }}>
                                                        {{ __('messages.' . $label) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> {{ __('messages.save') }}
                                </button>
                                <a href="{{ route('teachers.index') }}" class="btn btn-default">
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
                theme: 'bootstrap4',
                language: "{{ app()->getLocale() }}",
                dir: "{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}",
            });
        });
    </script>
@endsection
