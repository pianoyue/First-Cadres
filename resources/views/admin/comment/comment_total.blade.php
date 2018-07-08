
@extends('layout.admin')

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> 评论信息</h3>

            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <table class="table table-striped table-advance table-hover">
                            <h4><i class="fa fa-angle-right"></i>所有评论</h4>
                                <div class="col-sm-6"></div>
                            {{--搜索--}}
                                <div class="col-sm-6">
                                    <div class="pull-right">
                                        <form method="post" action="{{ url('/comment/search') }}">
                                            <div class="input-group input-group-sm" >
                                                {{ csrf_field() }}

                                                <input type="text" name="search_name" class="form-control" placeholder="姓名……" style="float: left;width: 300px">

                                                <select class="form-control" name="search_level" style="width: 150px;">
                                                    <option value="">全部</option>
                                                    <option value="0">好</option>
                                                    <option value="1">较好</option>
                                                    <option value="2">一般</option>
                                                    <option value="3">差</option>
                                                </select>

                                                <div class="input-group-btn">
                                                    <button type="submit" class="btn btn-default">搜索</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            <br>
                            <br>
                            <hr>

                            <thead>
                            <tr>
                                <th><i class="fa fa-bullhorn"></i> </th>
                                <th>姓名</th>
                                <th>等级</th>
                                <th>评价内容</th>
                                <th>评价时间</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($comments as $comment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $comment->user_trueName }}</td>
                                <td>
                                    @if($comment->level==0)
                                        等级：好
                                    @elseif($comment->level==1)
                                        等级：较好
                                    @elseif($comment->level==2)
                                        等级：一般
                                    @else
                                        等级：差
                                    @endif
                                </td>
                                <td>{{ $comment->text }}</td>
                                <td>{{ $comment->updated_at }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- /content-panel -->
                </div><!-- /col-md-12 -->
            </div><!-- /row -->
            {{--分页--}}
            <div class="box-footer text-center">
                {{ $pagination }}
            </div>
        </section><! --/wrapper -->
    </section><!-- /MAIN CONTENT -->

    <!-- 添加模态框（Modal） -->
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">添加管理员</h4>
                </div>
                <form class="form-horizontal" method="POST" id="add-user">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('user_name') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">用户名：</label>

                            <div class="col-md-7">
                                <input type="text" class="form-control" name="user_name" value="{{ old('user_name') }}" placeholder="请输入用户名" required autofocus>

                                @if ($errors->has('user_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">密码：</label>

                            <div class="col-md-7">
                                <input type="password" class="form-control" name="password" value="" placeholder="请输入密码" required autofocus>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="true_name" class="col-md-3 col-form-label text-md-right">真实姓名：</label>

                            <div class="col-md-7">
                                <input id="true_name" type="text" class="form-control{{ $errors->has('true_name') ? ' is-invalid' : '' }}" name="true_name" value="{{ old('true_name') }}" placeholder="请输入真实姓名" required >

                                @if ($errors->has('true_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('true_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_gender" class="col-md-3 col-form-label text-md-right">性别：</label>

                            <div class="col-md-7">
                                <select class="form-control" name="user_gender">
                                    <option value="0">男</option>
                                    <option value="1">女</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="region_c" class="col-md-3 col-form-label text-md-right">县（市、区）：</label>

                            <div class="col-md-7">
                                <input id="region_c" type="text" class="form-control" name="region_c" placeholder="请输入县（市、区）" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="region_t" class="col-md-3 col-form-label text-md-right">所属乡镇：</label>

                            <div class="col-md-7">
                                <input id="region_t" type="text" class="form-control" name="region_t" placeholder="请输入所属乡镇" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="region_v" class="col-md-3 col-form-label text-md-right">帮扶村名称：</label>

                            <div class="col-md-7">
                                <input id="region_v" type="text" class="form-control" name="region_v" placeholder="请输入帮扶村名称" required>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('user_phone') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">手机号码：</label>

                            <div class="col-md-7">
                                <input type="number" class="form-control" name="user_phone" value="{{ old('user_phone') }}" placeholder="请输入手机号码" required >

                                @if ($errors->has('user_phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer ">
                        <div class="form-group text-center">
                            <a class="btn btn-default" data-dismiss="modal">关闭</a>
                            <button type="submit" class="btn btn-primary">添加</button>
                        </div>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>


    <!-- 编辑模态框（Modal） -->
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">编辑信息</h4>
                </div>
                <form class="form-horizontal" action="{{url('/user/edit')}}" method="POST" id="add-user">
                    <div class="modal-body">
                        {{ csrf_field() }}

                        {{--隐藏字段，传用户id--}}
                        <input type="hidden" name="id" id="id" value="">

                        <div class="form-group{{ $errors->has('user_name') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">姓名：</label>

                            <div class="col-md-7">
                                <input type="text" class="form-control" name="user_name" id="user_name" value="{{ old('user_name') }}"required autofocus>

                                @if ($errors->has('user_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right">真实姓名：</label>

                            <div class="col-md-7">
                                <input id="true_name_" type="text" class="form-control{{ $errors->has('true_name') ? ' is-invalid' : '' }}" name="true_name"  required >

                                @if ($errors->has('true_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('true_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right" >性别：</label>

                            <div class="col-md-7">
                                <select class="form-control" name="user_gender" >
                                    <option value="0">男</option>
                                    <option value="1">女</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label  class="col-md-3 col-form-label text-md-right">县（市、区）：</label>

                            <div class="col-md-7">
                                <input id="region_c_" type="text" class="form-control" name="region_c" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label  class="col-md-3 col-form-label text-md-right">所属乡镇：</label>

                            <div class="col-md-7">
                                <input id="region_t_" type="text" class="form-control" name="region_t" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right">帮扶村名称：</label>

                            <div class="col-md-7">
                                <input id="region_v_" type="text" class="form-control" name="region_v" required>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('user_phone') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">手机号码：</label>

                            <div class="col-md-7">
                                <input type="number" class="form-control" name="user_phone" id="user_phone" value="{{ old('user_phone') }}" required autofocus>

                                @if ($errors->has('user_phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer ">
                        <div class="form-group text-center">
                            <a class="btn btn-default" data-dismiss="modal">关闭</a>
                            <button type="submit" class="btn btn-primary">确定</button>
                        </div>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>

    <script>

        $(document).ready(function () {
            @if(count($errors) > 0)
                $('#addUserModal').modal('show');
            @endif
        });


        function deleteUser(id) {             //删除用户

            $.ajax({
                url:'{{ url('/user/delete') }}',
                type:'POST',                  //GET
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="X-CSRF-TOKEN"]').attr('content')
                },
                data:{id:id},
                dataType:'json',    //返回的数据格式：json/xml/html/script/jsonp/text
                beforeSend:function(xhr){
                    console.log(xhr)
                    console.log('发送前')
                },
                success:function(data){
                    window.location.reload()
                    console.log(data)
                },
                error:function(data){
                    console.log('错误')
                    console.log(data)
                },
                complete:function(){
                    console.log('结束')
                }
            })
        }

        function editUser(id,user_name,true_name,region_c,region_t,region_v,user_phone) {    //编辑用户
            $("#editUserModal").modal("hide");//手动隐藏模态框
            $("#id").val(id);                //往带id的标签里传入定义好的值

            $("#user_name").attr("value",user_name); //设置该标签的属性值
            $("#true_name_").attr("value",true_name);
            $("#region_c_").attr("value",region_c);
            $("#region_t_").attr("value",region_t);
            $("#region_v_").attr("value",region_v);
            $("#user_phone").attr("value",user_phone);
        }
    </script>
@endsection