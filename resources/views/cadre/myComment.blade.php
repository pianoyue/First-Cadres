<?php
/**
 * Created by PhpStorm.
 * User: yanyue
 * Date: 2018/4/8
 * Time: 20:52
 */ ?>
@extends('layout.Cadre')

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> 查看评论</h3>
            <!-- Main content -->
            {{--<section class="content">--}}

            <div class="row">
                    <div class="col-md-10 nav-tabs-custom" style="margin-left:100px;">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#activity" data-toggle="tab">已发表评论</a></li>
                        </ul>
                        <div class="tab-content">
                            <!-- 已发表评论模块 -->
                            <div class="active tab-pane" id="activity">
                            @foreach ($comments as $comment)
                                <!-- Post -->
                                    @if($comment->user_id == auth('admin')->user()->id)
                                        <div class="post">
                                            <div class="user-block">
                                    <span class="username">
                                        <a href="#">{{$comment->updated_at}}</a>
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
                                        </div>  <!-- /.post -->
                                    @endif
                                @endforeach

                            </div>
                        </div>
                        <!-- /.tab-content -->
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
    @endsection
