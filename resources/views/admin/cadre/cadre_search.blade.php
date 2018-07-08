@extends('layout.admin')

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i>驻村干部信息</h3>

            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <table class="table table-striped table-advance table-hover">
                            <h4><i class="fa fa-angle-right"></i>所有用户</h4>
                            {{--添加导入--}}
                            <div class="row box-header">
                                <div class="col-sm-4">
                                    <a class="btn btn-primary btn-sm" href="{{url('/cadre')}}">返回</a>
                                </div>

                                <div class="col-sm-8">
                                    <div class="pull-right">
                                        <form method="post" action="{{ url('/cadre/search') }}">
                                            <div class="input-group input-group-sm" >
                                                {{ csrf_field() }}
                                                <input type="text" name="search_name" class="form-control" placeholder="姓名……" style="float: left;width: 280px">
                                                <input type="text" name="search_region_c" class="form-control" placeholder="县市区……" style="width: 280px">

                                                <select class="form-control" name="search_status" style="width: 100px;">
                                                    <option value="">全部</option>
                                                    <option value="0">未审核</option>
                                                    <option value="1">已审核</option>
                                                </select>
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
                                <th><i class="fa fa-bullhorn"></i> </th>
                                <th>姓名</th>
                                <th>性别</th>
                                <th>政治面貌</th>
                                <th>开始驻村时间</th>
                                <th>结束驻村时间</th>
                                <th>县(市、区)</th>
                                <th>所属乡镇</th>
                                <th>帮扶村名称</th>
                                <th>创建时间</th>
                                <th>评价</th>
                                <th>状态</th>
                                <th>用户操作</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($cadres as $cadre_user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $cadre_user->cadre_trueName }}</td>
                                <td>
                                    @if ($cadre_user->cadre_gender == 0)
                                        男
                                    @else
                                        女
                                    @endif
                                </td>
                                <td>
                                    @if ($cadre_user->political_status == 0)
                                        党员
                                    @elseif($cadre_user->political_status == 1)
                                        团员
                                    @else
                                        无党派人士
                                    @endif
                                </td>
                                <td>{{ $cadre_user->startTime }}</td>
                                <td>{{ $cadre_user->endTime }}</td>
                                <td>{{ $cadre_user->cadreRegion_c }}</td>
                                <td>{{ $cadre_user->cadreRegion_t }}</td>
                                <td>{{ $cadre_user->cadreRegion_v }}</td>
                                <td>{{ $cadre_user->created_at }}</td>
                                <td>
                                    <form action="{{url('/comment')}}" method="POST" >
                                        {{ csrf_field() }}
                                        {{--隐藏字段，传用户id--}}
                                         <input type="hidden" name="id"  value="{{$cadre_user->id}}">
                                         <button type="submit" class="btn btn-info btn-xs">查看评价</button>
                                    </form>
                                </td>
                                <td>
                                    @if ($cadre_user->status == 0)
                                        <span class="label label-warning label-mini">未审核</span>
                                    @else
                                        <span class="label label-success label-mini">已审核</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-success btn-xs" ><i class="fa fa-check " onclick="editStatus({{ $cadre_user->id }},1)" href="javascript:"></i></button>
                                    <button class="btn btn-warning btn-xs" ><i class="fa fa-times " onclick="editStatus({{ $cadre_user->id }},0)" href="javascript:"></i></button>
                                    {{--<button class="btn btn-primary btn-xs" ><i class="fa fa-pencil " onclick="" href="javascript:"></i></button>--}}
                                    <button class="btn btn-info btn-xs"><i class="fa fa-pencil" data-toggle="modal" data-target="#editCadreModal"
                                                                              onclick="editCadre({{ $cadre_user->id }},
                                                                                      '{{ $cadre_user->cadre_trueName }}',
                                                                                       '{{ $cadre_user->cadre_gender }}',
                                                                                       '{{ $cadre_user->political_status }}',
                                                                                       '{{ $cadre_user->startTime }}',
                                                                                       '{{ $cadre_user->endTime }}',
                                                                                      '{{ $cadre_user->cadreRegion_c }}',
                                                                                      '{{ $cadre_user->cadreRegion_t }}',
                                                                                      '{{ $cadre_user->cadreRegion_v }}',
                                                                                      '{{ $cadre_user->cadre_phone }}'
                                                                                      )" href="javascript:"></i></button>
                                    <button class="btn btn-danger btn-xs" ><i class="fa fa-trash-o " onclick="deleteCadre({{$cadre_user->id}})" href="javascript:"></i></button>
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
    <div class="modal fade" id="addCadreModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">添加驻村干部</h4>
                </div>
                <form class="form-horizontal" method="POST" id="add-user">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right">真实姓名：</label>

                            <div class="col-md-7">
                                <input id="true_name" type="text" class="form-control{{ $errors->has('cadre_trueName') ? ' is-invalid' : '' }}" name="cadre_trueName" value="{{ old('cadre_trueName') }}" placeholder="请输入真实姓名" required >

                                @if ($errors->has('cadre_trueName'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('cadre_trueName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right">性别：</label>

                            <div class="col-md-7">
                                <select class="form-control" name="cadre_gender">
                                    <option value="0">男</option>
                                    <option value="1">女</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right">政治面貌：</label>

                            <div class="col-md-7">
                                <select class="form-control" name="political_status">
                                    <option value="0">党员</option>
                                    <option value="1">团员</option>
                                    <option value="2">无党派人士</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right">县（市、区）：</label>

                            <div class="col-md-7">
                                <input id="cadreRegion_c" type="text" class="form-control" name="cadreRegion_c" placeholder="请输入县（市、区）" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right">所属乡镇：</label>

                            <div class="col-md-7">
                                <input id="cadreRegion_t" type="text" class="form-control" name="cadreRegion_t" placeholder="请输入所属乡镇" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right">帮扶村名称：</label>

                            <div class="col-md-7">
                                <input id="cadreRegion_v" type="text" class="form-control" name="cadreRegion_v" placeholder="请输入帮扶村名称" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right">开始驻村时间：</label>

                            <div class="col-md-7">
                                <input id="startTime" type="date" class="form-control" name="startTime" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right">结束驻村时间：</label>

                            <div class="col-md-7">
                                <input id="endTime" type="date" class="form-control" name="endTime" >
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('cadre_phone') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">手机号码：</label>


                            <div class="col-md-7">
                                <input type="number" class="form-control" name="cadre_phone" value="{{ old('cadre_phone') }}" placeholder="请输入手机号码" required >

                                @if ($errors->has('cadre_phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cadre_phone') }}</strong>
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
    <div class="modal fade" id="editCadreModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">编辑信息</h4>
                </div>
                <form class="form-horizontal" action="{{url('/cadre/edit')}}" method="POST" id="add-user">
                    <div class="modal-body">
                        {{ csrf_field() }}

                        {{--隐藏字段，传用户id--}}
                        <input type="hidden" name="id" id="id" value="">

                        <div class="form-group{{ $errors->has('cadre_trueName') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">姓名：</label>

                            <div class="col-md-7">
                                <input type="text" class="form-control" name="cadre_trueName" id="cadre_trueName_" value="{{ old('cadre_trueName') }}" required autofocus>

                                @if ($errors->has('cadre_trueName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cadre_trueName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right" >性别：</label>

                            <div class="col-md-7">
                                <select class="form-control" name="cadre_gender" id="cadre_gender_"  >
                                    <option value="0">男</option>
                                    <option value="1">女</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right" >政治面貌：</label>

                            <div class="col-md-7">
                                <select class="form-control" name="political_status" id="political_status_">
                                    <option value="0">党员</option>
                                    <option value="1">团员</option>
                                    <option value="2">无党派人士</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label  class="col-md-3 col-form-label text-md-right">县（市、区）：</label>

                            <div class="col-md-7">
                                <input id="cadreRegion_c_" type="text" class="form-control" name="cadreRegion_c" value="" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label  class="col-md-3 col-form-label text-md-right">所属乡镇：</label>

                            <div class="col-md-7">
                                <input id="cadreRegion_t_" type="text" class="form-control" name="cadreRegion_t" value="" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right">帮扶村名称：</label>

                            <div class="col-md-7">
                                <input id="cadreRegion_v_" type="text" class="form-control" name="cadreRegion_v" value="" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right">开始驻村时间：</label>

                            <div class="col-md-7">
                                <input id="startTime_" type="date" class="form-control" name="startTime" value="" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right">结束驻村时间：</label>

                            <div class="col-md-7">
                                <input id="endTime_" type="date" class="form-control" name="endTime" value="" >
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('cadre_phone') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">手机号码：</label>

                            <div class="col-md-7">
                                <input type="number" class="form-control" name="cadre_phone" id="cadre_phone_" value="{{ old('user_phone') }}" required autofocus>

                                @if ($errors->has('cadre_phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cadre_phone') }}</strong>
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
                $('#addCadreModal').modal('show');
            @endif
        });


        function deleteCadre(id) {             //删除

            $.ajax({
                url:'{{ url('/cadre/delete') }}',
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

        function editCadre(id,cadre_trueName,cadre_gender,political_status,startTime,endTime,cadreRegion_c,cadreRegion_t,cadreRegion_v,cadre_phone) {    //编辑用户
            $("#editCadreModal").modal("hide");//手动隐藏模态框
            $("#id").val(id);                //往带id的标签里传入定义好的值

            $("#cadre_trueName_").attr("value",cadre_trueName); //设置该标签的属性值
            $("#cadre_gender_").attr("value",cadre_gender);
            $("#political_status_").attr("value",political_status);
            $("#startTime_").attr("value",startTime);
            $("#endTime_").attr("value",endTime);
            $("#cadreRegion_c_").attr("value",cadreRegion_c);
            $("#cadreRegion_t_").attr("value",cadreRegion_t);
            $("#cadreRegion_v_").attr("value",cadreRegion_v);
            $("#cadre_phone_").attr("value",cadre_phone);
        }

        function editStatus(id,status) {             //编辑审核状态
            $.ajax({
                url:'{{ url('/cadre/editStatus') }}',
                type:'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="X-CSRF-TOKEN"]').attr('content')
                },
                data:{id:id,status:status},
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
    </script>
@endsection