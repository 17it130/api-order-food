@extends('admin.layouts.app')
@section('title', 'Quản lý danh mục')

@push('css')
    <!-- Sweet Alert -->
    <link href="{{ asset('admin/assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">Danh sách danh mục</h4>
                    <div class="float-right d-none d-md-block">
                        <div class="dropdown">
                            <a class="btn btn-primary waves-effect waves-light" href="{{ route('category.create') }}">
                                <i class="mdi mdi-pencil-outline mr-2"></i> Thêm mới danh mục
                            </a>
                        </div>
                    </div>
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($categories as $key => $category)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $category->name }}</td>
                            <td class="text-center">
                                <a href="{{ route('category.edit', $category->id) }}" class="btn btn-warning btn-sm waves-effect waves-light">
                                    <i class="fa fa-pencil-alt"></i>
                                </a>
                                <a class="btn btn-danger btn-sm waves-effect waves-light"
                                    onclick="deleteCategory({{ $category->id }})" href="javascript:void(0);"
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
<!-- Sweet-Alert  -->
<script src="{{ asset('admin/assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
    <script>
        function deleteCategory(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger mr-2'
                },
                buttonsStyling: false,
            });
            swalWithBootstrapButtons.fire({
                title: 'Bạn có chắc chắn?',
                text: "Các món ăn liên quan đến danh mục sẽ bị xóa!",
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
                        url: '{{ url('admin/category') }}/' + id,
                        data: {
                            id: id,
                        },
                        dataType: 'json',
                        success: function(data) {
                            if(data) {
                                swalWithBootstrapButtons.fire(
                                    'Thành công!',
                                    'Danh mục đã xóa thành công!',
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