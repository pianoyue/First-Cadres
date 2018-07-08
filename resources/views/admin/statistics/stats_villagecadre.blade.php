
@extends('layout.admin')

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i>驻村干部名册</h3>

            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <table class="table table-striped table-advance table-hover">

                            {{--添加导入--}}
                            <div class="row box-header">
                                <div class="col-sm-8">
                                    <div class="pull-right">
                                        <form method="post" action="{{ url('/stats/villageCadre/search') }}">

                                                <div class="input-group input-group-sm" >
                                                    {{ csrf_field() }}
                                                    <select class=" form-control" name="search" style="width: 300px" >
                                                        <option value=""></option>
                                                        <option value="0">广西壮族自治区</option>
                                                        <option value="1">南宁市</option>
                                                        <option value="2">柳州市</option>
                                                        <option value="3">桂林市</option>
                                                        <option value="4">梧州市</option>
                                                        <option value="5">北海市</option>
                                                        <option value="6">防城港市</option>
                                                        <option value="7">钦州市</option>
                                                        <option value="8">贵港市</option>
                                                        <option value="9">玉林市</option>
                                                        <option value="10">百色市</option>
                                                        <option value="11">贺州市</option>
                                                        <option value="12">河池市</option>
                                                        <option value="13">来宾市</option>
                                                        <option value="14">崇左市</option>
                                                    </select>


                                                    {{--<label style="width: 50px">起始驻村时间：</label>--}}
                                                    <input type="date" class="form-control" name="search_time" placeholder="请输入驻村时间" style="width:300px;">

                                                    <div class="input-group-btn">
                                                    <button type="submit" class="btn btn-default">搜索</button>
                                                        <a class="btn btn-default btn-sm"  href="{{url('/firstcadre/export')}}">导出</a>
                                                    </div>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-sm-6">

                                </div>
                            </div>

                            <hr>

                            <thead>
                            <tr>
                                <th></th>
                                <th>所属市</th>
                                <th>所属县、区</th>
                                <th>所属乡、镇</th>
                                <th>姓名</th>
                                <th>性别</th>
                                <th>年龄</th>
                                <th>学历</th>
                                <th>政治面貌</th>
                                <th>单位名称</th>
                                <th>职务</th>
                                <th>手机号码</th>
                                <th>住所</th>
                                <th>组内身份</th>
                                <th>是否当任第一书记</th>
                                <th>开始驻村时间</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($cadres as $cadre_user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $cadre_user->cadreRegion_c }}</td>
                                    <td>{{ $cadre_user->cadreRegion_t }}</td>
                                    <td>{{ $cadre_user->cadreRegion_v }}</td>
                                    <td>{{ $cadre_user->cadre_trueName }}</td>
                                    <td>
                                        @if ($cadre_user->cadre_gender == 0)
                                            男
                                        @else
                                            女
                                        @endif
                                    </td>
                                    <td>{{ $cadre_user->age}}</td>
                                    <td>
                                        @if ($cadre_user->education == 0)
                                            博士
                                        @elseif($cadre_user->education == 1)
                                            硕士
                                        @elseif($cadre_user->education == 2)
                                            本科
                                        @elseif($cadre_user->education == 3)
                                            大专
                                        @else
                                            中专及以下
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
                                    <td>{{ $cadre_user->company }}</td>
                                    <td>
                                        @if ($cadre_user->job == 0)
                                            厅级干部
                                        @elseif($cadre_user->job == 1)
                                            正处级干部
                                        @elseif($cadre_user->job == 2)
                                            副处级干部
                                        @elseif($cadre_user->job == 3)
                                            科级干部
                                        @elseif($cadre_user->job == 4)
                                            一般干部
                                        @else
                                            其他人员
                                        @endif
                                    </td>
                                    <td>{{ $cadre_user->cadre_phone }}</td>
                                    <td>{{ $cadre_user->address }}</td>
                                    <td>
                                        @if ($cadre_user->identity == 0)
                                            组长
                                        @elseif($cadre_user->identity == 1)
                                            组员
                                        @elseif($cadre_user->identity == 2)
                                            工作人员
                                        @else
                                            大学毕业生
                                        @endif
                                    </td>
                                    <td>
                                        @if ($cadre_user->secretary == 0)
                                            否
                                        @else
                                            是
                                        @endif
                                    </td>
                                    <td>{{ $cadre_user->startTime }}</td>
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



@endsection