@extends('admin.layouts.app')
@section('title', 'Quản lý món ăn')

@push('css')
    <!-- Sweet Alert -->
    <link href="{{ asset('admin/assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="mt-0 header-title">Danh sách các món ăn</h4><br>
                <div class="float-right d-none d-md-block">
                    <div class="dropdown">
                        <a class="btn btn-primary waves-effect waves-light" href="{{ route('food.create') }}">
                            <i class="mdi mdi-pencil-outline mr-2"></i> Thêm mới món ăn
                        </a>
                    </div>
                </div>

                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên</th>
                            <th>Ảnh</th>
                            <th>Giá</th>
                            <th>Lượt mua</th>
                            <th>Cửa hàng</th>
                            <th>Danh mục</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($foods as $food)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $food->name }}</td>
                                <td class="text-center">
                                    <img src="{{ asset($food->images) }}" alt="Image" style="max-height: 100px"/>
                                </td>
                                <td>{{ $food->price }}</td>
                                <td>{{ $food->order_time }}</td>
                                <td>{{ $food->shop->name }}</td>
                                <td>{{ $food->category->name }}</td>
                                <td class="text-center">
                                    <a href="{{ route('food.edit', $food->id) }}" class="btn btn-warning btn-sm waves-effect waves-light">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    <a class="btn btn-danger btn-sm waves-effect waves-light"
                                        onclick="deleteFood({{ $food->id }})" href="javascript:void(0);"
                                        role="button">
                                        <i class="mdi mdi-trash-can-outline"></i>
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
    <!-- Sweet-Alert  -->
<script src="{{ asset('admin/assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script>
    function deleteFood(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger mr-2'
            },
            buttonsStyling: false,
        });
        swalWithBootstrapButtons.fire({
            title: 'Bạn có chắc chắn?',
            text: "Món ăn này sẽ bị xóa!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'DELETE',
                    url: '{{ url('admin/food') }}/' + id,
                    data: {
                        id: id,
                    },
                    dataType: 'json',
                    success: function(data) {
                        if(data) {
                            swalWithBootstrapButtons.fire(
                                'Thành công!',
                                'Món ăn đã xóa thành công!',
                                'success',
                            )
                        }
                        window.location.reload();
                    }
                })
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                    'Hủy',
                    'Hủy thành công !',
                    'error'
                )
            }
        })
    }
</script>
@endpush
