@extends('backend.layouts.master')

@section('title')
    {{ __('messages.add_parent') }}
@endsection

@section('content')
<div class="content-wrapper" style="margin-left: 0;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('messages.add_parent') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('messages.home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('parents.index') }}">{{ __('messages.parents') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('messages.add_parent') }}</li>
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
                            <form action="{{ route('parents.store') }}" method="POST">
                                @csrf
                                
                                <!-- معلومات تسجيل الدخول -->
                                <h4>{{ __('messages.login_information') }}</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('messages.email') }}</label>
                                            <input type="email" name="email" value="{{ old('email') }}" 
                                                   class="form-control @error('email') is-invalid @enderror" required>
                                            @error('email')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('messages.password') }}</label>
                                            <input type="password" name="password" 
                                                   class="form-control @error('password') is-invalid @enderror" required>
                                            @error('password')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- معلومات الأب -->
                                <h4 class="mt-4">{{ __('messages.father_information') }}</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('messages.father_name') }}</label>
                                            <input type="text" name="father_name" value="{{ old('father_name') }}" 
                                                   class="form-control @error('father_name') is-invalid @enderror" required>
                                            @error('father_name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('messages.national_id') }}</label>
                                            <input type="text" name="father_national_id" value="{{ old('father_national_id') }}" 
                                                   class="form-control @error('father_national_id') is-invalid @enderror" required>
                                            @error('father_national_id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('messages.passport_id') }}</label>
                                            <input type="text" name="father_passport_id" value="{{ old('father_passport_id') }}" 
                                                   class="form-control @error('father_passport_id') is-invalid @enderror">
                                            @error('father_passport_id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('messages.phone') }}</label>
                                            <input type="text" name="father_phone" value="{{ old('father_phone') }}" 
                                                   class="form-control @error('father_phone') is-invalid @enderror" required>
                                            @error('father_phone')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('messages.job') }}</label>
                                            <input type="text" name="father_job" value="{{ old('father_job') }}" 
                                                   class="form-control @error('father_job') is-invalid @enderror" required>
                                            @error('father_job')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('messages.nationality') }}</label>
                                            <select name="father_nationality_id" class="form-control @error('father_nationality_id') is-invalid @enderror" required>
                                                <option value="">{{ __('messages.select_nationality') }}</option>
                                                @foreach($nationalities as $nationality)
                                                    <option value="{{ $nationality->id }}" {{ old('father_nationality_id') == $nationality->id ? 'selected' : '' }}>
                                                        {{ $nationality->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('father_nationality_id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('messages.blood_type') }}</label>
                                            <select name="father_blood_type_id" class="form-control @error('father_blood_type_id') is-invalid @enderror" required>
                                                <option value="">{{ __('messages.select_blood_type') }}</option>
                                                @foreach($bloodTypes as $bloodType)
                                                    <option value="{{ $bloodType->id }}" {{ old('father_blood_type_id') == $bloodType->id ? 'selected' : '' }}>
                                                        {{ $bloodType->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('father_blood_type_id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('messages.religion') }}</label>
                                            <select name="father_religion_id" class="form-control @error('father_religion_id') is-invalid @enderror" required>
                                                <option value="">{{ __('messages.select_religion') }}</option>
                                                @foreach($religions as $religion)
                                                    <option value="{{ $religion->id }}" {{ old('father_religion_id') == $religion->id ? 'selected' : '' }}>
                                                        {{ $religion->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('father_religion_id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{ __('messages.address') }}</label>
                                            <textarea name="father_address" class="form-control @error('father_address') is-invalid @enderror" 
                                                      rows="3" required>{{ old('father_address') }}</textarea>
                                            @error('father_address')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- معلومات الأم -->
                                <h4 class="mt-4">{{ __('messages.mother_information') }}</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('messages.mother_name') }}</label>
                                            <input type="text" name="mother_name" value="{{ old('mother_name') }}" 
                                                   class="form-control @error('mother_name') is-invalid @enderror" required>
                                            @error('mother_name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('messages.national_id') }}</label>
                                            <input type="text" name="mother_national_id" value="{{ old('mother_national_id') }}" 
                                                   class="form-control @error('mother_national_id') is-invalid @enderror" required>
                                            @error('mother_national_id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('messages.passport_id') }}</label>
                                            <input type="text" name="mother_passport_id" value="{{ old('mother_passport_id') }}" 
                                                   class="form-control @error('mother_passport_id') is-invalid @enderror">
                                            @error('mother_passport_id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('messages.phone') }}</label>
                                            <input type="text" name="mother_phone" value="{{ old('mother_phone') }}" 
                                                   class="form-control @error('mother_phone') is-invalid @enderror" required>
                                            @error('mother_phone')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('messages.job') }}</label>
                                            <input type="text" name="mother_job" value="{{ old('mother_job') }}" 
                                                   class="form-control @error('mother_job') is-invalid @enderror" required>
                                            @error('mother_job')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('messages.nationality') }}</label>
                                            <select name="mother_nationality_id" class="form-control @error('mother_nationality_id') is-invalid @enderror" required>
                                                <option value="">{{ __('messages.select_nationality') }}</option>
                                                @foreach($nationalities as $nationality)
                                                    <option value="{{ $nationality->id }}" {{ old('mother_nationality_id') == $nationality->id ? 'selected' : '' }}>
                                                        {{ $nationality->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('mother_nationality_id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('messages.blood_type') }}</label>
                                            <select name="mother_blood_type_id" class="form-control @error('mother_blood_type_id') is-invalid @enderror" required>
                                                <option value="">{{ __('messages.select_blood_type') }}</option>
                                                @foreach($bloodTypes as $bloodType)
                                                    <option value="{{ $bloodType->id }}" {{ old('mother_blood_type_id') == $bloodType->id ? 'selected' : '' }}>
                                                        {{ $bloodType->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('mother_blood_type_id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('messages.religion') }}</label>
                                            <select name="mother_religion_id" class="form-control @error('mother_religion_id') is-invalid @enderror" required>
                                                <option value="">{{ __('messages.select_religion') }}</option>
                                                @foreach($religions as $religion)
                                                    <option value="{{ $religion->id }}" {{ old('mother_religion_id') == $religion->id ? 'selected' : '' }}>
                                                        {{ $religion->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('mother_religion_id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{ __('messages.address') }}</label>
                                            <textarea name="mother_address" class="form-control @error('mother_address') is-invalid @enderror" 
                                                      rows="3" required>{{ old('mother_address') }}</textarea>
                                            @error('mother_address')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save"></i> {{ __('messages.save') }}
                                    </button>
                                    <a href="{{ route('parents.index') }}" class="btn btn-secondary">
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
