@extends('admin.layouts.app')
@section('title', isset($category) ? 'Chỉnh sửa danh mục' : 'Thêm mới danh mục')
@push('css')
    <link href="{{ asset('admin/flags/css/flag-icon.min.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="block block-rounded">
        <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="#vn"><i class="flag-icon flag-icon-vn mr-2"></i>Tiếng Việt</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#en"><i class="flag-icon flag-icon-gb mr-2"></i>Tiếng Anh</a>
            </li>
        </ul>
        @if(isset($category))
            {{ Form::model($category, ['route' => ['danh-muc.update', $category->id], 'method' => 'put']) }}
        @else
            {{ Form::open(['route' => 'danh-muc.store', 'method' => 'post']) }}
        @endif
        <div class="block-content tab-content">
            <div class="tab-pane active" id="vn" role="tabpanel">
                <div class="row push">
                    <div class="col-lg-12 col-xl-12">
                        <div class="form-group">
                            {{ Form::label('category', 'Tên *') }}
                            {{ Form::text('category', old('category', isset($category) ? optional($category->translate('vi'))->category : ''), ['class' => $errors->has('category') ? 'form-control is-invalid' : 'form-control', 'id' => 'category', 'placeholder' => 'Nhập vào tên danh mục', 'required']) }}
                            @if($errors->has('category'))
                                <div class="invalid-feedback" style="display: initial">
                                    {{ $errors->first('category') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="en" role="tabpanel">
                <div class="row push">
                    <div class="col-lg-12 col-xl-12">
                        <div class="form-group">
                            {{ Form::label('category_en', 'Name *') }}
                            {{ Form::text('category_en', old('category', isset($category) ? optional($category->translate('en'))->category : ''), ['class' => $errors->has('category') ? 'form-control is-invalid' : 'form-control', 'id' => 'category', 'placeholder' => 'Please enter name', 'required']) }}
                            @if($errors->has('category_en'))
                                <div class="invalid-feedback" style="display: initial">
                                    {{ $errors->first('category_en') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('parent_id', 'Danh mục cha') }}
                {{ Form::select('parent_id', $categories->pluck('category', 'id'), isset($category->parent_id) ? $category->parent_id : null, ['class' => 'form-control', 'placeholder' => 'Chọn danh mục']) }}
                @if($errors->has('parent_id'))
                    <div class="invalid-feedback" style="display: initial">
                        {{ $errors->first('parent_id') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                {{ Form::label('type', 'Loại') }}
                {{ Form::select('type', ['1' => 'Tin tức & sự kiện', '2' => 'Thông báo', '3' => 'Khóa học', '4' => 'Menu'], isset($category->type) ? $category->type : null, ['class' => 'form-control', 'placeholder' => 'Chọn loại']) }}
                @if($errors->has('type'))
                    <div class="invalid-feedback" style="display: initial">
                        {{ $errors->first('type') }}
                    </div>
                @endif
            </div>
            <div class="form-group text-center">
                {{ Form::submit('Xác nhận', ['name' => 'submit', 'class' => 'btn btn-primary']) }}
                {{ Form::reset('Huỷ', ['name' => 'reset', 'class' => 'btn btn-dark']) }}
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endsection
@push('js')
    <!-- Page JS Plugins -->
    <script src="{{ asset('admin/assets/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>


    <!-- Page JS Helpers (BS Notify Plugin) -->
    <script>jQuery(function () {
            Dashmix.helpers('notify');
        });</script>
    <script>
        $(document).ready(function () {
            @if(Session::has('edit'))
            Dashmix.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Chỉnh sửa thành công!'});
            @endif
        });
    </script>
@endpush
