@extends('layouts.main')
@section('title', 'User-Detail')
@section('content')
<!-- push external head elements to head -->
@push('head')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/widgets/modules-widgets.css') }}">
<style>

</style>

@endpush
    <div class="content" style="width: 100%">
        <div class="layout-px-spacing">
            <div class="row sales d-flex justify-content-center mt-5">
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">

                    <div class="widget widget-account-invoice-one p-5 " style="background-color: #1b2e4b;">

                        <div class="widget-heading">
                            <h5 class="font-weight-bold">Detail User</h5>
                        </div>

                        <div class="widget-content">
                            <div class="invoice-box">

                                <div class="acc-total-info mt-3" >
                                    <h5 class="text-center font-weight-bold"style="color: #009688;">{{$user->name}}</h5>
                                    <p class="text-center"style="color: #009688;">{{$user->email}}</p>
                                </div>

                                <div class="inv-detail mt-4">
                                    <div class="d-flex justify-content-between">
                                        <p class="font-weight-bold">Email Verified</p>
                                        <p style="color: #009688;">{{$user->email_verified_at}}</p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p class="font-weight-bold">Remember Token</p>
                                        <p style="color: #009688;">{{$user->remember_token}}</p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p class="font-weight-bold">Created</p>
                                        <p style="color: #009688;">{{$user->created_at}}</p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p class="font-weight-bold">Updated</p>
                                        <p style="color: #009688;">{{$user->updated_at}}</p>
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
<script src="{{ asset('plugins/apex/apexcharts.min.js') }}"></script>
<script src="{{ asset('modern-dark-menu/assets/js/widgets/modules-widgets.js') }}"></script>
@endpush
@endsection