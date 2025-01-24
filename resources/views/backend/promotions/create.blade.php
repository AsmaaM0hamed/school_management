@extends('backend.layouts.master')

@section('title')
    {{ __('messages.add_promotion') }}
@endsection

@section('page_name')
    {{ __('messages.add_promotion') }}
@endsection

@section('content')
<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('messages.add_promotion') }}</h3>
        </div>
        <form action="{{ route('backend.promotions.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="from_grade_id">{{ __('messages.from_grade') }}</label>
                    <select name="from_grade_id" id="from_grade_id" class="form-control">
                        @foreach($grades as $grade)
                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="from_class_id">{{ __('messages.from_class') }}</label>
                    <select name="from_class_id" id="from_class_id" class="form-control">
                        @foreach($classrooms as $classroom)
                            <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="from_section_id">{{ __('messages.from_section') }}</label>
                    <select name="from_section_id" id="from_section_id" class="form-control">
                        @foreach($sections as $section)
                            <option value="{{ $section->id }}">{{ $section->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="to_grade_id">{{ __('messages.to_grade') }}</label>
                    <select name="to_grade_id" id="to_grade_id" class="form-control">
                        @foreach($grades as $grade)
                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="to_class_id">{{ __('messages.to_class') }}</label>
                    <select name="to_class_id" id="to_class_id" class="form-control">
                        @foreach($classrooms as $classroom)
                            <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="to_section_id">{{ __('messages.to_section') }}</label>
                    <select name="to_section_id" id="to_section_id" class="form-control">
                        @foreach($sections as $section)
                            <option value="{{ $section->id }}">{{ $section->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="promotion_date">{{ __('messages.promotion_date') }}</label>
                    <input type="date" name="promotion_date" id="promotion_date" class="form-control">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
