@extends('admin.layouts.app')
@section('title', 'Chi tiết đơn hàng')

@push('css')
    <link href="{{ asset('admin/flags/css/flag-icon.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/jquery-steps/jquery.steps.css') }}">
@endpush

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <fieldset>
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="mt-0 header-title">Thông tin khách hàng</h4> <br>

                            <div class="form-group row" style="padding: 0px 15px">
                                <label  class="col-lg-3">Họ tên:</label>
                                <div class="col-lg-9">
                                    <p>{{ isset($order[0]->user->name) ? $order[0]->user->name : '' }}</p>
                                </div>
                            </div>
                            <div class="form-group row" style="padding: 0px 15px">
                                <label  class="col-lg-3">Số điện thoại:</label>
                                <div class="col-lg-9">
                                    <p>{{ isset($order[0]->user->phone) ? $order[0]->user->phone : '' }}</p>
                                </div>
                            </div>
                            <div class="form-group row" style="padding: 0px 15px">
                                <label  class="col-lg-3">Email:</label>
                                <div class="col-lg-9">
                                    <p>{{ isset($order[0]->user->email) ? $order[0]->user->email : '' }}</p>
                                </div>
                            </div>
                            <div class="form-group row" style="padding: 0px 15px">
                                <label  class="col-lg-3">Địa chỉ:</label>
                                <div class="col-lg-9">
                                    <p>{{ isset($order[0]->user->address) ? $order[0]->user->address : '' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <h4 class="mt-0 header-title">Trạng thái đơn hàng</h4> <br>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <form method="POST" action="{{ route('order.update', $order[0]->id) }}" enctype='multipart/form-data' id="form-horizontal" class="form-horizontal form-wizard-wrapper">
                                                @method('PUT')
                                                @csrf
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-3 col-xs-6 text-center"
                                                            style="{{ $order[0]->status == 1 ? 'border: 1px solid; border-radius: 5px' : '' }}">
                                                            <div class="col-12">
                                                                <i class="mdi mdi-checkbox-marked-circle-outline" style="font-size: 45px; color: blue"></i>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="0" name="status" class="custom-control-input"
                                                                    value="0" {{ $order[0]->status == 0 ? 'checked' : ''}}>
                                                                <label class="custom-control-label" for="0">Đã xác nhân</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-xs-6 text-center"
                                                            style="{{ $order[0]->status == 2 ? 'border: 1px solid; border-radius: 5px' : '' }}">
                                                            <div class="col-12">
                                                                <i class="mdi mdi-truck" style="font-size: 45px; color: orange"></i>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="1" name="status" class="custom-control-input"
                                                                    value="1" {{ $order[0]->status == 1 ? 'checked' : ''}}>
                                                                <label class="custom-control-label" for="1">Đang giao hàng</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-xs-6 text-center"
                                                            style="{{ $order[0]->status == 3 ? 'border: 1px solid; border-radius: 5px' : '' }}">
                                                            <div class="col-12">
                                                                <i class="mdi mdi-checkbox-multiple-marked" style="font-size: 45px; color: green"></i>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="2" name="status" class="custom-control-input"
                                                                    value="2" {{ $order[0]->status == 2 ? 'checked' : ''}}>
                                                                <label class="custom-control-label" for="2">Đã giao hàng</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <br>
                                                <div class="col-md-12 text-center m-t-15">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Lưu thay đổi</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <h4 class="mt-0 header-title">Thanh toán</h4><br>

                        <div class="form-group row" style="padding: 0px 15px">
                            <label  class="col-lg-4">Phương thức thanh toán:</label>
                            <div class="col-lg-8">
                                <p>{{ $order[0]->payment_id == 0 ? 'Thanh toán khi nhận hàng' : ($order[0]->payment_id == 1 ? 'Thanh toán bằng ví AirPay' : ($order[0]->payment_id == 1 ? 'Thanh toán bằng ví ZaloPay' : 'Thanh toán bằng ví Momo')) }}</p>
                            </div>
                        </div>
                        <!-- <div class="form-group row" style="padding: 0px 15px">
                            <label  class="col-lg-4">Phí vận chuyển:</label>
                            <div class="col-lg-8">
                                <p></p>
                            </div>
                        </div> -->
                        <div class="form-group row" style="padding: 0px 15px">
                            <label  class="col-lg-4">Tổng thanh toán:</label>
                            <div class="col-lg-8">
                                <p style="color: orange; font-weight: 500">
                                    $ {{ $order[0]->totalPrice }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h4 class="mt-0 header-title">Danh sách món</h4><br>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên</th>
                                    <th>Ảnh</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($order[0]->detail as $food)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $food->food->name }}</td>
                                        <td class="text-center">
                                            <img src="{{ asset($food->food->images) }}" alt="{{ $food->food->images }}" style="max-height: 100px"/>
                                        </td>
                                        <td>$ {{ $food->food->price }}</td>
                                        <td>{{ $food->quantity }}</td>
                                        <td>$ {{ $food->food->price * $food->quantity }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
@endsection

@push('js')
@endpush
