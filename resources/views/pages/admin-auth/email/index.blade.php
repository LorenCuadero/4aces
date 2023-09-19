@extends('layouts.common.app')
@section('has-vue', '')
@push('css')
    <link rel="stylesheet" href="{{ rspr::vers('css/page/loading.css') }}">
@endpush
@push('js')
    <script src="{{ rspr::vers('js/page/job-title.js') }}" defer></script>
@endpush
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12" id="table">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="card-title">{{ __('words.JobTitleManagementTable') }}</h3>
                            <div class="ml-auto">
                                <form class="form-inline">
                                    <input id="searchInput" class="form-control mr-sm-2" type="search"
                                        placeholder="Search record here" aria-label="Search">
                                    <a style="float: right" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#AddJobTitleModal">
                                        <i class="fas fa-plus"></i> {{ __('words.Add') }}
                                    </a>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example2" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('words.Id') }}</th>
                                                    <th>{{ __('words.JobTitleAbbreviation') }}</th>
                                                    <th>{{ __('words.JobTitleName') }}</th>
                                                    <th>{{ __('words.View') }}</th>
                                                    <th>{{ __('words.Actions') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($jobtitles as $jobtitle)
                                                    <tr
                                                        data-search="{{ $jobtitle->id }}
                                                            {{ $jobtitle->job_title_abbr }}
                                                            {{ $jobtitle->job_title_name }}">
                                                        <td>{{ $jobtitle->id }}</td>
                                                        <td>{{ $jobtitle->job_title_abbr }}</td>
                                                        <td>{{ $jobtitle->job_title_name }}</td>
                                                        <td>
                                                            <a href="#" class="btn btn-link view-btn"
                                                                data-toggle="modal" data-target="#ViewJobTitleModal"
                                                                data-jobtitle-id="{{ $jobtitle->id }}"
                                                                data-jobtitle-abbr="{{ $jobtitle->job_title_abbr }}"
                                                                data-jobtitle-name="{{ $jobtitle->job_title_name }}"
                                                                data-edit-url="{{ route('job-titles.show', ['jobTitle' => $jobtitle->id]) }}">
                                                                {{ __('words.ViewJobTitle') }}
                                                            </a>
                                                        </td>

                                                        <td class="d-flex align-items-center">
                                                            <a href="#" class="btn btn-info btn-sm edit-btn mr-2"
                                                                data-toggle="modal" data-target="#EditJobTitleModal"
                                                                data-jobtitle-id="{{ $jobtitle->id }}"
                                                                data-jobtitle-abbr="{{ $jobtitle->job_title_abbr }}"
                                                                data-jobtitle-name="{{ $jobtitle->job_title_name }}"
                                                                data-edit-url="{{ route('job-titles.update', ['jobTitle' => $jobtitle->id]) }}">
                                                                <i class="fas fa-pencil-alt"></i> {{ __('words.Edit') }}
                                                            </a>

                                                            <form method="POST"
                                                                action="{{ route('job-titles.destroy', ['jobTitle' => $jobtitle->id]) }}"
                                                                onsubmit="return confirm('Are you sure you want to delete this job title?');">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="btn btn-danger btn-sm">
                                                                    <i class="fas fa-trash"></i> {{ __('words.Delete') }}
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{ $jobtitles->links('assets.element.common.asset-el-pagination') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('modals.common.mdl-view-job-title')
    <add-job-title-modal></add-job-title-modal>
    @include('modals.common.mdl-edit-job-title')
@endsection
