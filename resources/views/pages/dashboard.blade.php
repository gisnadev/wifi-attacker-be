@extends('layouts.main')
@section('title', 'Dashboard')
<!-- push external head elements to head -->
@push('head')
    {{-- <link href="{{ asset('modern-dark-menu/assets/css/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css" /> --}}

    <link href="{{ asset('modern-dark-menu/assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')

    <div id="content">
        <div class="layout-px-spacing">
            <div class="">
                <div class="d-flex">    
                    @if($lastCampaign && $lastCampaign->status == 'active')                
                        <a href="/campaign-stop" class="btn btn-danger " style=" margin-right:20px"  >STOP</a>
                    @elseif($lastCampaign && $lastCampaign->status == 'inactive')
                        <button type="submit" class="btn btn-primary " style=" margin-right:20px"  data-toggle="modal" data-target="#modal" >Create Campaign</button>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                List Campaign
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @if($campaign->count() > 0)
                                    @foreach ($campaign as $c)
                                    <div class="d-flex">
                                        <a class="dropdown-item" href="/campaign/select/{{$c->id}}?id={{$c->id}}">{{$c->name}}</a>
                                        <form action="/campaign-delete/{{$c->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')                                           
                                            <button  type="submit" onMouseOver="this.style.color='blue'"onMouseOut="this.style.color='red'"  style="margin-left: 10px; color: red;margin-top:10px; cursor: pointer; font-weight: bold; border: none; background-color: #1b2e4b;">X</button>                         
                                        </form>
                                    </div>
                                    @endforeach
                                @else
                                    <a class="dropdown-item">No campaigns available</a>
                                @endif
                            </div>
                        </div>
                    @else
                        <button type="submit" class="btn btn-primary " style=" margin-right:20px"  data-toggle="modal" data-target="#modal" >Create Campaign</button>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                List Campaign
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <p class="dropdown-item">No campaigns available</p>
                            </div>
                        </div>
                    @endif

                </div>
                <div class="modal fade " style="margin-top:200px" id="modal" role="dialog" arialabelledby="modalLabel" area-hidden="true">
                    <div class="modal-dialog " role="document">
                        <div class="d-flex justify-content-end">
                            <button style="cursor: pointer;" class="bg-transparent text-white border border-light">X</button>
                        </div>
                        <div class="modal-content d-flex justify-content-end">
                            <div class="modal-header bg-secondary d-flex flex-column ">
                                <form action="campaign" method="post" class="d-flex flex-column" style="width:100%;">
                                @csrf
                                    <input type="text" name="name" class="rounded rounded-3" style="margin-bottom: 20px; padding:10px ;width:100%" name="name" placeholder="Campaign Name">
                                    <button class="bg-primary rounded rounded-3" style="padding:5px; width: 100%;" type="submit">Start Campaign</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4 mt-4">
                    <div class="col-lg-3 col-md-5 col-sm-10 my-2">
                        <div class="widget bg-primary">
                            <div class="widget-body p-4 d-flex justify-content-between align-items-center">
                                <div class=" d-flex ">
                                    <div class="p-2 bg-dark rounded rounded-3">
                                        <i data-feather="check" class="text-lg"></i>
                                    </div>
                                </div>
                                <h5 class="text-center">{{ __('Normal') }}</h5>
                                <h2 class="text-center" id="normalText"></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-5 col-sm-10 my-2">
                        <div class="widget bg-secondary">
                            <div class="widget-body p-4 d-flex justify-content-between align-items-center">
                                <div class=" d-flex ">
                                    <div class="p-2 bg-dark rounded rounded-3">
                                        <i data-feather="smartphone" class="text-lg"></i>
                                    </div>
                                </div>
                                <h5 class="text-center">{{ __('Client') }}</h5>
                                <h2 class="text-center" id="clientText"></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 my-2">
                        <div class="widget bg-warning">
                            <div class="widget-body p-4 d-flex justify-content-between align-items-center">
                                <div class=" d-flex ">
                                    <div class="p-2 bg-dark rounded rounded-3">
                                        <i data-feather="alert-triangle" style="font-size: 50px;"></i>
                                    </div>
                                </div>
                                <h5 class="text-center">{{ __('Not Secure') }}</h5>
                                <h2 class="text-center" id="openText"></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 my-2">
                        <div class="widget bg-danger">
                            <div class="widget-body p-4 d-flex justify-content-between align-items-center">
                                <div class=" d-flex ">
                                    <div class="p-2 bg-dark rounded rounded-3">
                                        <i data-feather="x"></i>
                                    </div>
                                </div>
                                <h5 class="text-center">{{ __('Rogue AP') }}</h5>
                                <h2 class="text-center" id="rogueText"></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-5 col-sm-10 my-2">
                        <div class="widget bg-success">
                            <div class="widget-body p-4 d-flex justify-content-between align-items-center">
                                <div class=" d-flex ">
                                    <div class="p-2 bg-dark rounded rounded-3">
                                        <i data-feather="crosshair"></i>
                                    </div>
                                </div>
                                <h5 class="text-center">{{ __('Deauths') }}</h5>
                                <h2 class="text-center" id="deauthText"></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div id="chartBar" class="col-xl-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h3 class="p-4">Wifi Scan </h3>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div id="chartloading">Loading for data</div>
                                <canvas id="myChart" style=" padding:30px;display: none;"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing  d-none d-md-block d-lg-block d-xl-block">
                        <div class="widget-content widget-content-area br-6">
                            <div class="">
                                <h4>{{ __('Wifi Table') }}</h4>
                                <div class="card-header-right">
                                    <ul class="list-unstyled card-option">
                                        <li><i class="ik ik-chevron-left action-toggle"></i></li>
                                        <li><i class="ik ik-minus minimize-card"></i></li>
                                        <li><i class="ik ik-x close-card"></i></li>
                                    </ul>
                                </div>
                            </div>
                            <div class=" mb-4 mt-4">
                                <table id="tbl_list" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>SSID</th>
                                            <th>Channel</th>
                                            <th>RSSI</th>
                                            <th>Last Scan</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row sales d-block d-md-none d-lg-none d-xl-none">
                    <div class="col-xl-5 col-lg-12 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="widget-heading">
                                <h5 class="">Wifi List</h5>
                            </div>
                            <div class="my-3 d-flex justify-content-center">
                                <form action="/wifi/search" method="GET">
                                    <input class="rounded p-2 border-0" style="background-color: #1b2e4b; color: white"
                                        type="text" name="search" placeholder="Search SSID"
                                        value="{{ old('search') }}">
                                    <input class="rounded p-2 border-0" style="background-color: #506690; color: white"
                                        type="submit" value="Search">
                                </form>
                            </div>
                            @foreach ($wifi as $w)
                                <div class="widget-content border p-3">
                                    <div class="">
                                        <div class="">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-secondary p-2 rounded-circle "
                                                    style="height: max-content;">
                                                    <div class="icon">
                                                        @if ($w->attackmode == 'suspect')
                                                            <i data-feather="alert-triangle" class="text-lg"></i>
                                                        @elseif ($w->attackmode == 'eviltwin')
                                                            <i data-feather="x" class="text-lg"></i>
                                                        @elseif ($w->attackmode == 'cracking')
                                                            <i data-feather="x" class="text-lg"></i>
                                                        @else
                                                            <i data-feather="check" class="text-lg"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="ml-3">
                                                    @if ($w->ssid != '')
                                                        <h5>{{ $w->ssid }}</h5>
                                                    @else
                                                        <h5>Hidden</h5>
                                                    @endif

                                                    @if ($w->attackmode == 'suspect')
                                                        <p class="meta-date">Not Secure</p>
                                                    @elseif ($w->attackmode == 'eviltwin')
                                                        <p class="meta-date">Rogue AP</p>
                                                    @elseif ($w->attackmode == 'cracking')
                                                        <p class="meta-date">Cracking</p>
                                                    @else
                                                        <p class="meta-date">Normal</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="t-rate rate-dec d-flex justify-content-end">
                                                <a href="wifi/inspect/{{ $w->id }} "
                                                    class="text-primary">Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="pt-3 d-flex justify-content-center">
                                {{ $wifi->links('pagination::simple-bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('modern-dark-menu/assets/js/scrollspyNav.js') }}"></script>
        <script src="{{ asset('plugins/DataTables/datatables.min.js') }} " defer></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

        <!-- Chart JS -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://code.jquery.com/jquery-2.2.4.js"integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="crossorigin="anonymous"></script>



        <script type="text/javascript">
            $(document).ready(function() {
                function updateChartData(chart, label, data) {
                    chart.data.labels.push(label);
                    chart.data.datasets.forEach((dataset) => {
                        dataset.data.push(data);
                    });
                    $("#chartloading").hide();
                    $("#myChart").show();
                    chart.update();

                }
                const ctx = document.getElementById('myChart').getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'radar',
                    data: {
                        labels: [],
                        datasets: [{
                            label: '',
                            data: [],
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgb(54, 162, 235)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                    }
                });


                function wifiTable() {
                    $('#tbl_list').DataTable({
                        order: [
                            [3, 'desc']
                        ],
                        processing: true,
                        destroy: true,
                        serverSide: false,
                        ajax: '{{ route('dashboard') }}',
                        columns: [{
                                data: 'ssid',
                                name: 'ssid',
                                render: function(data) {
                                    if (data != "") {
                                        return data;
                                    } else {
                                        return "Hidden";
                                    }
                                }
                            },
                            {
                                data: 'channel',
                                name: 'channel'
                            },
                            {
                                data: 'signal',
                                name: 'signal'
                            },
                            {
                                data: 'updated_at',
                                name: 'updated_at',
                                render: function(data) {
                                    var timeStamp = data;
                                    var date = moment.utc(timeStamp).format("MM/DD/YYYY hh:mm:ss");
                                    return date;
                                }
                            },
                            {
                                data: 'attackmode',
                                name: 'attackmode',
                                render: function(data, type, row) {
                                    if (data == "suspect") {
                                        return "Not Secure";
                                    } else if (data == "eviltwin") {
                                        return "Rogue AP";
                                    } else if (data == "cracking") {
                                        return "Cracking";
                                    } else {
                                        return "Normal";
                                    }
                                }
                            },
                            {
                                data: 'id',
                                name: 'id',
                                render: function(data, type, row) {
                                    return '<a type="button" href="wifi/inspect/' + data +
                                        '" class="btn btn-primary"><i class="ik ik-edit-2"></i>Inspect</a>&nbsp;<a style="display:none;" type="button" class="btn btn-warning"><i class="ik ik-crosshair"></i>Attack</a>';
                                }
                            }
                        ]
                    });
                }



                function getRecentData(renderType) {
                    $.ajax({
                        type: 'GET',
                        url: '/wifi/recent',
                        success: function(data) {
                            if (data.status == "OK") {
                                deauthNumber = data.data.deauths.length;
                                $("#deauthText").text(deauthNumber);
                                $("#deauthLoading").removeClass("ik-refresh-ccw");


                                normalDevicesNumber = 0;
                                data.data.devices.forEach(element => {
                                    if (element.attackmode == "normal") {
                                        normalDevicesNumber = normalDevicesNumber + 1;
                                    }
                                });
                                clientsNumber = data.data.clients.length;
                                $("#clientText").text(clientsNumber);
                                $("#normalText").text(normalDevicesNumber);
                                $("#normalLoading").removeClass("ik-refresh-ccw");

                                notSecureDevicesNumber = 0;
                                data.data.devices.forEach(element => {
                                    if (element.attackmode == "suspect") {
                                        notSecureDevicesNumber = notSecureDevicesNumber + 1;
                                    }
                                });
                                $("#openText").text(notSecureDevicesNumber);
                                $("#opemLoading").removeClass("ik-refresh-ccw");

                                rogueDevicesNumber = 0;
                                data.data.devices.forEach(element => {
                                    if (element.attackmode == "eviltwin") {
                                        rogueDevicesNumber = rogueDevicesNumber + 1;
                                    }
                                });
                                $("#rogueText").text(rogueDevicesNumber);
                                $("#rogueLoading").removeClass("ik-refresh-ccw");
                                if (renderType === 1) {
                                    data.data.devices.forEach(element => {
                                        if (element.ssid != "") {
                                            ssid = element.ssid;
                                        } else {
                                            ssid = "Hidden";
                                        }
                                        
                                        updateChartData(myChart, ssid, element.signal)
                                    });
                                    wifiTable();
                                } else if (renderType === 2) {
                                    data.data.devices.forEach(element => {
                                        if (element.ssid != "") {
                                            ssid = element.ssid;
                                        } else {
                                            ssid = "Hidden";
                                        }
                                        updateChartData(myChart, ssid, element.signal)
                                    });
                                    wifiTable();

                                }
                            }
                        }
                    });
                }
                getRecentData(1);
                window.Echo.channel('DeviceChannel')
                    .listen('.DeviceMessage', function (e) {
                        // setInterval(function() {
                                getRecentData(2);
                                console.log("Listen Event")
                            // }, 2000);
                })
            });
        </script>


        <script src="//{{ Request::getHost() }}:{{ env('LARAVEL_ECHO_PORT') }}/socket.io/socket.io.js"></script>
        <script src="{{ url('/js/echo.js') }}" type="text/javascript"></script>
        <!-- <script>
            window.Echo.channel('WifiFlag')
                .listen('WifiFlag', function(e) {
                    getRecentData(2);
                });
        </script> -->
    @endpush
@endsection
