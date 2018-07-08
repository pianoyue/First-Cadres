
@extends('layout.admin')

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i>驻村干部(不含第一书记)统计表</h3>

            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <a class="btn btn-primary btn-sm" href="{{url('/get_chart')}}">生成图表</a>
                        <table class="table table-striped table-advance table-hover">
                            <hr>
                            <thead>
                            <tr>
                                <th>总人数</th>
                                <th>男</th>
                                <th>女</th>
                                <th>党员</th>
                                <th>中直</th>
                                <th>省直</th>
                                <th>市直</th>
                                <th>县直</th>
                                <th>厅级</th>
                                <th>处级</th>
                                <th>科级</th>
                                <th>一般干部</th>
                                <th>博士</th>
                                <th>硕士</th>
                                <th>本科</th>
                                <th>中专</th>
                                <th>中专及以下</th>
                                <th><35</th>
                                <th>35-45</th>
                                <th>45-60</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$result[0]}}</td>
                                    <td>{{$result[1]}}</td>
                                    <td>{{$result[2]}}</td>
                                    <td>{{$result[3]}}</td>
                                    <td>{{$result[4]}}</td>
                                    <td>{{$result[5]}}</td>
                                    <td>{{$result[6]}}</td>
                                    <td>{{$result[7]}}</td>
                                    <td>{{$result[8]}}</td>
                                    <td>{{$result[9]}}</td>
                                    <td>{{$result[10]}}</td>
                                    <td>{{$result[11]}}</td>
                                    <td>{{$result[12]}}</td>
                                    <td>{{$result[13]}}</td>
                                    <td>{{$result[14]}}</td>
                                    <td>{{$result[15]}}</td>
                                    <td>{{$result[16]}}</td>
                                    <td>{{$result[17]}}</td>
                                    <td>{{$result[18]}}</td>
                                    <td>{{$result[19]}}</td>
                                </tr>
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