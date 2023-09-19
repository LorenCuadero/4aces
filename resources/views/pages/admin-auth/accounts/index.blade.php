@extends('layouts.admin.app')
@section('has-vue', '')
{{-- @push('css')
    <link rel="stylesheet" href="{{ rspr::vers('css/page/person.css') }}">
@endpush --}}
@push('js')
    <script src="{{ rspr::vers('js/pages/admin.js') }}" defer></script>
@endpush
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12" id="table">
                <div class="card">
                    <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                        <h4 class="card-title mb-3 mb-md-0">{{ __('words.PersonManagementTable') }}</h4>
                        <div class="d-flex flex-wrap align-items-center ml-auto">
                            <form class="form-inline mr-auto mr-md-0 mb-2 mb-md-0">
                                <input id="searchInput" class="form-control mr-sm-1" type="search" placeholder="Search record here" aria-label="Search">
                                <a id="add-btn" class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#register-mdl" alt="Add person">
                                    <i class="fas fa-user-plus"></i> Register an account
                                </a>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="vertical-text">{{ __('words.Id') }}</th>
                                        <th class="vertical-text">{{ __('words.FirstName') }}</th>
                                        <th class="vertical-text">{{ __('words.LastName') }}</th>
                                        <th class="vertical-text">{{ __('words.MiddleName') }}</th>
                                        <th class="vertical-text">{{ __('words.Email') }}</th>
                                        <th class="vertical-text">{{ __('words.Phone') }}</th>
                                        <th class="vertical-text">{{ __('words.BirthDate') }}</th>
                                        <th class="vertical-text">{{ __('words.CivilStatus') }}</th>
                                        <th class="vertical-text">{{ __('words.Address') }}</th>
                                        <th class="vertical-text">{{ __('words.ProfileImage') }}</th>
                                        {{-- @if ($persons->isNotEmpty())
                                        <th class="vertical-text">{{ __('words.View') }}</th>
                                        <th class="vertical-text">{{ __('words.Actions') }}</th>
                                        @endif --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="11">{{ __('words.NoRecordsFound' )}}</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $persons->links('assets.element.common.asset-el-pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- @include('modals.common.mdl-view-person')
@include('modals.common.mdl-edit-person') --}}
<cmpt-admin-register></cmpt-admin-register>
@endsection
