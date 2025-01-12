@extends("backend.layouts.master")

@section('title')
{{ __('messages.classrooms') }}
@endsection

@section('page_name')
{{ __('messages.classrooms') }}
@endsection

@section('content')
<section class="content">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12">
                <div class="d-flex justify-content-start">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addClassroomModal">
                        <i class="fas fa-plus"></i> {{ __('messages.add_classroom') }}
                    </button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('messages.classroom_name') }}</th>
                                        <th>{{ __('messages.classroom_grade') }}</th>
                                        <th>{{ __('messages.classroom_capacity') }}</th>
                                        <th>{{ __('messages.classroom_description') }}</th>
                                        <th>{{ __('messages.status') }}</th>
                                        <th>{{ __('messages.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($classrooms as $classroom)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $classroom->name }}</td>
                                            <td>{{ $classroom->grade->name }}</td>
                                            <td>{{ $classroom->capacity }}</td>
                                            <td>{{ $classroom->description ?? '-' }}</td>
                                            <td>
                                                @if($classroom->is_active)
                                                    <span class="badge badge-success">{{ __('messages.active') }}</span>
                                                @else
                                                    <span class="badge badge-danger">{{ __('messages.inactive') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary btn-sm" 
                                                            data-toggle="modal" 
                                                            data-target="#editClassroomModal{{ $classroom->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm" 
                                                            data-toggle="modal" 
                                                            data-target="#deleteClassroomModal{{ $classroom->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">{{ __('messages.no_classrooms_found') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Add Classroom Modal -->
<div class="modal fade" id="addClassroomModal" tabindex="-1" role="dialog" aria-labelledby="addClassroomModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClassroomModalLabel">{{ __('messages.add_classroom') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('classrooms.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">{{ __('messages.classroom_name') }}</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="grade_id">{{ __('messages.classroom_grade') }}</label>
                        <select class="form-control" id="grade_id" name="grade_id" required>
                            <option value="">{{ __('messages.select_grade') }}</option>
                            @foreach($grades as $grade)
                                <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="capacity">{{ __('messages.classroom_capacity') }}</label>
                        <input type="number" class="form-control" id="capacity" name="capacity" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="description">{{ __('messages.classroom_description') }}</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" checked>
                            <label class="custom-control-label" for="is_active">{{ __('messages.status') }}</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.cancel') }}</button>
                    <button type="submit" class="btn btn-success">{{ __('messages.save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Classroom Modals -->
@foreach($classrooms as $classroom)
    <div class="modal fade" id="editClassroomModal{{ $classroom->id }}" tabindex="-1" role="dialog" aria-labelledby="editClassroomModalLabel{{ $classroom->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editClassroomModalLabel{{ $classroom->id }}">
                        {{ __('messages.edit_classroom') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('classrooms.update', $classroom->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name{{ $classroom->id }}">{{ __('messages.classroom_name') }}</label>
                            <input type="text" class="form-control" id="name{{ $classroom->id }}" name="name" value="{{ $classroom->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="grade_id{{ $classroom->id }}">{{ __('messages.classroom_grade') }}</label>
                            <select class="form-control" id="grade_id{{ $classroom->id }}" name="grade_id" required>
                                @foreach($grades as $grade)
                                    <option value="{{ $grade->id }}" {{ $classroom->grade_id == $grade->id ? 'selected' : '' }}>
                                        {{ $grade->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="capacity{{ $classroom->id }}">{{ __('messages.classroom_capacity') }}</label>
                            <input type="number" class="form-control" id="capacity{{ $classroom->id }}" name="capacity" value="{{ $classroom->capacity }}" min="1" required>
                        </div>
                        <div class="form-group">
                            <label for="description{{ $classroom->id }}">{{ __('messages.classroom_description') }}</label>
                            <textarea class="form-control" id="description{{ $classroom->id }}" name="description" rows="3">{{ $classroom->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_active{{ $classroom->id }}" name="is_active" {{ $classroom->is_active ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active{{ $classroom->id }}">{{ __('messages.status') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            {{ __('messages.cancel') }}
                        </button>
                        <button type="submit" class="btn btn-primary">
                            {{ __('messages.update') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

<!-- Delete Classroom Modals -->
@foreach($classrooms as $classroom)
    <div class="modal fade" id="deleteClassroomModal{{ $classroom->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteClassroomModalLabel{{ $classroom->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteClassroomModalLabel{{ $classroom->id }}">
                        {{ __('messages.delete_classroom') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('classrooms.destroy', $classroom->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <p>{{ __('messages.delete_classroom_confirm', ['name' => $classroom->name]) }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            {{ __('messages.cancel') }}
                        </button>
                        <button type="submit" class="btn btn-danger">
                            {{ __('messages.delete') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
@endsection
