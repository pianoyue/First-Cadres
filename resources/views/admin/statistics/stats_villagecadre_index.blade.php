
@extends('layout.admin')

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i>驻村干部统计表</h3>

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
                                                    <select class=" form-control" name="search" style="width: 300px;">
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

                                                    {{--<label class="col-form-label">起始驻村时间：</label>--}}
                                                    <input type="date" class="form-control" name="search_time" placeholder="请输入驻村时间" style="width:300px;">

                                                    <div class="input-group-btn">
                                                        <button type="submit" class="btn btn-default">搜索</button>
                                                    </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                </div>
                            </div>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </section>



@endsection