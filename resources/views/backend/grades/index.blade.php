@extends("backend.layouts.master")

@section('title')
{{ __('messages.grades') }}
@endsection

@section('page_name')
{{ __('messages.grades') }}
@endsection

@section('content')
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
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addGradeModal">
                    {{ __('messages.add_grade') }}
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
                                    <th>{{ __('messages.grade_name') }}</th>
                                    <th>{{ __('messages.grade_code') }}</th>
                                    <th>{{ __('messages.grade_description') }}</th>
                                    <th>{{ __('messages.status') }}</th>
                                    <th>{{ __('messages.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($grades as $grade)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $grade->name }}</td>
                                        <td>{{ $grade->code }}</td>
                                        <td>{{ $grade->description ?? '-' }}</td>
                                        <td>
                                            @if($grade->is_active)
                                                <span class="badge badge-success">{{ __('messages.active') }}</span>
                                            @else
                                                <span class="badge badge-danger">{{ __('messages.inactive') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary btn-sm" 
                                                        data-toggle="modal" 
                                                        data-target="#editGradeModal{{ $grade->id }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" 
                                                        data-toggle="modal" 
                                                        data-target="#deleteGradeModal{{ $grade->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">{{ __('messages.no_grades_found') }}</td>
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

<!-- Add Grade Modal -->
<div class="modal fade" id="addGradeModal" tabindex="-1" role="dialog" aria-labelledby="addGradeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addGradeModalLabel">{{ __('messages.add_grade') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('grades.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">{{ __('messages.grade_name') }}</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="code">{{ __('messages.grade_code') }}</label>
                        <input type="text" class="form-control" id="code" name="code" required>
                    </div>
                    <div class="form-group">
                        <label for="description">{{ __('messages.grade_description') }}</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.close') }}</button>
                    <button type="submit" class="btn btn-success">{{ __('messages.save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Grade Modals -->
@foreach($grades as $grade)
    <div class="modal fade" id="editGradeModal{{ $grade->id }}" tabindex="-1" role="dialog" aria-labelledby="editGradeModalLabel{{ $grade->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGradeModalLabel{{ $grade->id }}">
                        {{ __('messages.edit_grade') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('grades.update', $grade->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name{{ $grade->id }}">{{ __('messages.grade_name') }}</label>
                            <input type="text" class="form-control" id="name{{ $grade->id }}" name="name" value="{{ $grade->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="code{{ $grade->id }}">{{ __('messages.grade_code') }}</label>
                            <input type="text" class="form-control" id="code{{ $grade->id }}" name="code" value="{{ $grade->code }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description{{ $grade->id }}">{{ __('messages.grade_description') }}</label>
                            <textarea class="form-control" id="description{{ $grade->id }}" name="description" rows="3">{{ $grade->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_active{{ $grade->id }}" name="is_active" {{ $grade->is_active ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active{{ $grade->id }}">{{ __('messages.status') }}</label>
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

<!-- Delete Grade Modals -->
@foreach($grades as $grade)
    <div class="modal fade" id="deleteGradeModal{{ $grade->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteGradeModalLabel{{ $grade->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteGradeModalLabel{{ $grade->id }}">
                        {{ __('messages.delete_grade') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('grades.destroy', $grade->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <p>{{ __('messages.delete_grade_confirm') }}: <strong>{{ $grade->name }}</strong></p>
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

