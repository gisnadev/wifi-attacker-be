@extends('layouts.main')
@section('title', 'Normal Ap')
@section('content')
<!-- push external head elements to head -->
@push('head')


@endpush

<div id="content">
    <div class="layout-px-spacing">
        <div class="">
            <div class="row mb-4 mt-4 d-none d-md-block d-lg-block d-xl-block">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                        <div class="card-header">
                            <h4>Rouge Ap's</h4>
                            <div class="card-header-right">
                                <ul class="list-unstyled card-option">
                                    <li><i class="ik ik-chevron-left action-toggle"></i></li>
                                    <li><i class="ik ik-minus minimize-card"></i></li>
                                    <li><i class="ik ik-x close-card"></i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="mb-4 mt-4">
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
                            <h5 class="">Rouge Ap's</h5>
                        </div>
                        <div class="my-3 d-flex justify-content-center" >
                            <form action="/rouge-ap/search" method="GET" >
                                <input class="rounded p-2 border-0" style="background-color: #1b2e4b; color: white" type="text" name="search" placeholder="Search SSID" value="{{old('search')}}">
                                <input class="rounded p-2 border-0" style="background-color: #506690; color: white" type="submit" value="Search"> 
                            </form>
                        </div>
                        @foreach ($rouge_ap as $r)
                        <div class="widget-content border p-3">
                            <div class="">
                                <div class="">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-secondary p-2 rounded-circle " style="height: max-content;">
                                            <div class="icon">
                                            @if ($r->attackmode == "suspect")
                                                <i data-feather="alert-triangle" class="text-lg"></i>
                                            @elseif ($r->attackmode == "eviltwin")
                                                <i data-feather="x" class="text-lg"></i>
                                            @elseif ($r->attackmode == "cracking")
                                                <i data-feather="x" class="text-lg"></i>
                                            @else
                                                <i data-feather="check" class="text-lg"></i>
                                            @endif
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <h5>{{$r->ssid}}</h5>
                                            @if ($r->attackmode == "suspect")
                                            <p class="meta-date">Not Secure</p>
                                            @elseif ($r->attackmode == "eviltwin")
                                            <p class="meta-date">Rogue AP</p>
                                            @elseif ($r->attackmode == "cracking")
                                            <p class="meta-date">Cracking</p>
                                            @else
                                            <p class="meta-date">Normal</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="t-rate rate-dec d-flex justify-content-end">
                                        <a href="wifi/inspect/{{$r->id}} " class="text-primary">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="pt-3 d-flex justify-content-center" >
                            {{ $rouge_ap->links('pagination::simple-bootstrap-4') }}
                        </div>
                    </div>
                </div>

        </div>
    </div>
</div>

@push('script')
<script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>


<script src="{{ asset('modern-dark-menu/assets/js/scrollspyNav.js')}}"></script>
<script src="{{ asset('modern-dark-menu/plugins/apex/apexcharts.min.js')}}"></script>
<script src="{{ asset('modern-dark-menu/plugins/apex/custom-apexcharts.js')}}"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="{{ asset('plugins/DataTables/datatables.min.js') }} " defer></script>

<script>
    $(document).ready(function () {
    
    $('#tbl_list').DataTable({
         processing: false,
         serverSide: false,
         ajax: '{{ route('rouge-ap') }}',
         columns: [
             { data: 'ssid', name: 'ssid' },
             { data: 'channel', name: 'channel' },
             { data: 'signal', name: 'signal' },
             {
                        data: 'updated_at',
                        name: 'updated_at',
                        render: function(data) {
                            var timeStamp = data;
                            var date = moment.utc(timeStamp).format("MM/DD/YYYY hh:mm:ss");
                            console.log("Tanggal", date);
                            return date;
                        }
                    },
             { data: 'attackmode', name: 'attackmode',
             render : function(data, type, row) {
                if (data == "suspect") {
                             return "Not Secure";
                         } else if (data == "eviltwin") {
                             return "Rogue AP";
                         } else if (data == "cracking") {
                             return "Cracking";
                         }
                        else {
                             return "Normal";
                         }
                     }
             }, 
             {data : 'id' , name:'id',
             render: function(data, type, row) {
                         return '<a type="button" href="wifi/inspect/' + data + '" class="btn btn-primary"><i class="ik ik-edit-2"></i>Inspect</a>&nbsp;<a style="display:none;" type="button" class="btn btn-warning"><i class="ik ik-crosshair"></i>Attack</a>';
                     }
             }
         ]
     });
    });
</script>
@endpush

@endsection