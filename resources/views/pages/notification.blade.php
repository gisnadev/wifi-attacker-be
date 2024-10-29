@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')
<!-- push external head elements to head -->
@push('head')


@endpush
<div id="content mt-3">
    <div class="layout-px-spacing d-flex justify-content-center">
        <div class=""  style="width: 400px;">
            <div class="statbox widget box box-shadow p-4 mt-4" style="background-color: #0e1726;">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4 class="text-center mt-3">Notification</h4>
                        </div>
                    </div>
                </div>
                <form class="widget-content widget-content-area">
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                            <i data-feather="mail" class="text-lg"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" placeholder="Email" aria-label="notification" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                            <i data-feather="send" class="text-lg"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" placeholder="Telegram" aria-label="notification" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                            <i data-feather="slack" class="text-lg"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" placeholder="Slack" aria-label="notification" aria-describedby="basic-addon1">
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-primary mt-4">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('script')

@endpush

@endsection