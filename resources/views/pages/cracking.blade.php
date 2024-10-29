@extends('layouts.main')
@section('title', 'Cracking')
@section('content')
<!-- push external head elements to head -->
@push('head')


@endpush

<div id="content">
    <div class="layout-px-spacing">
        <div class="">
            <div class="row mb-4 mt-4">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                        <div class="card-header">
                            <h4>Cracking</h4>
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
         processing: true,
         serverSide: true,
         ajax: '{{ route('cracking') }}',
         columns: [
             { data: 'ssid', name: 'ssid' },
             { data: 'channel', name: 'channel' },
             { data: 'signal', name: 'signal' },
             { data: 'updated_at', name: 'updated_at',
             render : function(data){
                 var a = new Date(data * 1000);
                 var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
                 var year = a.getFullYear();
                 var month = months[a.getMonth()];
                 var date = a.getDate();
                 var hour = a.getHours();
                 var min = a.getMinutes();
                 var sec = a.getSeconds();
                 var time = date + ' ' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec ;
                 return time;
             } },
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