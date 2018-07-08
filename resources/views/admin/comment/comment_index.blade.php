<?php
/**
 * Created by PhpStorm.
 * User: yanyue
 * Date: 2018/4/8
 * Time: 11:17
 */?>
@extends('layout.admin')

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> 查看评论</h3>
    <!-- Main content -->
    {{--<section class="content">--}}

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="{{asset("img/ui-zac.jpg")}}" alt="头像">

                        <h3 class="profile-username text-center">{{$cadre->cadre_trueName}}</h3>

                        <p class="text-muted text-center">
                            @if ($cadre->political_status == 0)
                                党员
                            @elseif($cadre->political_status == 1)
                                团员
                            @else
                                无党派人士
                            @endif
                        </p>

                        <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>所属区域</b> <a class="pull-right">{{$str}}</a>
                                </li>
                               <li class="list-group-item">
                                   <b>发表评论数</b> <a class="pull-right">4</a>
                               </li>
                               <li class="list-group-item">
                                   <b>最新评论时间</b> <a class="pull-right">2018-04-09</a>
                               </li>
                        </ul>

                        <a href="{{url('/cadre')}}" class="btn btn-primary btn-block"><b>返回页面</b></a>
                    </div>
                 <!-- /.box-body -->
                </div>
             <!-- /.box -->
            </div>
             <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                     <ul class="nav nav-tabs">
                         <li class="active"><a href="#activity" data-toggle="tab">已发表评论</a></li>
                         <li><a href="#settings" data-toggle="tab">新增评论</a></li>
                     </ul>
                     <div class="tab-content">
                         <!-- 已发表评论模块 -->
                         <div class="active tab-pane" id="activity">
                         @foreach ($comments as $comment)
                          <!-- Post -->
                          @if($comment->user_id == $cadre->id)
                            <div class="post">
                                <div class="user-block">
                                    <span class="username">
                                        <a href="#">{{$comment->updated_at}}</a>
                                        <a onclick="deleteComment({{$comment->id}})" href="javascript:" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                                    </span>
                                </div>
                                <!-- /.user-block -->
                                <p>
                                    @if($comment->level==0)
                                        等级：好
                                    @elseif($comment->level==1)
                                        等级：较好
                                    @elseif($comment->level==2)
                                        等级：一般
                                    @else
                                        等级：差
                                    @endif
                                </p>

                                <p>
                                {{$comment->text}}
                                </p>

                                <ul class="list-inline">
                                    <li class="pull-right">
                                        <a class="link-black text-sm" data-toggle="modal" data-target="#editComment" onclick="editComment({{ $comment->id }},'{{$comment->text}}','{{$comment->level}}')" href="javascript:"><i class="fa fa-comments-o margin-r-5"></i> 编辑评论</a></li>
                                </ul>
                                <br>

                            </div>  <!-- /.post -->
                              @endif
                             @endforeach

                         </div>

                         {{--增加评论模块--}}
                        <div class="tab-pane" id="settings">
                            <form class="form-horizontal" action="{{url('/comment/add')}}" method="POST">
                                {{ csrf_field() }}

                                {{--隐藏字段，传被操作用户id--}}
                                <input type="hidden" name="cadre_id" value="{{$cadre->id}}">

                                {{--隐藏字段，传被操作用户真实姓名--}}
                                <input type="hidden" name="user_trueName" value="{{$cadre->cadre_trueName}}">

                                {{--隐藏字段，传管理员用户id--}}
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-1 control-label">等级：</label>

                                    <div class="col-sm-11">
                                            <select class="form-control" name="level">
                                                <option value="0">好</option>
                                                <option value="1">较好</option>
                                                <option value="2">一般</option>
                                                <option value="3">差</option>
                                            </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-1 control-label">内容：</label>

                                    <div class="col-sm-11">
                                        <textarea class="form-control" name="text" placeholder="请输入评论内容..."></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-1 col-sm-11">
                                        <button type="submit" class="btn btn-danger">提交</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                     </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
            {{--分页--}}
            <div class="box-footer text-center">
                {{ $pagination }}
            </div>

        </section>
    </section>
    <!-- /.content -->


    {{--编辑评论模态框--}}
    <div class="modal fade" id="editComment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">编辑评论</h4>
                </div>
                <form class="form-horizontal" action="{{url('/comment/edit')}}" method="POST" id="add-user">
                    <div class="modal-body">
                        {{ csrf_field() }}

                        {{--隐藏字段，传被编辑评论id--}}
                        <input type="hidden" name="id" id="id" value="">

                        {{--隐藏字段，传编辑评论的管理员id--}}
                        <input type="hidden" name="user_id"  value="{{Auth::user()->id}}">

                        <div class="form-group">
                            <label class="col-md-2 control-label">等级：</label>

                            <div class="col-md-10">
                                <select class="form-control" name="level" id="level">
                                    <option value="0">好</option>
                                    <option value="1">较好</option>
                                    <option value="2">一般</option>
                                    <option value="3">差</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-2 control-label">内容：</label>

                            <div class="col-md-10">
                                <textarea class="form-control" name="text" id="text"></textarea>
                            </div>
                        </div>

                    <div class="modal-footer ">
                        <div class="form-group text-center">
                            <a class="btn btn-default" data-dismiss="modal">关闭</a>
                            <button type="submit" class="btn btn-primary">确定</button>
                        </div>
                    </div>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>


    <script>
        function editComment(id,text,level) {    //编辑评论
            $("#editComment").modal("hide");//手动隐藏模态框
            $("#id").val(id);                //往带id的标签里传入定义好的值

            $("#text").val(text);         //设置该标签的属性值
            $("#level").val(level);

        }


        function deleteComment(id) {             //删除
            $.ajax({
                url:'{{ url('/comment/delete') }}',
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
                    window.location.href='{{url('/comment_total')}}'  //成功后返回/comment_total页面
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