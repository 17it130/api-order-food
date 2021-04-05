@extends('admin.layouts.app')
@section('title', isset($category) ? 'Chỉnh sửa danh mục' : 'Thêm mới danh mục')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    @if(isset($category))
                        {{ Form::model($category, ['route' => ['category.update', $category->id], 'method' => 'put']) }}
                    @else
                        {{ Form::open(['route' => 'category.store', 'method' => 'post']) }}
                    @endif
                    <div class="form-group">
                        {{ Form::label('category', 'Tên *') }}
                        {{ Form::text('category', old('category', isset($category) ? $category->name : ''), ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control', 'id' => 'category', 'placeholder' => 'Nhập vào tên danh mục', 'required']) }}
                        @if($errors->has('category'))
                            <div class="invalid-feedback" style="display: initial">
                                {{ $errors->first('category') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {{ Form::submit('Xác nhận', ['name' => 'submit', 'class' => 'btn btn-primary']) }}
                        {{ Form::reset('Huỷ', ['name' => 'reset', 'class' => 'btn btn-dark']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
