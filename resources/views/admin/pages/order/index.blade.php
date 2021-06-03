@extends('admin.layouts.app')
@section('title', 'Quản lý đặt hàng')

@push('css')
    <!-- Sweet Alert -->
    <link href="{{ asset('admin/assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="mt-0 header-title">Danh sách các hóa đơn</h4><br>

                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên khách hàng</th>
                            <th>Số điện thoại</th>
                            <th>Mã đơn hàng</th>
                            <th>Tổng</th>
                            <th>Ngày đặt</th>
                            <th>Ghi chú</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->user->phone }}</td>
                                <td>{{ $order->order_code }}</td>
                                <td>{{ $order->totalPrice }}</td>
                                <td>{{ $order->order_date }}</td>
                                <td>{{ $order->order_note }}</td>
                                <td>
                                    <span class="badge badge-primary">{{ $order->payment_id == 0 ? 'Thanh toán khi nhận hàng' : 'Thanh toán Online' }}</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">{{ $order->status == 0 ? 'Đang chờ xác nhận' : ($order->status == 1 ? 'Đã xác nhận' : ($order->status == 2 ? 'Đang giao' : 'Đã giao')) }}</span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('order.edit', $order->id) }}" class="btn btn-primary btn-sm waves-effect waves-light">
                                        Chi tiết đơn hàng
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection

@push('js')
    <!-- Required datatable js -->
    <script src="{{ asset('admin/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('admin/assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('admin/assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('admin/assets/pages/datatables.init.js') }}"></script>
@endpush
