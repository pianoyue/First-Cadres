
@extends('layout.admin')

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i>第一书记统计表</h3>

            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <table class="table table-striped table-advance table-hover">

                            {{--添加导入--}}
                            <div class="row box-header">
                                <div class="col-sm-6">
                                    <div class="pull-right">
                                        <form method="post" action="{{ url('/stats/firstCadre/search') }}">

                                                <div class="input-group input-group-sm" >
                                                    {{ csrf_field() }}
                                                    <select class=" form-control" name="search" >
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

                                                    <div class="input-group-btn">
                                                    <button type="submit" class="btn btn-default">搜索</button>
                                                        <a class="btn btn-default btn-sm"  href="{{url('/firstcadre/export')}}">导出</a>
                                                    </div>
                                                </div>
                                        </form>
                                        {{--<div class="input-group-btn">--}}
                                            {{----}}
                                        {{--</div>--}}
                                    </div>
                                </div>
                                <div class="col-sm-6">

                                </div>
                            </div>

                            <hr>

                            <thead>
                            <tr>
                                <th>地区 </th>
                                <th>总人数</th>
                                <th>性别(男)</th>
                                <th>性别(女)</th>
                                <th>来源(中直)</th>
                                <th>来源(省直)</th>
                                <th>来源(市直)</th>
                                <th>来源(县直)</th>
                                <th>级别(处级)</th>
                                <th>级别(科级)</th>
                                <th>级别(一般干部)</th>
                                <th>年龄(<35)</th>
                                <th>年龄(35-45)</th>
                                <th>年龄(45-60)</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($i=0;$i<count($result,0);$i++)
                                <tr>
                                    <td>{{$result[$i][0]}}</td>
                                    <td>{{$result[$i][1]}}</td>
                                    <td>{{$result[$i][2]}}</td>
                                    <td>{{$result[$i][3]}}</td>
                                    <td>{{$result[$i][4]}}</td>
                                    <td>{{$result[$i][5]}}</td>
                                    <td>{{$result[$i][6]}}</td>
                                    <td>{{$result[$i][7]}}</td>
                                    <td>{{$result[$i][8]}}</td>
                                    <td>{{$result[$i][9]}}</td>
                                    <td>{{$result[$i][10]}}</td>
                                    <td>{{$result[$i][11]}}</td>
                                    <td>{{$result[$i][12]}}</td>
                                    <td>{{$result[$i][13]}}</td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div><!-- /content-panel -->
                </div><!-- /col-md-12 -->
            </div><!-- /row -->
            {{--分页--}}
            <div class="box-footer text-center">
                {{--{{ $pagination }}--}}
            </div>
        </section><! --/wrapper -->
    </section><!-- /MAIN CONTENT -->



@endsection