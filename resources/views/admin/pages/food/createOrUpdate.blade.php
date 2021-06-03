@extends('admin.layouts.app')
@section('title', isset($food) ? 'Chỉnh sửa món ăn' : 'Thêm mới món ăn')

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/jquery-steps/jquery.steps.css') }}">
@endpush

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <!-- <h4 class="mt-0 header-title">Jquery Steps Wizard</h4>
                <p class="text-muted m-b-30 font-14">A powerful jQuery wizard plugin that
                    supports accessibility and HTML5</p> -->

                @if(isset($food))
                    <form method="POST" action="{{ route('food.update', $food->id) }}" enctype='multipart/form-data' id="form-horizontal" class="form-horizontal form-wizard-wrapper">
                    @method('PUT')
                @else
                    <form method="POST" action="{{ route('food.store') }}" enctype='multipart/form-data' id="form-horizontal" class="form-horizontal form-wizard-wrapper">
                @endif
                    @csrf

                    <!-- <h3>Seller Details</h3> -->
                    <fieldset>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group row">
                                    <label for="name" class="col-lg-3 col-form-label">Tên món</label>
                                    <div class="col-lg-9">
                                        <input id="name" name="name" type="text" class="form-control"
                                            value="{{ isset($food->name) ? $food->name : '' }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="price" class="col-lg-3 col-form-label">Giá</label>
                                    <div class="col-lg-9">
                                        <input id="price" name="price" type="text" class="form-control"
                                            value="{{ isset($food->price) ? $food->price : '' }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description" class="col-lg-3 col-form-label">Mô tả</label>
                                    <div class="col-lg-9">
                                        <textarea id="description" name="description" rows="4" class="form-control">{{ isset($food->description) ? $food->description : '' }}</textarea>
                                    </div>
                                </div>
                                @if(Auth::user()->role == 'admin')
                                    <div class="form-group row">
                                        <label for="" class="col-lg-3 col-form-label">Cửa hàng</label>
                                        <div class="col-lg-9">
                                            <select id="shop_id" name="shop_id" class="form-control" required>
                                                <option value="">-- Hãy chọn cửa hàng --</option>
                                                @foreach ($shops as $shop)
                                                    <option value="{{ $shop->id }}" {{ isset($food->shop_id) ? $shop->id == $food->shop_id ? 'selected' : '' : '' }}>{{ isset($shop->public_name) ? $shop->public_name : $shop->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group row">
                                    <label for="" class="col-lg-3 col-form-label">Danh mục</label>
                                    <div class="col-lg-9">
                                        <select id="category_id" name="category_id" class="form-control" required>
                                            <option value="">-- Hãy chọn danh mục --</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ isset($food->category_id) ? $category->id == $food->category_id ? 'selected' : '' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <br>
                                <div class="col-md-12 text-center m-t-15">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Xác nhận</button>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">

                                                <h4 class="mt-0 header-title">Ảnh</h4>
                                                <!-- <p class="text-muted m-b-30">DropzoneJS is an open source library
                                                    that provides drag’n’drop file uploads with image previews.
                                                </p> -->

                                                <div class="m-b-30">
                                                    @if(isset($food->images) && $food->images != null)
                                                        <img src="{{ asset($food->images) }}" id="photoThumbnail" class="img-thumbnail mb-2"
                                                            alt="{{ $food->images }}">
                                                    @else
                                                        <img src="{{ asset('admin/assets/media/photos/thumbnail.jpg') }}" class="img-thumbnail mb-2"
                                                            id="photoThumbnail" alt="Preview Thumbnail">
                                                    @endif
                                                    <div class="fallback">
                                                        <input name="images" type="file" id="photo" multiple="multiple" {{ isset($food) ? '' : 'required' }} />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
@endsection

@push('js')
    <script>
        function previewImage(input, element) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#' + element).attr('src', e.target.result);
                    $('#' + element).css('display', 'initial');
                }
                reader.readAsDataURL(input.files[0]);
            }
        };

        $('#photo').change(function () {
            previewImage(this, 'photoThumbnail');
        });
    </script>
@endpush
