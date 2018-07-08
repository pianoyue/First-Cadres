@extends('layout.app')

@section('content')
    <form class="form-login" method="POST" action="{{url('/auth/register')}}" style="max-width:400px;">
        @csrf

        <h2 class="form-login-heading">注册</h2>
        <div class="login-wrap">

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">用户名：</label>

                <div class="col-md-8">
                    <input id="name" type="text" class="form-control{{ $errors->has('user_name') ? ' is-invalid' : '' }}" name="user_name" value="{{ old('user_name') }}" required autofocus>

                    @if ($errors->has('user_name'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('user_name') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="region_c" class="col-md-4 col-form-label text-md-right">所在区域：</label>

                <div class="col-md-8">
                    <input type="text" id="city-picker3" class="form-control" readonly name="Region"  data-toggle="city-picker"  required>
                </div>
            </div>


            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">密码：</label>

                <div class="col-md-8">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">确认密码：</label>

                <div class="col-md-8">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="true_name" class="col-md-4 col-form-label text-md-right">真实姓名：</label>

                <div class="col-md-8">
                    <input id="true_name" type="text" class="form-control{{ $errors->has('true_name') ? ' is-invalid' : '' }}" name="true_name" value="{{ old('true_name') }}" required >

                    @if ($errors->has('true_name'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('true_name') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="user_gender" class="col-md-4 col-form-label text-md-right">性别：</label>

                <div class="col-md-8">
                    <select class="form-control" name="user_gender">
                        <option value="0">男</option>
                        <option value="1">女</option>
                    </select>
                </div>
            </div>


            <div class="form-group row">
                <label for="user_phone" class="col-md-4 col-form-label text-md-right">手机号码：</label>

                <div class="col-md-8">
                    <input id="user_phone" type="number" class="form-control{{ $errors->has('user_phone') ? ' is-invalid' : '' }}" name="user_phone" value="{{ old('user_phone') }}" required>

                    @if ($errors->has('user_phone'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('user_phone') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> 注册</button>

        </div>

    </form>
@endsection