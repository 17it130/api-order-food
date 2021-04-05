@extends('admin.layouts.app')
@section('title', 'Quản lý món ăn')

@push('css')
    
@endpush

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="mt-0 header-title">Danh sách các món ăn</h4>
                <p class="text-muted m-b-30">Order Food</p>

                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên</th>
                            <th>Ảnh</th>
                            <th>Giá</th>
                            <th>Đánh giá</th>
                            <th>Cửa hàng</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($foods as $food)
                            <tr>
                                <td>{{ $loop->index }}</td>
                                <td>{{ $food->name }}</td>
                                <td>{{ $food->images }}</td>
                                <td>{{ $food->price }}</td>
                                <td>{{ $food->rating }}</td>
                                <td>{{ $food->shop_id }}</td>
                                <td class="text-center">
                                    <a href="{{ route('food.edit', $food->id) }}" class="btn btn-sm btn-primary js-tooltip-enabled" data-toggle="tooltip" title="Chỉnh sửa" data-original-title="Chỉnh sửa">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    <button type="button" onclick="" class="btn btn-sm btn-danger js-tooltip-enabled" data-toggle="tooltip" title="Xóa" data-original-title="Xóa">
                                        <i class="fa fa-times"></i>
                                    </button>
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