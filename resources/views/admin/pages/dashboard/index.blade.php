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
                    <h4 class="font-500">1,685 <i class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                    <div class="mini-stat-label bg-success">
                        <p class="mb-0">+ 12%</p>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="float-right">
                        <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                    </div>

                    <p class="text-white-50 mb-0">Since last month</p>
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
                    <h4 class="font-500">52,368 <i class="mdi mdi-arrow-down text-danger ml-2"></i></h4>
                    <div class="mini-stat-label bg-danger">
                        <p class="mb-0">- 28%</p>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="float-right">
                        <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                    </div>

                    <p class="text-white-50 mb-0">Since last month</p>
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
                    <h5 class="font-16 text-uppercase mt-0 text-white-50">Average Price</h5>
                    <h4 class="font-500">15.8 <i class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                    <div class="mini-stat-label bg-info">
                        <p class="mb-0"> 00%</p>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="float-right">
                        <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                    </div>

                    <p class="text-white-50 mb-0">Since last month</p>
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
                    <h5 class="font-16 text-uppercase mt-0 text-white-50">Product Sold</h5>
                    <h4 class="font-500">2436 <i class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                    <div class="mini-stat-label bg-warning">
                        <p class="mb-0">+ 84%</p>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="float-right">
                        <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                    </div>

                    <p class="text-white-50 mb-0">Since last month</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
    <!--  -->
@endpush