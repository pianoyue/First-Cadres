@extends('layout.app')

@section('content')
    <form class="form-login" method="post" action="{{url('/auth/login')}}">
        @csrf
        <h2 class="form-login-heading">登陆</h2>
        <div class="login-wrap">
            <input  type="text" class="form-control" name="user_name" placeholder="请输入用户名" autofocus>
            <br>
            <input  type="password" class="form-control" name="password" placeholder="请输入密码">
            <br>
            <input name="captcha" type="text"  class="form-control" style="width:130px;display: inline;" placeholder="验证码">
                <a onclick="re_captcha()" href="javascript:" title="换一张">
                    <img src="{{ URL('/code/captcha/1') }}" id="captcha" alt="验证码" title="换一张" >
                </a>

            <label class="checkbox">
		                <span class="pull-right">
		                    <a data-toggle="modal" href="login.html#myModal"> 忘记密码?</a>

		                </span>
            </label>
            <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> 登录</button>
            <hr>

            <div class="registration">
                还没有账号?<br/>
                <a class="" href="{{url('/auth/register')}}">
                    创建一个新账号
                </a>
            </div>

        </div>

        <!-- Modal -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Forgot Password ?</h4>
                    </div>
                    <div class="modal-body">
                        <p>Enter your e-mail address below to reset your password.</p>
                        <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                        <button class="btn btn-theme" type="button">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->

    </form>
    <script>
        function re_captcha() {      //切换验证码图片
            var url = "{{ URL('/code/captcha') }}";
            url = url + "/1?a=" + Math.random();
            document.getElementById('captcha').src = url;
        }
    </script>
@endsection