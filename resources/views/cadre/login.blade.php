@extends('layout.app_cadre')

@section('content')
    <form class="form-login" method="post" action="{{url('/cadre/login')}}">
        @csrf
        <h2 class="form-login-heading">登陆</h2>
        <div class="login-wrap">
            <input  type="text" class="form-control" name="cadre_name" placeholder="请输入用户名" autofocus>
            <br>
            <input  type="password" class="form-control" name="password" placeholder="请输入密码">
            <label class="checkbox">
		                <span class="pull-right">
		                    <a data-toggle="modal" href="login.html#myModal"> 忘记密码?</a>
		                </span>
            </label>
            <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> 登录</button>
            <hr>

        </div>

    </form>
@endsection