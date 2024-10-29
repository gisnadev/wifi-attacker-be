@extends('layouts.main')
@section('title', 'Users')
@section('content')
<!-- push external head elements to head -->
@push('head')
<link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush


<div id="content">
    <div class="layout-px-spacing">
        <div class="">
            <!-- start message area-->
            @include('include.message')
            <!-- end message area-->
            <div class="row mb-4 mt-4  d-none d-md-block d-lg-block d-xl-block">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                        <div class="card-header">
                            <h4>Users</h4>
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Telegram</th>
                                        <th>Created</th>
                                        <th>Updated</th>
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
                            <h5 class="">Users</h5>
                        </div>
                        <div class="my-3 d-flex justify-content-center">
                            <form action="/user/search" method="GET">
                                <input class="rounded p-2 border-0" style="background-color: #1b2e4b; color: white" type="text" name="search" placeholder="Search Name" value="{{old('search')}}">
                                <input class="rounded p-2 border-0" style="background-color: #506690; color: white" type="submit" value="Search">
                            </form>
                        </div>
                        @foreach ($user as $u)
                        <div class="widget-content border p-3">
                            <div class="">
                                <div class="">
                                    <div class="d-flex align-items-center">
                                        <div class="ml-3">
                                            <h5>{{$u->name}}</h5>
                                            <p class="meta-date">{{$u->email}}</p>
                                        </div>
                                    </div>
                                    <div class="t-rate rate-dec d-flex justify-content-end">
                                        <a href="/user/detail/{{$u->id}} " class="text-primary mx-1">Detail</a>
                                        <a href="/user/{{$u->id}} " class="text-primary mx-1">Edit</a>
                                        <a href="/user/delete/{{$u->id}} " class="text-primary mx-1">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="pt-3 d-flex justify-content-center">
                            {{ $user->links('pagination::simple-bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
<!-- push external js -->
@push('script')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="{{ asset('plugins/DataTables/datatables.min.js') }} " defer></script>
<script src="{{ asset('modern-dark-menu/plugins/select2/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#tbl_list').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('users') }}',
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data:'telegramid',
                    name:'telegram'
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    render: function(data) {
                        var a = new Date(data);
                        var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                        var year = a.getFullYear();
                        var month = months[a.getMonth()];
                        var date = a.getDate();
                        var hour = a.getHours();
                        var min = a.getMinutes();
                        var sec = a.getSeconds();
                        var time = date + ' ' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec;
                        return time;
                    }
                },
                {
                    data: 'updated_at',
                    name: 'updated_at',
                    render: function(data) {
                        var a = new Date(data);
                        var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                        var year = a.getFullYear();
                        var month = months[a.getMonth()];
                        var date = a.getDate();
                        var hour = a.getHours();
                        var min = a.getMinutes();
                        var sec = a.getSeconds();
                        var time = date + ' ' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec;
                        return time;
                    }
                },
                {
                    data: 'id',
                    name: 'id',
                    render: function(data) {
                        // return '<a href="user/detail/' + data + '" class=""><i data-feather="eye"></i></a>';
                        return '<a href = "user/detail/' + data + '" class="bg-primary px-2 py-1 mx-1 rounded"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a>' +
                            '<a href = "user/' + data + '" class="bg-warning px-2 py-1 mx-1 rounded"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a>' +
                            '<a href = "user/delete/' + data + '" class="bg-warning px-2 py-1 mx-1 rounded"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a>'

                    }
                }
            ]
        });
        console.log("fdahgda");
    });
</script>
@endpush
@endsection