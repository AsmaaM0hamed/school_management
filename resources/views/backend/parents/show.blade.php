@extends('backend.layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/parent-details.css') }}">
@endsection

@section('title')
    {{ __('messages.parent_details') }}
@endsection

@section('content')
    <div class="content-wrapper" style="margin: 0 !important; padding: 20px;">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('messages.parent_details') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('messages.dashboard') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('parents.index') }}">{{ __('messages.parents') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('messages.parent_details') }}</li>
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
                            <div class="card-header bg-primary text-white">
                                <h3 class="card-title">
                                    <i class="fas fa-user-friends mr-2"></i>{{ __('messages.parent_details') }}
                                </h3>
                            </div>
                            <div class="card-body">
                                <!-- معلومات تسجيل الدخول -->
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <div class="info-box basic-info">
                                            <div class="info-box-title">
                                                <i class="fas fa-user-shield"></i>{{ __('messages.login_information') }}
                                            </div>
                                            <ul class="info-list">
                                                <li>
                                                    <span class="info-label">{{ __('messages.email') }}</span>
                                                    <span class="info-value">{{ $parent->email }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- معلومات الأب -->
                                    <div class="col-md-6">
                                        <div class="parent-section father-section">
                                            <div class="section-header bg-primary text-white p-2 rounded mb-3">
                                                <i class="fas fa-male mr-2"></i>{{ __('messages.father_information') }}
                                            </div>
                                            
                                            <div class="info-box basic-info">
                                                <div class="info-box-title">
                                                    <i class="fas fa-info-circle"></i>{{ __('messages.basic_information') }}
                                                </div>
                                                <ul class="info-list">
                                                    <li>
                                                        <span class="info-label">{{ __('messages.father_name') }}</span>
                                                        <span class="info-value">{{ $parent->father_name }}</span>
                                                    </li>
                                                    <li>
                                                        <span class="info-label">{{ __('messages.national_id') }}</span>
                                                        <span class="info-value">{{ $parent->father_national_id }}</span>
                                                    </li>
                                                    <li>
                                                        <span class="info-label">{{ __('messages.passport_id') }}</span>
                                                        <span class="info-value">{{ $parent->father_passport_id ?: '-' }}</span>
                                                    </li>
                                                    <li>
                                                        <span class="info-label">{{ __('messages.job') }}</span>
                                                        <span class="info-value">{{ $parent->father_job }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            
                                            <div class="info-box contact-info">
                                                <div class="info-box-title">
                                                    <i class="fas fa-phone-alt"></i>{{ __('messages.contact_information') }}
                                                </div>
                                                <ul class="info-list">
                                                    <li>
                                                        <span class="info-label">{{ __('messages.phone') }}</span>
                                                        <span class="info-value">{{ $parent->father_phone }}</span>
                                                    </li>
                                                    <li>
                                                        <span class="info-label">{{ __('messages.address') }}</span>
                                                        <span class="info-value">{{ $parent->father_address }}</span>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="info-box additional-info">
                                                <div class="info-box-title">
                                                    <i class="fas fa-user-tag"></i>{{ __('messages.additional_information') }}
                                                </div>
                                                <ul class="info-list">
                                                    <li>
                                                        <span class="info-label">{{ __('messages.nationality') }}</span>
                                                        <span class="info-value">{{ $parent->fatherNationality->name }}</span>
                                                    </li>
                                                    <li>
                                                        <span class="info-label">{{ __('messages.blood_type') }}</span>
                                                        <span class="info-value">{{ $parent->fatherBloodType->name }}</span>
                                                    </li>
                                                    <li>
                                                        <span class="info-label">{{ __('messages.religion') }}</span>
                                                        <span class="info-value">{{ $parent->fatherReligion->name }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- معلومات الأم -->
                                    <div class="col-md-6">
                                        <div class="parent-section mother-section">
                                            <div class="section-header bg-info text-white p-2 rounded mb-3">
                                                <i class="fas fa-female mr-2"></i>{{ __('messages.mother_information') }}
                                            </div>
                                            
                                            <div class="info-box basic-info">
                                                <div class="info-box-title">
                                                    <i class="fas fa-info-circle"></i>{{ __('messages.basic_information') }}
                                                </div>
                                                <ul class="info-list">
                                                    <li>
                                                        <span class="info-label">{{ __('messages.mother_name') }}</span>
                                                        <span class="info-value">{{ $parent->mother_name }}</span>
                                                    </li>
                                                    <li>
                                                        <span class="info-label">{{ __('messages.national_id') }}</span>
                                                        <span class="info-value">{{ $parent->mother_national_id }}</span>
                                                    </li>
                                                    <li>
                                                        <span class="info-label">{{ __('messages.passport_id') }}</span>
                                                        <span class="info-value">{{ $parent->mother_passport_id ?: '-' }}</span>
                                                    </li>
                                                    <li>
                                                        <span class="info-label">{{ __('messages.job') }}</span>
                                                        <span class="info-value">{{ $parent->mother_job }}</span>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="info-box contact-info">
                                                <div class="info-box-title">
                                                    <i class="fas fa-phone-alt"></i>{{ __('messages.contact_information') }}
                                                </div>
                                                <ul class="info-list">
                                                    <li>
                                                        <span class="info-label">{{ __('messages.phone') }}</span>
                                                        <span class="info-value">{{ $parent->mother_phone }}</span>
                                                    </li>
                                                    <li>
                                                        <span class="info-label">{{ __('messages.address') }}</span>
                                                        <span class="info-value">{{ $parent->mother_address }}</span>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="info-box additional-info">
                                                <div class="info-box-title">
                                                    <i class="fas fa-user-tag"></i>{{ __('messages.additional_information') }}
                                                </div>
                                                <ul class="info-list">
                                                    <li>
                                                        <span class="info-label">{{ __('messages.nationality') }}</span>
                                                        <span class="info-value">{{ $parent->motherNationality->name }}</span>
                                                    </li>
                                                    <li>
                                                        <span class="info-label">{{ __('messages.blood_type') }}</span>
                                                        <span class="info-value">{{ $parent->motherBloodType->name }}</span>
                                                    </li>
                                                    <li>
                                                        <span class="info-label">{{ __('messages.religion') }}</span>
                                                        <span class="info-value">{{ $parent->motherReligion->name }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="action-buttons mt-4">
                                    <a href="{{ route('parents.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> {{ __('messages.back_to_parents') }}
                                    </a>
                                    <a href="{{ route('parents.edit', $parent->id) }}" class="btn btn-warning">
                                        <i class="fas fa-edit"></i> {{ __('messages.edit_parent_info') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
