@extends('layout.Cadre')
@section('content')
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> 修改资料</h3>
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="content-panel">
                        <h4><i class="fa fa-angle-right"></i> 修改详细资料</h4>
                        <hr>
                        <section id="unseen">
                            <form class="form-horizontal style-form" method="post" name="form1" action="">
                                <div class="form-inline form-group row" >
                                    {{ csrf_field() }}

                                    {{--隐藏字段，传编辑用户id--}}
                                    <input type="hidden" name="id" value="{{auth('admin')->user()->id}}">
                                </div>

                                <div class="form-inline form-group row" >
                                    <label class="col-sm-2 control-label" style="text-align: right;">真实姓名：</label>
                                    <div class="col-sm-4">
                                         <input type="text" class="form-control" name="cadre_trueName" value="{{auth('admin')->user()->cadre_trueName}}" style="width: 80%;">
                                    </div>
                                    <label class="col-sm-2 control-label" style="text-align: right;">性别：</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="cadre_gender" id="cadre_gender_" value="{{auth('admin')->user()->cadre_gender}}" style="width: 80%;">
                                            <option value="0">男</option>
                                            <option value="1">女</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-inline form-group row" >
                                    <label class="col-sm-2 control-label" style="text-align: right;">出生年月：</label>
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control" name="birth" value="{{auth('admin')->user()->birth}}" style="width: 80%;">
                                    </div>
                                    <label class="col-sm-2 control-label" style="text-align: right;">政治面貌：</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="political_status" id="political_status_"  value="{{auth('admin')->user()->political_status}}" style="width: 80%;">
                                            <option value="0">党员</option>
                                            <option value="1">团员</option>
                                            <option value="2">无党派人士</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-inline form-group row" >
                                    <label class="col-sm-2 control-label" style="text-align: right;">选择区域：</label>
                                    <div class="col-sm-4">
                                        <input type="text" id="city-picker3" class="form-control" readonly name="Region" value="江苏省/常州市/溧阳市" data-toggle="city-picker" style="width:283px;">
                                    </div>
                                    <label class="col-sm-2 control-label" style="text-align: right;">学历：</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="education" id="political_status_"  value="{{auth('admin')->user()->education}}" style="width: 80%;">
                                            <option value="0">博士</option>
                                            <option value="1">硕士</option>
                                            <option value="2">本科</option>
                                            <option value="3">专科</option>
                                            <option value="4">中专及以下</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="form-inline form-group row" >
                                    <label class="col-sm-2 control-label" style="text-align: right;">单位名称：</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="company" value="{{auth('admin')->user()->company}}" style="width: 80%;">
                                    </div>
                                    <label class="col-sm-2 control-label" style="text-align: right;">职务：</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="job"   value="{{auth('admin')->user()->job}}" style="width: 80%;">
                                            <option value="0">厅级干部</option>
                                            <option value="1">正处级干部</option>
                                            <option value="2">副处级干部</option>
                                            <option value="3">科级干部</option>
                                            <option value="4">一般干部</option>
                                            <option value="5">其他人员</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-inline form-group row" >
                                    <label class="col-sm-2 control-label" style="text-align: right;">开始驻村时间：</label>
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control" name="startTime" value="{{auth('admin')->user()->startTime}}" style="width: 80%;">
                                    </div>
                                    <label class="col-sm-2 control-label" style="text-align: right;">结束驻村时间：</label>
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control" name="endTime" value="{{auth('admin')->user()->endTime}}" style="width: 80%;">
                                    </div>

                                </div>

                                <div class="form-inline form-group row" >
                                    <label class="col-sm-2 control-label" style="text-align: right;">是否担任第一书记：</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="secretary"   value="{{auth('admin')->user()->secretary}}" style="width: 80%;">
                                            <option value="0">不是</option>
                                            <option value="1">是</option>
                                        </select>
                                    </div>
                                    <label class="col-sm-2 control-label" style="text-align: right;">组内身份：</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="identity" id="political_status_"  value="{{auth('admin')->user()->identity}}" style="width: 80%;">
                                            <option value="0">组长</option>
                                            <option value="1">组员</option>
                                            <option value="2">工作人员</option>
                                            <option value="3">大学毕业生</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-inline form-group row" >
                                    <label class="col-sm-2 control-label" style="text-align: right;">来源：</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="origin" id="political_status_"  value="{{auth('admin')->user()->origin}}" style="width: 80%;">
                                            <option value="0">中直</option>
                                            <option value="1">省直</option>
                                            <option value="2">市直</option>
                                            <option value="3">县直</option>
                                        </select>
                                    </div>
                                    <label class="col-sm-2 control-label" style="text-align: right;">住所：</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="address" value="{{auth('admin')->user()->address}}" style="width: 80%;">
                                    </div>

                                </div>

                                <div class="form-inline form-group row" >
                                    <label class="col-sm-2 control-label" style="text-align: right;">手机：</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="cadre_phone" value="{{auth('admin')->user()->cadre_phone}}" style="width: 80%;">
                                    </div>

                                </div>


                                {{--提交按钮--}}
                                    <button type="submit" id="submit" class="btn btn-primary  btn-block" style="width: 30%;margin: auto;">提交</button>
                            </form>
                        </section>
                    </div><!-- /content-panel -->
                </div><!-- /col-lg-4 -->
            </div><!-- /row -->

        </section><! --/wrapper -->
    </section><!-- /MAIN CONTENT -->
   <script>
       $('#submit').click(function(){
           alert('提交成功！');
       });
   </script>
@endsection