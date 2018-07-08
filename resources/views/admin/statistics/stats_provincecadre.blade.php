
@extends('layout.admin')

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i>省直单位选派同步小康驻村队员名册</h3>

            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <table class="table table-striped table-advance table-hover">

                            {{--添加导入--}}
                            <div class="row box-header">
                                <div class="col-sm-6">
                                    <div class="pull-right">
                                        <form method="post" action="{{ url('/stats/provinceCadre/search') }}">

                                                <div class="input-group input-group-sm" >
                                                    {{ csrf_field() }}
                                                    <input type="text" name="search_name" class="form-control" placeholder="姓名……" >

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
                                <th> </th>
                                <th>单位</th>
                                <th>姓名</th>
                                <th>性别</th>
                                <th>学历</th>
                                <th>政治面貌</th>
                                <th>出生年月</th>
                                <th>职务</th>
                                <th>开始驻村时间</th>
                                <th>手机</th>
                                <th>是否担任第一书记</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($cadres as $cadre_user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $cadre_user->company }}</td>
                                    <td>{{ $cadre_user->cadre_trueName }}</td>
                                    <td>
                                        @if ($cadre_user->cadre_gender == 0)
                                            男
                                        @else
                                            女
                                        @endif
                                    </td>
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
                                    <td>{{ $cadre_user->birth }}</td>
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

                                    <td>{{ $cadre_user->startTime }}</td>
                                    <td>{{ $cadre_user->cadre_phone }}</td>
                                    <td>
                                        @if ($cadre_user->secretary == 0)
                                            否
                                        @else
                                            是
                                        @endif
                                    </td>

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