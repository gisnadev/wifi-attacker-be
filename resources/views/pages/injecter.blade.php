@extends('layouts.main')
@section('title', 'Injecter')
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
                                <h6 class="value">Injecter</h6>
                                <p class="mt-3">Injecter</p>
                            </div>
                            <div class="">
                                <div class="w-icon">
                                    <i data-feather="wifi" class="text-lg"></i>
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

@endpush
@endsection