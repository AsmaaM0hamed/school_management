@extends('backend.layouts.master')
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('title')
    {{ __('messages.sections') }}
@endsection

@section('page_name')
    {{ __('messages.sections') }}
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('sections.create') }}" class="btn btn-success">
                                <i class="fas fa-plus"></i> {{ __('messages.add_section') }}
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="accordion" id="gradesAccordion">
                                @foreach($grades as $grade)
                                    <div class="card">
                                        <div class="card-header" id="heading{{ $grade->id }}">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-left" type="button" 
                                                        data-toggle="collapse" data-target="#collapse{{ $grade->id }}" 
                                                        aria-expanded="true" aria-controls="collapse{{ $grade->id }}">
                                                    <i class="fas fa-school"></i> {{ $grade->name }}
                                                    <span class="badge badge-info float-right">
                                                        {{ $grade->sections->count() }} {{ __('messages.sections') }}
                                                    </span>
                                                </button>
                                            </h2>
                                        </div>

                                        <div id="collapse{{ $grade->id }}" class="collapse" 
                                             aria-labelledby="heading{{ $grade->id }}" 
                                             data-parent="#gradesAccordion">
                                            <div class="card-body">
                                                <table class="table table-bordered table-striped section-table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>{{ __('messages.name') }}</th>
                                                            <th>{{ __('messages.classroom') }}</th>
                                                            <th>{{ __('messages.status') }}</th>
                                                            <th>{{ __('messages.actions') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($grade->sections as $section)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $section->name }}</td>
                                                                <td>{{ $section->classroom->name }}</td>
                                                                <td>
                                                                    @if($section->status)
                                                                        <span class="badge badge-success">{{ __('messages.active') }}</span>
                                                                    @else
                                                                        <span class="badge badge-danger">{{ __('messages.inactive') }}</span>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                                        data-target="#editSectionModal{{ $section->id }}">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>
                                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                                        data-target="#deleteSectionModal{{ $section->id }}">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="5" class="text-center">{{ __('messages.no_sections_found') }}</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Delete Section Modals -->
    @foreach($grades as $grade)
        @foreach($grade->sections as $section)
            <div class="modal fade" id="deleteSectionModal{{ $section->id }}" tabindex="-1" role="dialog" 
                aria-labelledby="deleteSectionModalLabel{{ $section->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteSectionModalLabel{{ $section->id }}">
                                {{ __('messages.delete_section') }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('sections.destroy', $section->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                <p>{{ __('messages.delete_section_confirm') }}: <strong>{{ $section->name }}</strong></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    {{ __('messages.close') }}
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
    @endforeach
@endsection

@section('scripts')
    <!-- DataTables & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script>
        $(function () {
            $('.section-table').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('.section-table_wrapper .col-md-6:eq(0)');

            // Show first grade's sections by default
            $('#collapse{{ $grades->first()->id }}').addClass('show');
        });
    </script>

    <style>
        .btn-link {
            color: #17a2b8;
            text-decoration: none;
            font-weight: bold;
        }
        .btn-link:hover {
            color: #138496;
            text-decoration: none;
        }
        .accordion .card-header {
            padding: 0;
        }
        .accordion .btn-link {
            padding: 1rem;
        }
        .section-table {
            margin-top: 1rem;
        }
    </style>
@endsection
