@extends('backend.layouts.master')

@section('title')
    {{ __('messages.manage_promotions') }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('messages.manage_promotions') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">{{ __('messages.dashboard') }}</a></li>
                <li class="breadcrumb-item active">{{ __('messages.manage_promotions') }}</li>
            </ol>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('messages.promotions_list') }}</h3>
        </div>
        <form action="{{ route('backend.promotions.bulk-revert') }}" method="POST" id="bulk-revert-form">
            @csrf
            @method('DELETE')
            <div class="card-body">
                <div class="mb-3">
                    <button type="submit" class="btn btn-danger" onclick="return confirmBulkRevert()">
                        <i class="fas fa-undo"></i> {{ __('messages.bulk_revert') }}
                    </button>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all" title="{{ __('messages.select_all') }}"></th>
                            <th>{{ __('messages.student') }}</th>
                            <th>{{ __('messages.from_class') }}</th>
                            <th>{{ __('messages.to_class') }}</th>
                            <th>{{ __('messages.promotion_date') }}</th>
                            <th>{{ __('messages.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($promotions as $promotion)
                            <tr>
                                <td><input type="checkbox" name="promotions[]" value="{{ $promotion->id }}"></td>
                                <td>{{ $promotion->student->name }}</td>
                                <td>{{ $promotion->fromClass->name }}</td>
                                <td>{{ $promotion->toClass->name }}</td>
                                <td>{{ $promotion->promotion_date }}</td>
                                <td>
                                    <form action="{{ route('backend.promotions.revert', $promotion->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('{{ __('messages.confirm_revert') }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-undo"></i> {{ __('messages.revert') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('select-all');
            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function() {
                    const checkboxes = document.querySelectorAll('input[name="promotions[]"]');
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                });
            }
        });

        function confirmBulkRevert() {
            const checkedBoxes = document.querySelectorAll('input[name="promotions[]"]:checked');
            if (checkedBoxes.length === 0) {
                alert('{{ __("messages.no_promotions_selected") }}');
                return false;
            }
            return confirm('{{ __("messages.confirm_bulk_revert") }}');
        }
    </script>
</div>
@endsection
