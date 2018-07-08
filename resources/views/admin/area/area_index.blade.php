
@extends('layout.admin')

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> 属地信息管理</h3>

            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <table class="table table-striped table-advance table-hover">
                            <h4><i class="fa fa-angle-right"></i>所有属地</h4>
                            {{--添加导入--}}
                            <div class="row box-header">
                                <div class="col-sm-6">
                                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addAreaModal" href="javascript:">添加</a>
                                    <a class="btn btn-default btn-sm" onclick="" href="javascript:">导出</a>
                                </div>
                                <div class="col-sm-6">
                                    <div class="pull-right">
                                        <form method="post" action="{{ url('/area/search') }}">
                                            <div class="input-group input-group-sm" style="width: 350px;">
                                                {{ csrf_field() }}
                                                <input type="text" name="search_text" class="form-control" placeholder="搜索....">
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
                                <th>区域名称</th>
                                <th>上级区域</th>
                                <th>驻村工作组数量</th>
                                <th>村类型</th>
                                <th>用户操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($areas as $area)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $area->area_name }}</td>
                                <td>{{ $area->area_manage }}</td>
                                <td>{{ $area->area_number }}</td>
                                <td>
                                    @if ($area->area_type == 0)
                                        非村级单位
                                    @elseif($area->area_type == 1)
                                        贫困村
                                    @elseif($area->area_type == 2)
                                        软弱涣散村
                                    @elseif($area->area_type == 3)
                                        贫困和软弱涣散村
                                    @else
                                        其他村
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-xs"><i class="fa fa-pencil" data-toggle="modal" data-target="#editAreaModal"
                                                                              onclick="editArea({{ $area->id }},
                                                                                      '{{ $area->area_name }}',
                                                                                      '{{ $area->area_manage }}',
                                                                                      '{{ $area->area_type }}',
                                                                                      '{{ $area->area_number }}')" href="javascript:"></i></button>
                                    <button class="btn btn-danger btn-xs" ><i class="fa fa-trash-o " onclick="deleteArea({{ $area->id }})" href="javascript:"></i></button>
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
    <div class="modal fade" id="addAreaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">添加属地信息</h4>
                </div>
                <form class="form-horizontal" method="POST" id="add-user">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label class="col-md-3 control-label">区域名称：</label>

                            <div class="col-md-7">
                                <input type="text" class="form-control" name="area_name" value="{{ old('area_name') }}" placeholder="请输入区域名称" required autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 control-label">上级区域：</label>

                            <div class="col-md-7">
                                <input type="text" id="city-picker3" class="form-control" readonly name="area_manage" style="width:320px;" data-toggle="city-picker" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right">村类型：</label>

                            <div class="col-md-7">
                                <select class="form-control" name="area_type" id="area_type_">
                                    <option value="0">非村级单位</option>
                                    <option value="1">贫困村</option>
                                    <option value="2">软弱涣散村</option>
                                    <option value="3">贫困和软弱涣散村</option>
                                    <option value="3">其他村</option>
                                </select>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_gender" class="col-md-3 col-form-label text-md-right">驻村工作组数量：</label>

                            <div class="col-md-7">
                                <input type="number" class="form-control" name="area_number" value="" placeholder="请输入驻村工作组数量" >
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
    <div class="modal fade" id="editAreaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">编辑属地信息</h4>
                </div>
                <form class="form-horizontal" action="{{url('/area/edit')}}" method="POST" id="add-user">
                    <div class="modal-body">
                        {{ csrf_field() }}

                        {{--隐藏字段，传id--}}
                        <input type="hidden" name="id" id="id" value="">

                        <div class="form-group">
                            <label class="col-md-3 control-label">区域名称：</label>

                            <div class="col-md-7">
                                <input type="text" class="form-control" name="area_name" id="area_name_" value="{{ old('area_name') }}"required autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label  class="col-md-3 col-form-label text-md-right">上级区域：</label>

                            <div class="col-md-7">
                                <input type="text" id="city-picker3" class="form-control" readonly name="area_manage" style="width:320px;" data-toggle="city-picker" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right" >村类型：</label>

                            <div class="col-md-7">
                                <select class="form-control" name="area_type" id="area_type_">
                                    <option value="0">非村级单位</option>
                                    <option value="1">贫困村</option>
                                    <option value="2">软弱涣散村</option>
                                    <option value="3">贫困和软弱涣散村</option>
                                    <option value="3">其他村</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label  class="col-md-3 col-form-label text-md-right">驻村工作组数量：</label>

                            <div class="col-md-7">
                                <input type="number" id="area_number_" class="form-control" name="area_number" value="{{ old('area_number') }}" >
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
                $('#addAreaModal').modal('show');
            @endif
        });


        function deleteArea(id) {             //删除用户

            $.ajax({
                url:'{{ url('/area/delete') }}',
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

        function editArea(id,area_name,area_manage,area_type,area_number) {    //编辑用户
            $("#editAreaModal").modal("hide");//手动隐藏模态框
            $("#id").val(id);                //往带id的标签里传入定义好的值

            $("#area_name_").attr("value",area_name); //设置该标签的属性值
            $("#area_manage_").attr("value",area_manage);
            $("#area_type_").attr("value",area_type);
            $("#area_number_").attr("value",area_number);

        }
    </script>
@endsection