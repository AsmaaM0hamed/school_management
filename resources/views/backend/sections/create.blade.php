@extends('backend.layouts.master')

@section('title')
    {{ __('messages.add_section') }}
@endsection

@section('content')
<div class="content-wrapper" style="margin-left: 0;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('messages.add_section') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('messages.home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('sections.index') }}">{{ __('messages.sections') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('messages.add_section') }}</li>
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
                            <form action="{{ route('sections.store') }}" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('messages.name') }}</label>
                                            <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required>
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
                                                    <option value="{{ $grade->id }}" {{ old('grade_id') == $grade->id ? 'selected' : '' }}>
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
                                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>{{ __('messages.active') }}</option>
                                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>{{ __('messages.inactive') }}</option>
                                            </select>
                                            @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save"></i> {{ __('messages.save') }}
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
    $(function() {
        $('#grade_select').change(function() {
            var gradeId = $(this).val();
            var classroomSelect = $('#classroom_select');
            
            // Reset classroom select
            classroomSelect.empty();
            classroomSelect.append('<option value="">{{ __("messages.choose_classroom") }}</option>');
            
            if(gradeId) {
                var url = '{{ route("get.classrooms", ":id") }}'.replace(':id', gradeId);
                
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if(response.status === 'success' && response.data) {
                            $.each(response.data, function(key, classroom) {
                                classroomSelect.append('<option value="' + classroom.id + '">' + classroom.name + '</option>');
                            });
                        } else {
                            alert(response.message || '{{ __("messages.error_occurred") }}');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('{{ __("messages.error_occurred") }}');
                    }
                });
            }
        });

        // If grade_id is already selected (in case of validation error), load classrooms
        var selectedGradeId = $('#grade_select').val();
        if(selectedGradeId) {
            $('#grade_select').trigger('change');
        }
    });
</script>
@endpush
