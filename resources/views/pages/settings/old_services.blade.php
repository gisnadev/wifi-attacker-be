@extends('layouts.main')
@section('title', 'Settings Services')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-dark-menu/assets/css/widgets/modules-widgets.css') }}">
@endpush
@section('content')
    <div class="layout-px-spacing">
        <div class="row analytics">
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                <div class="widget widget-five">
                    <div class="widget-content">
                        <div class="header">
                            <div class="header-body">
                                <h6>Scanner Service</h6>
                            </div>
                            <div class="task-action">
                                <div class="dropdown  custom-dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" id="pendingTask"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-more-horizontal">
                                            <circle cx="12" cy="12" r="1"></circle>
                                            <circle cx="19" cy="12" r="1"></circle>
                                            <circle cx="5" cy="12" r="1"></circle>
                                        </svg>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="pendingTask">
                                        <a class="dropdown-item" href="javascript:void(0);">Add</a>
                                        <a class="dropdown-item" href="javascript:void(0);">View</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Clear All</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="w-content">
                            <div class="">
                                <p class="task-left" style="width: 130px;height: 130px;padding: 35px 0px;">Restart</p>
                                <p class="task-hight-priority"><span>Running</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @push('script')
    @endpush