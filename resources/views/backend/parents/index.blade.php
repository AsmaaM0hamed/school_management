@extends('backend.layouts.master')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/parent-details.css') }}">
    <style>
        .content-wrapper {
            margin-left: 0 !important;
        }
        @media (max-width: 768px) {
            .content-wrapper {
                margin-left: 0 !important;
            }
        }
        .info-box {
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 15px;
            background: #fff;
            padding: 15px;
        }
        .info-box-title {
            color: #3c8dbc;
            border-bottom: 2px solid #3c8dbc;
            padding-bottom: 10px;
            margin-bottom: 15px;
            font-weight: bold;
        }
        .info-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .info-list li {
            padding: 10px;
            border-bottom: 1px solid #f4f4f4;
            display: flex;
            align-items: center;
        }
        .info-list li:last-child {
            border-bottom: none;
        }
        .info-label {
            font-weight: bold;
            min-width: 150px;
            color: #666;
        }
        .info-value {
            flex: 1;
            color: #333;
        }
        .modal-header {
            background-color: #3c8dbc;
            color: white;
            border-radius: 5px 5px 0 0;
        }
        .modal-header .close {
            color: white;
            opacity: 1;
        }
        .modal-body {
            padding: 20px;
        }
    </style>
@endsection

@section('title')
    {{ __('messages.parents') }}
@endsection

@section('content')
    <div class="content-wrapper" style="margin: 0 !important; padding: 20px;">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('parents.create') }}" class="btn btn-success">
                                    <i class="fas fa-plus"></i> {{ __('messages.add_parent') }}
                                </a>
                            </div>
                            <div class="card-body">
                                <table id="parents-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('messages.father_name') }}</th>
                                            <th>{{ __('messages.mother_name') }}</th>
                                            <th>{{ __('messages.email') }}</th>
                                            <th>{{ __('messages.father_phone') }}</th>
                                            <th>{{ __('messages.mother_phone') }}</th>
                                            <th>{{ __('messages.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($parents as $parent)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="javascript:void(0)" class="show-details" data-toggle="modal" data-target="#fatherDetailsModal{{ $parent->id }}">
                                                        {{ $parent->father_name }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" class="show-details" data-toggle="modal" data-target="#motherDetailsModal{{ $parent->id }}">
                                                        {{ $parent->mother_name }}
                                                    </a>
                                                </td>
                                                <td>{{ $parent->email }}</td>
                                                <td>{{ $parent->father_phone }}</td>
                                                <td>{{ $parent->mother_phone }}</td>
                                                <td>
                                                    <a href="{{ route('parents.show', $parent->id) }}" class="btn btn-info btn-sm" title="{{ __('messages.view') }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('parents.edit', $parent->id) }}" class="btn btn-warning btn-sm" title="{{ __('messages.edit') }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                            data-target="#deleteParentModal{{ $parent->id }}" title="{{ __('messages.delete') }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">{{ __('messages.no_parents_found') }}</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modals -->
    @foreach($parents as $parent)
        <!-- Father Details Modal -->
        <div class="modal fade" id="fatherDetailsModal{{ $parent->id }}" tabindex="-1" role="dialog"
            aria-labelledby="fatherDetailsModalLabel{{ $parent->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="fatherDetailsModalLabel{{ $parent->id }}">
                            <i class="fas fa-user-tie mr-2"></i>{{ __('messages.father_information') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-box">
                                    <div class="info-box-title">
                                        <i class="fas fa-info-circle mr-2"></i>{{ __('messages.basic_information') }}
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
                            </div>
                            <div class="col-md-6">
                                <div class="info-box">
                                    <div class="info-box-title">
                                        <i class="fas fa-phone-alt mr-2"></i>{{ __('messages.contact_information') }}
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
                            </div>
                            <div class="col-md-12">
                                <div class="info-box">
                                    <div class="info-box-title">
                                        <i class="fas fa-user-tag mr-2"></i>{{ __('messages.additional_information') }}
                                    </div>
                                    <ul class="info-list">
                                        <li>
                                            <span class="info-label">{{ __('messages.nationality') }}</span>
                                            <span class="info-value">{{ $parent->father_nationality }}</span>
                                        </li>
                                        <li>
                                            <span class="info-label">{{ __('messages.blood_type') }}</span>
                                            <span class="info-value">{{ $parent->father_blood_type }}</span>
                                        </li>
                                        <li>
                                            <span class="info-label">{{ __('messages.religion') }}</span>
                                            <span class="info-value">{{ $parent->father_religion }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mother Details Modal -->
        <div class="modal fade" id="motherDetailsModal{{ $parent->id }}" tabindex="-1" role="dialog"
            aria-labelledby="motherDetailsModalLabel{{ $parent->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="motherDetailsModalLabel{{ $parent->id }}">
                            <i class="fas fa-user-alt mr-2"></i>{{ __('messages.mother_information') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-box">
                                    <div class="info-box-title">
                                        <i class="fas fa-info-circle mr-2"></i>{{ __('messages.basic_information') }}
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
                            </div>
                            <div class="col-md-6">
                                <div class="info-box">
                                    <div class="info-box-title">
                                        <i class="fas fa-phone-alt mr-2"></i>{{ __('messages.contact_information') }}
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
                            </div>
                            <div class="col-md-12">
                                <div class="info-box">
                                    <div class="info-box-title">
                                        <i class="fas fa-user-tag mr-2"></i>{{ __('messages.additional_information') }}
                                    </div>
                                    <ul class="info-list">
                                        <li>
                                            <span class="info-label">{{ __('messages.nationality') }}</span>
                                            <span class="info-value">{{ $parent->mother_nationality }}</span>
                                        </li>
                                        <li>
                                            <span class="info-label">{{ __('messages.blood_type') }}</span>
                                            <span class="info-value">{{ $parent->mother_blood_type }}</span>
                                        </li>
                                        <li>
                                            <span class="info-label">{{ __('messages.religion') }}</span>
                                            <span class="info-value">{{ $parent->mother_religion }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="deleteParentModal{{ $parent->id }}" tabindex="-1" role="dialog"
            aria-labelledby="deleteParentModalLabel{{ $parent->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteParentModalLabel{{ $parent->id }}">
                            {{ __('messages.delete_parent') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{ __('messages.delete_parent_confirm') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            {{ __('messages.cancel') }}
                        </button>
                        <form action="{{ route('parents.destroy', $parent->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                {{ __('messages.delete') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('scripts')
    <!-- DataTables & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

    <script>
        $(function () {
            $("#parents-table").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "language": {
                    "url": "{{ App::getLocale() == 'ar' ? asset('plugins/datatables/ar.json') : '' }}"
                }
            });
        });
    </script>
@endpush
