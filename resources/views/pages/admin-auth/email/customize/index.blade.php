@extends('layouts.admin.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12" id="table">
                    <div class="card">
                        <div class="card-header d-flex flex-wrap align-items-center justify-content-between"
                            style="background-color:#ffffff">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="card-title mb-3 mb-md-0"
                                        style="color:#1f3c88; padding-left:0%; font-size: 22px"><b>Email Generator:
                                            Customized</b></p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 text-left">
                                    <form id="customized-email-form" enctype="multipart/form-data" method="POST"
                                        action="{{ route('admin.sendCustomized') }}">
                                        @csrf
                                        <div class="form-group row align-items-center">
                                            <p for="batchYear" class="col-sm-2 control-label"><b
                                                    style="color:#1f3c88;">To:</b></p>
                                            <div class="col-sm-10">
                                                <div class="nav-item dropdown show btn btn-sm batch-year-dropdown form-control"
                                                    style="display: flex; align-items: center; background-color: #ffff; border: 1px solid #ced4da;">
                                                    <a class="nav-link dropdown-toggle align-items-center"
                                                        data-toggle="dropdown" href="#" role="button"
                                                        aria-haspopup="true" aria-expanded="true"
                                                        style="color:#495057;height: 100%; display: flex; align-items: center; padding-left: 2%;">
                                                        {{ $selectedBatchYear ?? 'Year' }}
                                                    </a>
                                                    <div class="dropdown-menu mt-0" style="left: 0px; right: inherit;">
                                                        @foreach ($students->pluck('batch_year')->unique() as $year)
                                                            <a class="dropdown-item" href="#"
                                                                data-widget="iframe-close">{{ $year }}</a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="batch_year_selected" name="batch_year_selected">
                                        <div class="form-group row align-items-center">
                                            <p for="subject" class="col-sm-2 control-label"><b
                                                    style="color:#1f3c88;">Subject:</b></p>
                                            <div class="col-sm-10">
                                                <textarea type="text" name="subject" class="form-control" id="subject"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <p for="greet" class="col-sm-2 control-label"><b
                                                    style="color:#1f3c88;">Greetings:</b></p>
                                            <div class="col-sm-10">
                                                <textarea type="text" name="greet" class="form-control" id="greet"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <p for="intro" class="col-sm-2 control-label"><b
                                                    style="color:#1f3c88;">Introduction:</b></p>
                                            <div class="col-sm-10">
                                                <textarea type="text" name="intro" class="form-control" id="intro"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <p for="body" class="col-sm-2 control-label"><b
                                                    style="color:#1f3c88;">Body:</b></p>
                                            <div class="col-sm-10">
                                                <textarea type="text" name="body" class="form-control" id="body"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <p for="conclusion" class="col-sm-2 control-label"><b
                                                    style="color:#1f3c88;">Conclusion:</b></p>
                                            <div class="col-sm-10">
                                                <textarea type="text" name="conclusion" class="form-control" id="conclusion"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center mb-0">
                                            <p for="attachment" class="col-sm-2 control-label"><b
                                                    style="color:#1f3c88;">Attachment/s:</b></p>
                                            <div class="col-sm-10">
                                                <input name="attachment" id="attachment" type="file" accept="*">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10 offset-sm-2">
                                                <a href="#">Preview Message</a>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10 offset-sm-2">
                                                <button class="btn float-right" type="submit">Send</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('assets.asst-loading-spinner')
@endsection
