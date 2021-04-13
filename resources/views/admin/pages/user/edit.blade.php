@extends('admin.layouts.app')
@section('title', 'Chỉnh sửa người dùng')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    {{ Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'put']) }}
                    @if ($user->role == 'shop')
                        <div class="form-group">
                            {{ Form::label('public_name', 'Tên hiển thị *') }}
                            {{ Form::text('public_name', old('public_name', isset($user->public_name) ? $user->public_name : ''), ['class' => $errors->has('public_name') ? 'form-control is-invalid' : 'form-control', 'id' => 'name', 'placeholder' => 'Nhập vào tên hiển thị']) }}
                            @if($errors->has('name'))
                                <div class="invalid-feedback" style="display: initial">
                                    {{ $errors->first('public_name') }}
                                </div>
                            @endif
                        </div> 
                    @endif
                    <div class="form-group">
                        {{ Form::label('role', 'Quyền *') }}
                        {{ Form::select('role', [
                            'user' => 'Người dùng',
                            'shop' => 'Cửa hàng',
                            'admin' => 'Quản trị viên'
                        ], $user->role, ['class' => $errors->has('role') ? 'form-control is-invalid' : 'form-control', 'id' => 'role', 'required']) }}
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
