@extends('layouts.main')
@section('title', 'Wifi')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
    @endpush

    <div id="content">
        <div class="layout-px-spacing">

            <!-- <div class="page-header">
                                    <div class="row align-items-end">
                                        <div class="col-lg-8">
                                            <div class="page-header-title">
                                                <i class="ik ik-wifi bg-blue"></i>
                                                <div class="d-inline">
                                                    <h5>{{ __('Wifi Inspection Page') }}</h5>
                                                    <span>Last Scan {{ $data->updated_at }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <nav class="breadcrumb-container" aria-label="breadcrumb">
                                                <ol class="breadcrumb">
                                                    <li class="breadcrumb-item">
                                                        <a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
                                                    </li>
                                                    <li class="breadcrumb-item">
                                                        <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                                                    </li>

                                                    <li class="breadcrumb-item active" aria-current="page">{{ __('Wifi Inspection') }}</li>

                                                </ol>
                                            </nav>
                                        </div>
                                    </div>
                                </div> -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-12 py-3 m-3" style="background-color:#0e1726">
                    <div class="widget widget-card-four">
                        <div class="widget-content">
                            <div class="w-content">
                                <div class="w-info">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="value">SSID</h6>
                                        <div class="">
                                            <div class="w-icon">
                                                <i data-feather="wifi" class="text-lg"></i>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($data->ssid != '')
                                        <p class="mt-3">{{ $data->ssid }}</p>
                                    @else
                                        <p class="mt-3">Hidden</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 py-3 m-3" style="background-color:#0e1726">
                    <div class="widget widget-card-four">
                        <div class="widget-content">
                            <div class="w-content">
                                <div class="w-info">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="value">BSSID</h6>
                                        <div class="">
                                            <div class="w-icon">
                                                <i data-feather="radio" class="text-lg"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-3">{{ $data->bssid }}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 py-3 m-3" style="background-color:#0e1726">
                    <div class="widget widget-card-four">
                        <div class="widget-content">
                            <div class="w-content">
                                <div class="w-info">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="value">Crypto</h6>
                                        <div class="">
                                            <div class="w-icon">
                                                <i data-feather="key" class="text-lg"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-3">{{ $data->crypto }}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 py-3 m-3" style="background-color:#0e1726">
                    <div class="widget widget-card-four">
                        <div class="widget-content">
                            <div class="w-content">
                                <div class="w-info">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="value">Status</h6>
                                        <div class="">
                                            <div class="w-icon">
                                                @if ($data->attackmode == 'suspect')
                                                    <i data-feather="alert-triangle" class="text-lg"></i>
                                                @elseif ($data->attackmode == 'eviltwin')
                                                    <i data-feather="x" class="text-lg"></i>
                                                @elseif ($data->attackmode == 'cracking')
                                                    <i data-feather="x" class="text-lg"></i>
                                                @else
                                                    <i data-feather="check" class="text-lg"></i>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @if ($data->attackmode == 'suspect')
                                        <p class="mt-3">Not Secure</p>
                                    @elseif ($data->attackmode == 'eviltwin')
                                        <p class="mt-3">Rouge Ap</p>
                                    @elseif ($data->attacmode == 'cracking')
                                        <p class="mt-3">Cracking</p>
                                    @else
                                        <p class="mt-3">Normal</p>
                                    @endif

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 py-3 m-3" style="background-color:#0e1726">
                    <div class="widget widget-card-four">
                        <div class="widget-content">
                            <div class="w-content">
                                <div class="w-info">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="value">Channel</h6>
                                        <div class="">
                                            <div class="w-icon">
                                                <i data-feather="cpu" class="text-lg"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-3">{{ $data->channel }}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                {{--<div class="col-lg-3 col-md-6 col-sm-12 py-3 m-3" style="background-color:#0e1726">
                    <div class="widget widget-card-four">
                        <div class="widget-content">
                            <div class="w-content">
                                <div class="w-info">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="value">RSSI</h6>
                                        <div class="" style="width: 50%;">
                                            <div class="d-flex justify-content-end">
                                                <div class="w-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-home">
                                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                                    </svg>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <p class="mt-3">{{ $data->signal }}</p>
                                    <div class="progress">
                                        <div class="progress-bar bg-gradient-secondary" role="progressbar"
                                            style="width:{{ 100 - $data->signal * -1 }}%" aria-valuenow="57"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>--}}
                <div class="col-lg-3 col-md-6 col-sm-12 py-3 m-3" style="background-color:#0e1726">
                    <div class="widget widget-card-four">
                        <div class="widget-content">
                            <div class="w-content">
                                <div class="w-info">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="value">Wifi Type</h6>
                                        <div class="" style="width: 50%;">
                                            <div class="d-flex justify-content-end">
                                                <div class="w-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-home">
                                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                                    </svg>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @if( $data->channel <= 14 )                                    
                                <p class="mt-3">2.4 GHz</p>
                                @else
                                <p class="mt-3">5 GHz</p>                                    
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12 py-3 m-3" style="background-color:#0e1726">
                    <div class="widget widget-card-four">
                        <div class="widget-content">
                            <div class="w-content">
                                <div class="w-info">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-3">Attack</h6>
                                        <div class="">
                                            <div class="w-icon">
                                                <i data-feather="target" class="text-lg"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        @if (!$deauthJobs or $deauthJobs->status == 'notstarted')
                                            <button id="attack-button" type="button" class="btn btn-danger">
                                                <i class="ik ik-crosshair"></i>Attack
                                            </button>
                                            <button id="stop-button" type="button" class="btn btn-primary"
                                                style="display:none;">
                                                <i class="ik ik-crosshair"></i>Stop
                                            </button>
                                        @elseif($deauthJobs and $deauthJobs->status == 'started')
                                            <button id="attack-button" type="button" class="btn btn-danger"
                                                style="display:none;">
                                                <i class="ik ik-crosshair"></i>Attack
                                            </button>
                                            <button id="stop-button" type="button" class="btn btn-primary">
                                                <i class="ik ik-crosshair"></i>Stop
                                            </button>
                                        @endif

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
                    $("#attack-button").click(function() {
                        $.post("/wifi/post/attack/$data->id", {
                                _token: "{{ csrf_token() }}",
                                target: "{{ $data->bssid }}",
                                channel: "{{ $data->channel }}",
                                id_campaign: "{{ $data->id_campaign }}",
                                pid: 10
                            },
                            function(status) {
                                console.log("attack",status.status);
                                if (status.status == "OK") {
                                    $("#attack-button").hide();
                                    $("#stop-button").show();
                                }
                            })
                    });
                    $("#stop-button").click(function() {
                        $.post("/wifi/post/pause", {
                                _token: "{{ csrf_token() }}",
                                target: "{{ $data->bssid }}",
                                channel: "{{ $data->channel }}",
                                pid: 10
                            },
                            function(status) {
                                console.log("stop",status.status);
                                if (status.status == "OK") {
                                    $("#attack-button").show();
                                    $("#stop-button").hide();
                                }
                            });
                    });
                </script>
            @endpush
        @endsection
