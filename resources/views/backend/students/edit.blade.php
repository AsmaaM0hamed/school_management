@extends('backend.layouts.master')

@section('title', __('messages.edit_student'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('messages.edit_student') }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{ __('messages.student_name') }}</label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $student->name) }}" required>
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">{{ __('messages.student_email') }}</label>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $student->email) }}" required>
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">{{ __('messages.password') }}</label>
                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                                    <small class="text-muted">{{ __('messages.leave_blank_password') }}</small>
                                    @error('password')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="national_id">{{ __('messages.national_id') }}</label>
                                    <input type="text" name="national_id" id="national_id" class="form-control @error('national_id') is-invalid @enderror" value="{{ old('national_id', $student->national_id) }}" required>
                                    @error('national_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="birth_date">{{ __('messages.birth_date') }}</label>
                                    <input type="date" name="birth_date" id="birth_date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date', $student->birth_date) }}" required>
                                    @error('birth_date')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gender">{{ __('messages.gender') }}</label>
                                    <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror" required>
                                        <option value="male" {{ old('gender', $student->gender) == 'male' ? 'selected' : '' }}>{{ __('messages.male') }}</option>
                                        <option value="female" {{ old('gender', $student->gender) == 'female' ? 'selected' : '' }}>{{ __('messages.female') }}</option>
                                    </select>
                                    @error('gender')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="grade_id">{{ __('messages.grade') }}</label>
                                    <select name="grade_id" id="grade_id" class="form-control @error('grade_id') is-invalid @enderror" required>
                                        <option value="">{{ __('messages.select_grade') }}</option>
                                        @foreach($grades as $grade)
                                            <option value="{{ $grade->id }}" {{ old('grade_id', $student->grade_id) == $grade->id ? 'selected' : '' }}>
                                                {{ $grade->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('grade_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="classroom_id">{{ __('messages.classroom') }}</label>
                                    <select name="classroom_id" id="classroom_id" class="form-control @error('classroom_id') is-invalid @enderror" required>
                                        <option value="">{{ __('messages.select_classroom') }}</option>
                                        @foreach($classrooms as $classroom)
                                            <option value="{{ $classroom->id }}" {{ old('classroom_id', $student->classroom_id) == $classroom->id ? 'selected' : '' }}>
                                                {{ $classroom->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('classroom_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="section_id">{{ __('messages.section') }}</label>
                                    <select name="section_id" id="section_id" class="form-control @error('section_id') is-invalid @enderror" required>
                                        <option value="">{{ __('messages.select_section') }}</option>
                                        @foreach($sections as $section)
                                            <option value="{{ $section->id }}" {{ old('section_id', $student->section_id) == $section->id ? 'selected' : '' }}>
                                                {{ $section->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('section_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="parent_id">{{ __('messages.parent') }}</label>
                                    <select name="parent_id" id="parent_id" class="form-control @error('parent_id') is-invalid @enderror" required>
                                        <option value="">{{ __('messages.select_parent') }}</option>
                                        @foreach($parents as $parent)
                                            <option value="{{ $parent->id }}" {{ old('parent_id', $student->parent_id) == $parent->id ? 'selected' : '' }}>
                                                {{ $parent->father_name }} ({{ $parent->mother_name }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="academic_year">{{ __('messages.academic_year') }}</label>
                                    <input type="text" name="academic_year" id="academic_year" class="form-control @error('academic_year') is-invalid @enderror" value="{{ old('academic_year', $student->academic_year) }}" required>
                                    @error('academic_year')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">{{ __('messages.status') }}</label>
                                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                        <option value="active" {{ old('status', $student->status) == 'active' ? 'selected' : '' }}>{{ __('messages.active') }}</option>
                                        <option value="inactive" {{ old('status', $student->status) == 'inactive' ? 'selected' : '' }}>{{ __('messages.inactive') }}</option>
                                        <option value="graduated" {{ old('status', $student->status) == 'graduated' ? 'selected' : '' }}>{{ __('messages.graduated') }}</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="photo">{{ __('messages.photo') }}</label>
                                    <input type="file" name="photo" id="photo" class="form-control-file @error('photo') is-invalid @enderror">
                                    @if($student->photo)
                                        <div class="mt-2">
                                            <img src="{{ asset($student->photo) }}" alt="{{ $student->name }}" class="img-thumbnail" style="height: 100px;">
                                        </div>
                                    @endif
                                    @error('photo')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="notes">{{ __('messages.notes') }}</label>
                                    <textarea name="notes" id="notes" class="form-control @error('notes') is-invalid @enderror" rows="3">{{ old('notes', $student->notes) }}</textarea>
                                    @error('notes')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> {{ __('messages.save') }}
                            </button>
                            <a href="{{ route('students.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> {{ __('messages.cancel') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // تحديث الفصول عند تغيير الصف
    $('#grade_id').change(function() {
        var gradeId = $(this).val();
        if (gradeId) {
            $.ajax({
                url: '{{ url("students/get-classrooms") }}/' + gradeId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#classroom_id').empty().append('<option value="">{{ __("messages.select_classroom") }}</option>');
                    $('#section_id').empty().append('<option value="">{{ __("messages.select_section") }}</option>');
                    $.each(data, function(key, value) {
                        $('#classroom_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            });
        } else {
            $('#classroom_id').empty().append('<option value="">{{ __("messages.select_classroom") }}</option>');
            $('#section_id').empty().append('<option value="">{{ __("messages.select_section") }}</option>');
        }
    });

    // تحديث الأقسام عند تغيير الفصل
    $('#classroom_id').change(function() {
        var classroomId = $(this).val();
        if (classroomId) {
            $.ajax({
                url: '{{ url("students/get-sections") }}/' + classroomId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#section_id').empty().append('<option value="">{{ __("messages.select_section") }}</option>');
                    $.each(data, function(key, value) {
                        $('#section_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            });
        } else {
            $('#section_id').empty().append('<option value="">{{ __("messages.select_section") }}</option>');
        }
    });
});
</script>
@endpush
