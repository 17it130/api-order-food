@extends('admin.layouts.app')
@section('title', 'Dashboard')

@push('css')
    <!--  -->
@endpush

@section('content')
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat bg-primary text-white">
            <div class="card-body">
                <div class="mb-4">
                    <div class="float-left mini-stat-img mr-4">
                        <img src="assets/images/services-icon/01.png" alt="" >
                    </div>
                    <h5 class="font-16 text-uppercase mt-0 text-white-50">Orders</h5>
                    <h4 class="font-500">{{ $ordersCount }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat bg-primary text-white">
            <div class="card-body">
                <div class="mb-4">
                    <div class="float-left mini-stat-img mr-4">
                        <img src="assets/images/services-icon/02.png" alt="" >
                    </div>
                    <h5 class="font-16 text-uppercase mt-0 text-white-50">Revenue</h5>
                    <h4 class="font-500">{{ $sum }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat bg-primary text-white">
            <div class="card-body">
                <div class="mb-4">
                    <div class="float-left mini-stat-img mr-4">
                        <img src="assets/images/services-icon/03.png" alt="" >
                    </div>
                    <h5 class="font-16 text-uppercase mt-0 text-white-50">Total Foods</h5>
                    <h4 class="font-500">{{ $foodsCount }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat bg-primary text-white">
            <div class="card-body">
                <div class="mb-4">
                    <div class="float-left mini-stat-img mr-4">
                        <img src="assets/images/services-icon/04.png" alt="" >
                    </div>
                    <h5 class="font-16 text-uppercase mt-0 text-white-50">Total review</h5>
                    <h4 class="font-500">{{ $reviewsCount }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
    <!-- peity JS -->
    <script src="{{ asset('admin/assets/plugins/peity-chart/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('admin/assets/pages/dashboard.js') }}"></script>
@endpush
