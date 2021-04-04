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
                            <th>Mô tả</th>
                            <th>Gía</th>
                            <th>Đánh giá</th>
                            <th>Cửa hàng</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                            <td>2011/04/25</td>
                            <td class="text-center">
                                <a href="" class="btn btn-sm btn-primary js-tooltip-enabled" data-toggle="tooltip" title="Chỉnh sửa" data-original-title="Chỉnh sửa">
                                    <i class="fa fa-pencil-alt"></i>
                                </a>
                                <button type="button" onclick="" class="btn btn-sm btn-danger js-tooltip-enabled" data-toggle="tooltip" title="Xóa" data-original-title="Xóa">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>50</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                            <td>2011/04/25</td>
                            <td class="text-center">
                                <a href="" class="btn btn-sm btn-primary js-tooltip-enabled" data-toggle="tooltip" title="Chỉnh sửa" data-original-title="Chỉnh sửa">
                                    <i class="fa fa-pencil-alt"></i>
                                </a>
                                <button type="button" onclick="" class="btn btn-sm btn-danger js-tooltip-enabled" data-toggle="tooltip" title="Xóa" data-original-title="Xóa">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection

@push('js')
    
@endpush