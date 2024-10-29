@extends('layouts.main')
@section('title', 'Deauth')
@section('content')
<!-- push external head elements to head -->
@push('head')


@endpush

<div id="content">
    <div class="layout-px-spacing">
        <div class="">
            <div class="row mb-4 mt-4  d-none d-md-block d-lg-block d-xl-block">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                        <div class="card-header">
                            <h4>Deauth's</h4>
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
                                        <th>ADDR 1</th>
                                        <th>ADDR 2</th>
                                        <th>ADDR 3</th>
                                        <th>Reason</th>
                                        <th>RSSI</th>
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
                            <h5 class="">Deauth</h5>
                        </div>
                        <div class="my-3 d-flex justify-content-center" >
                            <form action="/user/search" method="GET" >
                                <input class="rounded p-2 border-0" style="background-color: #1b2e4b; color: white" type="text" name="search" placeholder="Search Addr" value="{{old('search')}}">
                                <input class="rounded p-2 border-0" style="background-color: #506690; color: white" type="submit" value="Search"> 
                            </form>
                        </div>
                        @foreach ($deauth as $d)
                        <div class="widget-content border p-3">
                            <div class="">
                                <div class="">
                                    <div class="d-flex align-items-center">
                                        <div class="ml-3">
                                            <h5>{{$d->addr1}}</h5>
                                            <p class="meta-date">{{$d->signal}}</p>
                                        </div>
                                    </div>
                                    <div class="t-rate rate-dec d-flex justify-content-end">
                                        <a href="/deauth/detail/{{$d->id}} " class="text-primary mx-1">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="pt-3 d-flex justify-content-center" >
                            {{ $deauth->links('pagination::simple-bootstrap-4') }}
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
         ajax: '{{ route('deauth') }}',
         columns: [
             { data: 'addr1', name: 'addr1' },
             { data: 'addr2', name: 'addr2' },
             { data: 'addr3', name: 'addr3' },
             { data: 'reason', name: 'reason'},
             { data: 'signal', name: 'signal'}, 
             {data : 'id' , name:'id',
             render: function(data, type, row) {
                         return '<a type="button" href="deauth/detail/' + data + '" class="btn btn-primary"><i class="ik ik-edit-2"></i>Inspect</a>';
                     }
             }
         ]
     });
    });
</script>
@endpush

@endsection