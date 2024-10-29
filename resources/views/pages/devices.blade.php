@extends('layouts.main')
@section('title', 'Devices')
@section('content')
<!-- push external head elements to head -->
@push('head')


@endpush

<div id="content mt-3">
    <div class="layout-px-spacing d-flex justify-content-center">
        <div class="" style="width: 350px;">
            <div class="statbox widget box box-shadow p-4 mt-4" style="background-color: #0e1726;">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4 class="text-center mt-4">Devices</h4>
                        </div>
                    </div>
                </div>
                <form class="widget-content px-2">
                    <div class="custom-control custom-radio my-2">
                        <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                        <label class="custom-control-label" for="customRadio1">Peer To Peer</label>
                    </div>
                    <div class="custom-control custom-radio my-2">
                        <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                        <label class="custom-control-label" for="customRadio2">LAN</label>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-primary mt-4">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('script')

@endpush

@endsection