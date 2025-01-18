@extends('backend.layouts.master')

@section('title')
    {{ __('messages.edit_section') }}
@endsection

@section('css')
    <style>
        .teachers-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 15px;
            padding: 15px;
        }
        .checkbox-wrapper {
            display: flex;
            align-items: center;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .checkbox-wrapper input[type="checkbox"] {
            margin-right: 10px;
            width: 18px;
            height: 18px;
        }
        .checkbox-wrapper label {
            margin-bottom: 0;
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
<div class="content-wrapper" style="margin-left: 0;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('messages.edit_section') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('messages.home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('sections.index') }}">{{ __('messages.sections') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('messages.edit_section') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('sections.update', $section->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('messages.name') }}</label>
                                            <input type="text" name="name" value="{{ old('name', $section->name) }}" class="form-control @error('name') is-invalid @enderror" required>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('messages.grade') }}</label>
                                            <select name="grade_id" class="form-control @error('grade_id') is-invalid @enderror" id="grade_select" required>
                                                <option value="">{{ __('messages.choose_grade') }}</option>
                                                @foreach($grades as $grade)
                                                    <option value="{{ $grade->id }}" {{ old('grade_id', $section->grade_id) == $grade->id ? 'selected' : '' }}>
                                                        {{ $grade->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('grade_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('messages.classroom') }}</label>
                                            <select name="classroom_id" class="form-control @error('classroom_id') is-invalid @enderror" id="classroom_select" required>
                                                <option value="">{{ __('messages.choose_classroom') }}</option>
                                                @foreach($classrooms as $classroom)
                                                    <option value="{{ $classroom->id }}" {{ old('classroom_id', $section->classroom_id) == $classroom->id ? 'selected' : '' }}>
                                                        {{ $classroom->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('classroom_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('messages.status') }}</label>
                                            <select name="status" class="form-control @error('status') is-invalid @enderror">
                                                <option value="1" {{ old('status', $section->status) == '1' ? 'selected' : '' }}>{{ __('messages.active') }}</option>
                                                <option value="0" {{ old('status', $section->status) == '0' ? 'selected' : '' }}>{{ __('messages.inactive') }}</option>
                                            </select>
                                            @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>{{ __('messages.teachers') }}</label>
                                    <div class="teachers-list">
                                        @foreach($teachers as $teacher)
                                            <div class="checkbox-wrapper">
                                                <input type="checkbox" 
                                                       name="teacher_ids[]" 
                                                       value="{{ $teacher->id }}" 
                                                       id="teacher{{ $teacher->id }}"
                                                       {{ in_array($teacher->id, $section->teachers->pluck('id')->toArray()) ? 'checked' : '' }}>
                                                <label for="teacher{{ $teacher->id }}">
                                                    {{ $teacher->name }} - {{ $teacher->specialization->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('teacher_ids')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save"></i> {{ __('messages.update') }}
                                    </button>
                                    <a href="{{ route('sections.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> {{ __('messages.cancel') }}
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#grade_select').on('change', function() {
            var gradeId = $(this).val();
            if(gradeId) {
                $.ajax({
                    url: '/get-classrooms/' + gradeId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#classroom_select').empty();
                        $('#classroom_select').append('<option value="">{{ __("messages.choose_classroom") }}</option>');
                        $.each(data, function(key, value) {
                            var selected = (value.id == {{ $section->classroom_id }}) ? 'selected' : '';
                            $('#classroom_select').append('<option value="' + value.id + '" ' + selected + '>' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#classroom_select').empty();
                $('#classroom_select').append('<option value="">{{ __("messages.choose_classroom") }}</option>');
            }
        });

        // Load classrooms for the current grade
        var selectedGradeId = $('#grade_select').val();
        if(selectedGradeId) {
            $('#grade_select').trigger('change');
        }
    });
</script>
@endpush
