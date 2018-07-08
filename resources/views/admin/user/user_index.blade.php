
@extends('layout.admin')

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> 管理员信息</h3>

            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <table class="table table-striped table-advance table-hover">
                            <h4><i class="fa fa-angle-right"></i>所有用户</h4>
                            {{--添加导入--}}
                            <div class="row box-header">
                                <div class="col-sm-6">
                                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addUserModal" href="javascript:">添加</a>
                                    <a class="btn btn-default btn-sm"  href="{{url('/user/export')}}">导出</a>
                                </div>
                                <div class="col-sm-6">
                                    <div class="pull-right">
                                        <form method="post" action="{{ url('/user/search') }}">
                                            <div class="input-group input-group-sm" style="width: 350px;">
                                                {{ csrf_field() }}
                                                <input type="text" name="search_text" class="form-control" placeholder="搜索姓名、所在市">
                                                <div class="input-group-btn">
                                                    <button type="submit" class="btn btn-default">搜索</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>用户名</th>
                                <th>真实姓名</th>
                                <th>所属市</th>
                                <th>所属县、区</th>
                                <th>所属乡、镇</th>
                                <th>用户操作</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->user_name }}</td>
                                <td>{{ $user->true_name }}</td>
                                <td>{{ $user->region_c }}</td>
                                <td>{{ $user->region_t }}</td>
                                <td>{{ $user->region_v }}</td>
                                <td>
                                    <button class="btn btn-primary btn-xs"><i class="fa fa-pencil" data-toggle="modal" data-target="#editUserModal"
                                                                              onclick="editUser({{ $user->id }},
                                                                                      '{{ $user->user_name }}',
                                                                                      '{{ $user->true_name }}',
                                                                                      '{{ $user->region_c }}',
                                                                                      '{{ $user->region_t }}',
                                                                                      '{{ $user->region_v }}',
                                                                                      '{{ $user->user_phone }}')" href="javascript:"></i></button>
                                    <button class="btn btn-danger btn-xs" ><i class="fa fa-trash-o " onclick="deleteUser({{ $user->id }})" href="javascript:"></i></button>
                                </td>
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
                                <input type="text" class="form-control" name="user_name" value="{{ old('user_name') }}" placeholder="请输入用户名" required >

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
                                <input type="password" class="form-control" name="password" value="" placeholder="请输入密码" required >

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
                            <label  class="col-md-3 col-form-label text-md-right">所属区域：</label>

                            <div class="col-md-7">
                                <input type="text" id="city-picker3" class="form-control" readonly name="Region" value="" data-toggle="city-picker" style="width:320px;" required>
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
                            <label  class="col-md-3 col-form-label text-md-right">所属区域：</label>

                            <div class="col-md-7">
                                <input type="text" id="city-picker3" class="form-control" readonly name="Region" value="广西壮族自治区/南宁市/西乡塘区" data-toggle="city-picker" style="width:320px;">
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