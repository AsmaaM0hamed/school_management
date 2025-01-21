@extends('backend.layouts.master')

@section('title', __('messages.students'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('messages.students') }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('students.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> {{ __('messages.add_student') }}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped datatable">
                            <thead>
                                <tr>
                                    <th width="50">#</th>
                                    <th width="80">{{ __('messages.photo') }}</th>
                                    <th>{{ __('messages.student_name') }}</th>
                                    <th>{{ __('messages.grade') }}</th>
                                    <th>{{ __('messages.classroom') }}</th>
                                    <th>{{ __('messages.section') }}</th>
                                    <th>{{ __('messages.parent') }}</th>
                                    <th width="80">{{ __('messages.status') }}</th>
                                    <th width="120">{{ __('messages.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        @if($student->photo && file_exists(public_path($student->photo)))
                                            <img src="{{ asset($student->photo) }}" 
                                                alt="{{ $student->name }}" 
                                                class="img-thumbnail" 
                                                style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <div class="img-thumbnail d-flex align-items-center justify-content-center" 
                                                 style="width: 50px; height: 50px; background-color: #f8f9fa;">
                                                <i class="fas fa-user-graduate text-secondary" style="font-size: 1.5rem;"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('students.show', $student->id) }}" class="text-bold">
                                            {{ $student->name }}
                                        </a>
                                    </td>
                                    <td>{{ $student->grade->name }}</td>
                                    <td>{{ $student->classroom->name }}</td>
                                    <td>{{ $student->section->name }}</td>
                                    <td>
                                        <a href="{{ route('parents.show', $student->parent_id) }}">
                                            {{ $student->parent->father_name }}
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        @if($student->status == 'active')
                                            <span class="badge badge-success">{{ __('messages.active') }}</span>
                                        @elseif($student->status == 'inactive')
                                            <span class="badge badge-danger">{{ __('messages.inactive') }}</span>
                                        @else
                                            <span class="badge badge-info">{{ __('messages.graduated') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('students.show', $student->id) }}" 
                                               class="btn btn-sm btn-primary" 
                                               title="{{ __('messages.view') }}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('students.edit', $student->id) }}" 
                                               class="btn btn-sm btn-info" 
                                               title="{{ __('messages.edit') }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-sm btn-danger" 
                                                    data-toggle="modal" 
                                                    data-target="#deleteModal" 
                                                    data-student-id="{{ $student->id }}"
                                                    data-student-name="{{ $student->name }}"
                                                    title="{{ __('messages.delete') }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">{{ __('messages.delete_student') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{ __('messages.delete_student_confirm') }} <span id="studentName"></span>؟</p>
            </div>
            <div class="modal-footer">
                <form id="deleteForm" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.cancel') }}</button>
                    <button type="submit" class="btn btn-danger">{{ __('messages.confirm_delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<style>
    .datatable th, .datatable td {
        vertical-align: middle !important;
    }
    .btn-group {
        display: flex;
        gap: 5px;
    }
    .img-thumbnail {
        padding: 0.25rem;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        box-shadow: 0 1px 2px rgba(0,0,0,0.075);
    }
</style>
@endpush

@push('scripts')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script>
    $(function () {
        // DataTable initialization
        $('.datatable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "language": {
                "url": "{{ app()->getLocale() == 'ar' ? asset('plugins/datatables/ar.json') : '' }}"
            }
        });

        // Delete modal setup
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var studentId = button.data('student-id');
            var studentName = button.data('student-name');
            var modal = $(this);
            
            modal.find('#studentName').text(studentName);
            modal.find('#deleteForm').attr('action', '/students/' + studentId);
        });
    });
</script>
@endpush
