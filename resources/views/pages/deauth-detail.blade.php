@extends('layouts.main')
@section('title', 'Deauth')
@section('content')
<!-- push external head elements to head -->
@push('head')
<link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
@endpush

<div id="content">
    <div class="layout-px-spacing">
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-12 my-3 my-3">
                <div class="widget widget-card-four">
                    <div class="widget-content">
                        <div class="w-content">
                            <div class="w-info">
                                <h6 class="value">ADDR 1</h6>
                                <p class="mt-3">{{$data->addr1}}</p>
                            </div>
                            <div class="" style="width: 50%;">
                                <div class="d-flex justify-content-end">
                                    <div class="w-icon">
                                        <i data-feather="radio" class="text-lg"></i>
                                    </div>
                                </div>
                                <div class="pt-5 d-flex justify-content-end">
                                    @if(! $deauthJobs or $deauthJobs->status == "notstarted" )
                                    <button id="attack-button_1" type="button" class="btn btn-danger">
                                        <i class="ik ik-crosshair"></i>Attack
                                    </button>
                                    <button id="stop-button_1" type="button" class="btn btn-primary" style="display:none;">
                                        <i class="ik ik-crosshair"></i>Stop
                                    </button>
                                    @elseif($deauthJobs and $deauthJobs->status =="started")
                                    <button id="attack-button_1" type="button" class="btn btn-danger" style="display:none;">
                                        <i class="ik ik-crosshair"></i>Attack
                                    </button>
                                    <button id="stop-button_1" type="button" class="btn btn-primary">
                                        <i class="ik ik-crosshair"></i>Stop
                                    </button>
                                    @endif
                                </div> 
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 my-3">
                <div class="widget widget-card-four">
                    <div class="widget-content">
                        <div class="w-content">
                            <div class="w-info">
                                <h6 class="value">ADDR 2</h6>
                                <p class="mt-3">{{$data->addr2}}</p>
                            </div>
                            <div class="" style="width: 50%;">
                                <div class="d-flex justify-content-end">
                                    <div class="w-icon">
                                        <i data-feather="radio" class="text-lg"></i>
                                    </div>
                                </div>
                                <div class="pt-5 d-flex justify-content-end">
                                    @if(! $deauthJobs or $deauthJobs->status == "notstarted" )
                                    <button id="attack-button_2" type="button" class="btn btn-danger">
                                        <i class="ik ik-crosshair"></i>Attack
                                    </button>
                                    <button id="stop-button_2" type="button" class="btn btn-primary" style="display:none;">
                                        <i class="ik ik-crosshair"></i>Stop
                                    </button>
                                    @elseif($deauthJobs and $deauthJobs->status =="started")
                                    <button id="attack-button_2" type="button" class="btn btn-danger" style="display:none;">
                                        <i class="ik ik-crosshair"></i>Attack
                                    </button>
                                    <button id="stop-button_2" type="button" class="btn btn-primary">
                                        <i class="ik ik-crosshair"></i>Stop
                                    </button>
                                    @endif
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 my-3">
                <div class="widget widget-card-four">
                    <div class="widget-content">
                        <div class="w-content">
                            <div class="w-info">
                                <h6 class="value">ADDR 3</h6>
                                <p class="mt-3">{{$data->addr3}}</p>
                            </div>
                            <div class="" style="width: 50%;">
                                <div class="d-flex justify-content-end">
                                    <div class="w-icon">
                                        <i data-feather="radio" class="text-lg"></i>
                                    </div>
                                </div>
                                <div class="pt-5 d-flex justify-content-end">
                                    @if(! $deauthJobs or $deauthJobs->status == "notstarted" )
                                    <button id="attack-button_3" type="button" class="btn btn-danger">
                                        <i class="ik ik-crosshair"></i>Attack
                                    </button>
                                    <button id="stop-button_3" type="button" class="btn btn-primary" style="display:none;">
                                        <i class="ik ik-crosshair"></i>Stop
                                    </button>
                                    @elseif($deauthJobs and $deauthJobs->status =="started")
                                    <button id="attack-button_3" type="button" class="btn btn-danger" style="display:none;">
                                        <i class="ik ik-crosshair"></i>Attack
                                    </button>
                                    <button id="stop-button_3" type="button" class="btn btn-primary">
                                        <i class="ik ik-crosshair"></i>Stop
                                    </button>
                                    @endif
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 my-3">
                <div class="widget widget-card-four">
                    <div class="widget-content">
                        <div class="w-content">
                            <div class="w-info">
                                <h6 class="value">RSSI</h6>
                                <p class="mt-3">{{$data->signal}}</p>
                            </div>
                            <div class="" style="width: 50%;">
                                <div class="d-flex justify-content-end">
                                    <div class="w-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                        </svg>
                                    </div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width:{{100- $data->signal * (-1)}}%" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100"></div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 my-3">
                <div class="widget widget-card-four">
                    <div class="widget-content">
                        <div class="w-content">
                            <div class="w-info">
                                <h6 class="value">Flag</h6>
                                <p class="mt-3">{{$data->flag}}</p>
                            </div>
                            <div class="">
                                <div class="w-icon">
                                    <i data-feather="cpu" class="text-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 my-3">
                <div class="widget widget-card-four">
                    <div class="widget-content">
                        <div class="w-content">
                            <div class="w-info">
                                <h6 class="value">Reason</h6>
                                <p class="mt-3">{{$data->reason}}</p>
                            </div>
                            <div class="">
                                <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 my-3">
                <div class="widget widget-card-four">
                    <div class="widget-content">
                        <div class="w-content">
                            <div class="w-info">
                                <h6 class="value">Created</h6>
                                @if ($data->created_at != "")
                                <p class="mt-3">{{ Carbon\Carbon::createFromTimestamp($data->created_at)->toDateTimeString() }}</p>
                                @else 
                                <p class="mt-3">Date Null</p>
                                @endif                               
                            </div>
                            <div class="">
                                <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 my-3">
                <div class="widget widget-card-four">
                    <div class="widget-content">
                        <div class="w-content">
                            <div class="w-info">
                                <h6 class="value">Update</h6>
                                @if ($data->update_at != "")
                                <p class="mt-3">{{ Carbon\Carbon::createFromTimestamp($data->update_at)->toDateTimeString() }}</p>
                                @else 
                                <p class="mt-3">No Date Update</p>
                                @endif
                            </div>
                            <div class="">
                                <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script>

    $("#attack-button_1").click(function() {
        $("#attack-button_1").hide();
        $("#stop-button_1").show();

    });
    $("#stop-button_1").click(function() {
        $("#attack-button_1").show();
        $("#stop-button_1").hide();
    });

    $("#attack-button_2").click(function() {
        $("#attack-button_2").hide();
        $("#stop-button_2").show();

    });
    $("#stop-button_1").click(function() {
        $("#attack-button_2").show();
        $("#stop-button_2").hide();
    });

    $("#attack-button_3").click(function() {
        $("#attack-button_3").hide();
        $("#stop-button_3").show();

    });
    $("#stop-button_3").click(function() {
        $("#attack-button_3").show();
        $("#stop-button_3").hide();
    });
    // $("#attack-button_1").click(function() {
    //     $.post("/wifi/post/attack", {
    //             _token: "{{csrf_token()}}",
    //             target: "{{$data->bssid}}",
    //             channel: "{{$data->channel}}",
    //             pid: 10
    //         },
    //         function(data, status) {
    //             if (data.status == "OK") {
    //                 $("#attack-button_1").hide();
    //                 $("#stop-button_1").show();
    //             }else{
    //             }
    //         });
    // });
    // $("#stop-button_1").click(function() {
    //     $.post("/wifi/post/pause", {
    //             _token: "{{csrf_token()}}",
    //             target: "{{$data->bssid}}",
    //             channel: "{{$data->channel}}",
    //             pid: 10
    //         },
    //         function(data, status) {
    //             if (data.status == "OK") {
    //                 $("#attack-button_1").show();
    //                 $("#stop-button_1").hide();
    //             }
    //         });
    // });

    // $("#attack-button_2").click(function() {
    //     $.post("/wifi/post/attack", {
    //             _token: "{{csrf_token()}}",
    //             target: "{{$data->bssid}}",
    //             channel: "{{$data->channel}}",
    //             pid: 10
    //         },
    //         function(data, status) {
    //             if (data.status == "OK") {
    //                 $("#attack-button_2").hide();
    //                 $("#stop-button_2").show();
    //             }else{
    //             }
    //         });
    // });
    // $("#stop-button_2").click(function() {
    //     $.post("/wifi/post/pause", {
    //             _token: "{{csrf_token()}}",
    //             target: "{{$data->bssid}}",
    //             channel: "{{$data->channel}}",
    //             pid: 10
    //         },
    //         function(data, status) {
    //             if (data.status == "OK") {
    //                 $("#attack-button_2").show();
    //                 $("#stop-button_2").hide();
    //             }
    //         });
    // });

    // $("#attack-button_3").click(function() {
    //     $.post("/wifi/post/attack", {
    //             _token: "{{csrf_token()}}",
    //             target: "{{$data->bssid}}",
    //             channel: "{{$data->channel}}",
    //             pid: 10
    //         },
    //         function(data, status) {
    //             if (data.status == "OK") {
    //                 $("#attack-button_3").hide();
    //                 $("#stop-button_3").show();
    //             }else{
    //             }
    //         });
    // });
    // $("#stop-button_3").click(function() {
    //     $.post("/wifi/post/pause", {
    //             _token: "{{csrf_token()}}",
    //             target: "{{$data->bssid}}",
    //             channel: "{{$data->channel}}",
    //             pid: 10
    //         },
    //         function(data, status) {
    //             if (data.status == "OK") {
    //                 $("#attack-button_3").show();
    //                 $("#stop-button_3").hide();
    //             }
    //         });
    // });
    
</script>

@endpush
@endsection