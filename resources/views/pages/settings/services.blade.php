@extends('layouts.main')
@section('title', 'Dashboard')
@push('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-dark-menu/assets/css/widgets/modules-widgets.css') }}">
    <style>
        .loading {
            font-size: 30px;
            text-align: center;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
@endpush

<!-- Main content section -->
@section('content')
    {{-- <div class="layout-px-spacing"> --}}
    {{-- <div class="row analytics"> --}}
    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
        <div class="widget widget-five">
            <div class="widget-content">
                <div class="header">
                    <div class="header-body">
                        <h6>Scanner Service</h6>
                    </div>
                </div>
                @if ($serviceStatus !='running')
                    <div class="w-content" style="cursor: pointer;" id="scannerService">
                        <div>

                            <p id="loadStatusScanner" class="task-left"
                                style="color:red;width: 130px;height: 130px;padding: 35px 0px;border: 3px solid red;">
                                Restart</p>
                            <p class="text-danger" id="statusScannerText"><span>{{ $serviceStatus }}</span></p>
                            <div id="scannerProgress"class="progress-bar bg-primary progress-bar-striped progress-bar-animated"
                                role="progressbar" style="height: 10px; display: none ;width: 100%" aria-valuenow="20"
                                aria-valuemin="0" aria-valuemax="100"></div>

                        </div>
                    </div>
                @else
                    <div class="w-content" style="cursor: pointer;" id="scannerService">
                        <div>
                            <p id="loadStatusScanner" class="task-left"
                                style="color:#25d5e4;width: 130px;height: 130px;padding: 35px 0px;border: 3px solid blue;">
                                Restart</p>
                            <p class="text-normal" id="statusScannerText"><span>{{ $serviceStatus }}</span></p>
                            <div id="scannerProgress"class="progress-bar bg-primary progress-bar-striped progress-bar-animated"
                                role="progressbar" style="height: 10px; display: none ;width: 100%" aria-valuenow="20"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
        <div class="widget widget-five">
            <div class="widget-content">
                <div class="header">
                    <div class="header-body">
                        <h6>Logs</h6>
                    </div>
                </div>
                <div class="w-content">
                    <textarea class="form-control" rows="10">{{ $logs }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
        <div class="widget widget-five">
            <div class="widget-content">
                <div class="header">
                    <div class="header-body">
                        <h6>Machine State</h6>
                    </div>
                    <div class="task-action">
                        <div class="dropdown  custom-dropdown">
                            <a class="dropdown-toggle" href="#" role="button" id="pendingTask" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-more-horizontal">
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="19" cy="12" r="1"></circle>
                                    <circle cx="5" cy="12" r="1"></circle>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="w-content" style="text-align: left;">
                    <ul class="list-icon">
                        <li>
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9.6 20H14.4C18.4 20 20 18.4 20 14.4V9.6C20 5.6 18.4 4 14.4 4H9.6C5.6 4 4 5.6 4 9.6V14.4C4 18.4 5.6 20 9.6 20Z" stroke="#0073ff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M10.5 17H13.5C16 17 17 16 17 13.5V10.5C17 8 16 7 13.5 7H10.5C8 7 7 8 7 10.5V13.5C7 16 8 17 10.5 17Z" stroke="#0073ff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M8.01001 4V2" stroke="#0073ff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M12 4V2" stroke="#0073ff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M16 4V2" stroke="#0073ff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M20 8H22" stroke="#0073ff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M20 12H22" stroke="#0073ff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M20 16H22" stroke="#0073ff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M16 20V22" stroke="#0073ff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M12.01 20V22" stroke="#0073ff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M8.01001 20V22" stroke="#0073ff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M2 8H4" stroke="#0073ff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M2 12H4" stroke="#0073ff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M2 16H4" stroke="#0073ff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                            <span class="list-text">CPU {{$hwinfo['cpu']}}, {{$hwinfo['cpu_count']}} cores.</span>
                        </li>
                        <li>
                            <svg fill="#0073ff" height="200px" width="200px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 60.00 60.00" xml:space="preserve" stroke="#0073ff" stroke-width="0.0006000000000000001"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="1.56"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M39.145,3.103c-1.244,0.299-2.242,1.296-2.542,2.541c-0.293,1.215,0.051,2.461,0.922,3.331 c0.667,0.667,1.552,1.024,2.476,1.024c0.283,0,0.57-0.033,0.855-0.103c1.244-0.3,2.242-1.297,2.541-2.54 c0.293-1.215-0.052-2.46-0.922-3.331C41.605,3.155,40.361,2.81,39.145,3.103z M41.453,6.889c-0.124,0.513-0.551,0.94-1.065,1.064 C39.846,8.082,39.319,7.94,38.94,7.56c-0.38-0.38-0.522-0.907-0.392-1.448c0.124-0.514,0.552-0.941,1.065-1.064 C39.744,5.016,39.874,5,40.001,5c0.399,0,0.772,0.152,1.06,0.439C41.44,5.819,41.583,6.347,41.453,6.889z"></path> <path d="M36.603,52.644c-0.293,1.215,0.051,2.461,0.922,3.331c0.667,0.667,1.552,1.024,2.476,1.024 c0.283,0,0.57-0.033,0.855-0.103c1.244-0.3,2.242-1.297,2.541-2.54c0.293-1.215-0.052-2.46-0.922-3.331 c-0.87-0.869-2.114-1.214-3.33-0.923C37.901,50.401,36.903,51.398,36.603,52.644z M40.001,52c0.399,0,0.772,0.152,1.06,0.439 c0.379,0.38,0.522,0.907,0.392,1.449c-0.124,0.513-0.551,0.94-1.065,1.064c-0.542,0.127-1.069-0.012-1.448-0.393 c-0.38-0.38-0.522-0.907-0.392-1.448c0.124-0.514,0.552-0.941,1.065-1.064C39.744,52.016,39.874,52,40.001,52z"></path> <path d="M43.405,0H27.5v1c0,1.103-0.897,2-2,2s-2-0.897-2-2V0h-3h-2h-5v5h2v50h-2v5h5h2h3v-1c0-1.103,0.897-2,2-2s2,0.897,2,2v1 h15.905c1.707,0,3.095-1.389,3.095-3.096V3.096C46.5,1.389,45.111,0,43.405,0z M18.5,58h-3v-1h2V3h-2V2h3V58z M44.5,11h-5v2h5v1 h-5v2h5v1h-5v2h5v1h-5v2h5v1h-5v2h5v1h-5v2h5v1h-5v2h5v1h-5v2h5v1h-5v2h5v1h-5v2h5v1h-5v2h5v1h-5v2h5v1h-5v2h5v7.904 c0,0.604-0.491,1.096-1.095,1.096H29.374c-0.445-1.724-2.013-3-3.874-3s-3.428,1.276-3.874,3H20.5V2h1.126 c0.445,1.724,2.013,3,3.874,3s3.428-1.276,3.874-3h14.031C44.009,2,44.5,2.491,44.5,3.096V11z"></path> <path d="M32.5,6h-2v2h-1V6h-2v2h-1V6h-2v2h-2v8h2v2h2v-2h1v2h2v-2h1v2h2v-2h2V8h-2V6z M32.5,14h-8v-4h8V14z"></path> <path d="M32.5,42h-2v2h-1v-2h-2v2h-1v-2h-2v2h-2v8h2v2h2v-2h1v2h2v-2h1v2h2v-2h2v-8h-2V42z M32.5,50h-8v-4h8V50z"></path> <path d="M32.5,24h-2v2h-1v-2h-2v2h-1v-2h-2v2h-2v8h2v2h2v-2h1v2h2v-2h1v2h2v-2h2v-8h-2V24z M32.5,32h-8v-4h8V32z"></path> </g> </g> </g></svg>
                            <span class="list-text">Ram {{$hwinfo['ram']['human_total']}} total, with {{$hwinfo['ram']['human_free']}} free.</span>
                        </li>
                        <li>
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M5 9V5C5 3.89543 5.89543 3 7 3H17C18.1046 3 19 3.89543 19 5V9M5 9H19M5 9V15M19 9V15M19 15V19C19 20.1046 18.1046 21 17 21H7C5.89543 21 5 20.1046 5 19V15M19 15H5M8 12H8.01M8 6H8.01M8 18H8.01" stroke="#0073ff" stroke-width="0.8399999999999999" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                            <span class="list-text">Disk {{$hwinfo['disk']['human_total']}} total, with {{$hwinfo['disk']['human_free']}} free.</span>
                        </li>
                        <li>
                            <svg height="200px" width="200px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#0073ff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:#0073ff;} </style> <g> <path class="st0" d="M165.334,217.207l55.888,43.111c2.151,17.38,16.802,30.896,34.778,30.896c19.453,0,35.214-15.77,35.214-35.214 c0-0.754-0.174-1.452-0.222-2.198l81.904-96.896c5.722-6.413,5.818-15.651,0.246-20.604c-5.579-4.968-14.73-3.777-20.436,2.635 l-80.485,85.984c-4.873-2.556-10.341-4.135-16.222-4.135c-6.302,0-12.126,1.786-17.238,4.683l-52.626-36.643 c-6.786-5-16.961-2.683-22.715,5.159C157.683,201.809,158.524,212.214,165.334,217.207z"></path> <path class="st0" d="M256,0c-11.222,0-20.317,9.096-20.317,20.318c0,11.222,9.096,20.317,20.317,20.317 c59.54,0.008,113.246,24.072,152.286,63.079c39.008,39.032,63.072,92.746,63.079,152.286 c-0.007,59.54-24.071,113.246-63.079,152.286c-39.04,39.008-92.746,63.071-152.286,63.079 c-59.539-0.008-113.254-24.072-152.285-63.079C64.707,369.246,40.643,315.54,40.635,256c0.008-43.262,12.77-83.436,34.699-117.15 l18.857,14.094c2.04,1.524,4.738,1.905,7.127,1c2.381-0.904,4.159-2.944,4.683-5.452l12.69-60.023 c2.262-3.882,3.23-8.342,2.682-12.723l5.738-27.127c0.611-2.856-0.508-5.794-2.834-7.548c-2.342-1.738-5.476-1.976-8.048-0.579 l-89.786,48.54c-2.254,1.23-3.722,3.5-3.904,6.047c-0.191,2.54,0.936,5.016,2.984,6.548l17.174,12.833 C15.746,155.016-0.007,203.706,0,256c0.016,141.396,114.604,255.984,256,256c141.397-0.016,255.985-114.604,256-256 C511.985,114.604,397.397,0.016,256,0z"></path> </g> </g></svg>
                            <span class="list-text">Uptime {{$uptime}}</span>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
    {{-- </div> --}}
    {{-- </div> --}}
@endsection

<!-- Push some script information to the layout -->
@push('script')
    <script>
        function setScannerStatusInactive() {
            $("#loadStatusScanner").css({
                "color": "red",
                "border": "3px solid red"
            });
            $("#loadStatusScanner").text("Restart");
            $("#scannerProgress").hide();
            $("#statusScannerText").text("Failed !");
            $("#statusScannerText").css("color", "red");
            $("#scannerService").css("cursor", "pointer");
            $("#scannerService").on("click", disableClickScanner);
        }

        function setScannerStatusActive() {
            $("#loadStatusScanner").css({
                "color": "#25d5e4",
                "border": "3px solid blue"
            });
            $("#loadStatusScanner").text("Restart");
            $("#scannerProgress").hide();
            $("#statusScannerText").text("running");
            $("#statusScannerText").css("color", "#fff");
            $("#scannerService").css("cursor", "pointer");
            $("#scannerService").on("click", disableClickScanner);
        }

        function disableClickScanner() {
            $("#loadStatusScanner").text("Loading");
            $("#scannerProgress").show();
            $("#statusScannerText").text("Restarting");
            $("#scannerService").css("cursor", "initial");
            $("#scannerService").off("click", disableClickScanner);
            $.ajax({
                url: "/settings/services/restart",
                type: "POST",
                data: {
                    service: 'scanner',
                    _token: $("#_token").val()
                },
                success: function(response) {
                    console.log("Response",response);
                    if (response.result === "OK") {
                        if (response.data.status === "running") {
                            setScannerStatusActive();
                        }else{
                            setScannerStatusInactive();
                        }
                    }else{
                        setScannerStatusInactive();
                    }
                },
                error: function(xhr) {
                    setScannerStatusInactive();
                }
            })
        }
        $("#scannerService").on("click", disableClickScanner);

        function disableClickIngester() {
            $("#loadStatusIngester").text("Loading");
            $("#ingesterProgress").show();
            $("#statusIngesterText").text("Restarting");
            $("#ingesterService").css("cursor", "initial");
            $("#ingesterService").off("click", disableClickIngester);
        }
        $("#ingesterService").on("click", disableClickIngester);
    </script>
@endpush
