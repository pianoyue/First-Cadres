@extends('layout.Cadre')
@section('content')
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> 我的资料</h3>
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="content-panel">
                        <h4><i class="fa fa-angle-right"></i> 详细资料</h4>
                        <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed" align="center" style="width: 80% ;text-align: center;">
                                <thead>
                                <tr style="height: 20px">
                                    <th class="numeric" style="width: 25%;vertical-align: middle;"></th>
                                    <th class="numeric" style="width: 25%;vertical-align: middle;"></th>
                                    <th class="numeric" style="width: 25%;vertical-align: middle;"></th>
                                    <th class="numeric" style="width: 25%;vertical-align: middle;"></th>
                                </tr>
                                </thead>
                                <tbody >
                                <tr style="height: 60px">
                                    <td class="numeric" style="vertical-align: middle">真实姓名：</td>
                                    <td class="numeric" style="vertical-align: middle">{{auth('admin')->user()->cadre_trueName}}</td>
                                    <td class="numeric" style="vertical-align: middle">性别：</td>
                                    <td class="numeric" style="vertical-align: middle">
                                        @if (auth('admin')->user()->cadre_gender == 0)
                                            男
                                        @else
                                            女
                                        @endif
                                    </td>
                                </tr>
                                <tr style="height: 60px">
                                    <td class="numeric" style="vertical-align: middle">出生年月：</td>
                                    <td class="numeric" style="vertical-align: middle">{{auth('admin')->user()->birth}}</td>
                                    <td class="numeric" style="vertical-align: middle">年龄：</td>
                                    <td class="numeric" style="vertical-align: middle">{{auth('admin')->user()->age}}</td>
                                </tr>
                                <tr style="height: 60px">
                                    <td class="numeric" style="vertical-align: middle">政治面貌：</td>
                                    <td class="numeric" style="vertical-align: middle">
                                        @if (auth('admin')->user()->political_status == 0)
                                            党员
                                        @elseif(auth('admin')->user()->political_status == 1)
                                            团员
                                        @else
                                            无党派人士
                                        @endif
                                    </td>
                                    <td class="numeric" style="vertical-align: middle">县（市、区）：</td>
                                    <td class="numeric" style="vertical-align: middle">{{auth('admin')->user()->cadreRegion_c}}</td>
                                </tr>
                                <tr style="height: 60px">
                                    <td class="numeric" style="vertical-align: middle">所属乡镇：</td>
                                    <td class="numeric" style="vertical-align: middle">{{auth('admin')->user()->cadreRegion_t}}</td>
                                    <td class="numeric" style="vertical-align: middle">帮扶村名称：</td>
                                    <td class="numeric" style="vertical-align: middle">{{auth('admin')->user()->cadreRegion_v}}</td>
                                </tr>
                                <tr style="height: 60px">
                                    <td class="numeric" style="vertical-align: middle">开始驻村时间：</td>
                                    <td class="numeric" style="vertical-align: middle">{{auth('admin')->user()->startTime}}</td>
                                    <td class="numeric" style="vertical-align: middle">结束驻村时间：</td>
                                    <td class="numeric" style="vertical-align: middle">{{auth('admin')->user()->endTime}}</td>
                                </tr>
                                <tr style="height: 60px">
                                    <td class="numeric" style="vertical-align: middle">学历：</td>
                                    <td class="numeric" style="vertical-align: middle">
                                        @if (auth('admin')->user()->education == 0)
                                            博士
                                        @elseif(auth('admin')->user()->education == 1)
                                            硕士
                                        @elseif(auth('admin')->user()->education == 2)
                                            本科
                                        @elseif(auth('admin')->user()->education == 3)
                                            专科
                                        @else
                                            中专及以下
                                        @endif
                                    </td>
                                    <td class="numeric" style="vertical-align: middle">单位名称：</td>
                                    <td class="numeric" style="vertical-align: middle"> {{auth('admin')->user()->company}} </td>
                                </tr>
                                <tr style="height: 60px">
                                    <td class="numeric" style="vertical-align: middle">职务：</td>
                                    <td class="numeric" style="vertical-align: middle">
                                        @if (auth('admin')->user()->job == 0)
                                            厅级干部
                                        @elseif(auth('admin')->user()->job == 1)
                                            正处级干部
                                        @elseif(auth('admin')->user()->job == 2)
                                            副处级干部
                                        @elseif(auth('admin')->user()->job == 3)
                                            科级干部
                                        @elseif(auth('admin')->user()->job == 4)
                                            一般干部
                                        @else
                                            其他人员
                                        @endif
                                    </td>
                                    <td class="numeric" style="vertical-align: middle">住所：</td>
                                    <td class="numeric" style="vertical-align: middle">{{auth('admin')->user()->address}}  </td>
                                </tr>
                                <tr style="height: 60px">
                                    <td class="numeric" style="vertical-align: middle">组内身份：</td>
                                    <td class="numeric" style="vertical-align: middle">
                                        @if (auth('admin')->user()->identity == 0)
                                            组长
                                        @elseif(auth('admin')->user()->identity == 1)
                                            组员
                                        @elseif(auth('admin')->user()->identity == 2)
                                            工作人员
                                        @else
                                            大学毕业生
                                        @endif
                                    </td>
                                    <td class="numeric" style="vertical-align: middle">是否担任第一书记：</td>
                                    <td class="numeric" style="vertical-align: middle">
                                        @if (auth('admin')->user()->secretary == 0)
                                            不是
                                        @else
                                            是
                                        @endif
                                    </td>
                                </tr>
                                <tr style="height: 60px">
                                    <td class="numeric" style="vertical-align: middle">来源：</td>
                                    <td class="numeric" style="vertical-align: middle">
                                        @if (auth('admin')->user()->origin == 0)
                                            中直
                                        @elseif(auth('admin')->user()->origin == 1)
                                            省直
                                        @elseif(auth('admin')->user()->origin == 2)
                                            市直
                                        @else
                                            县直
                                        @endif
                                    </td>
                                    <td class="numeric" style="vertical-align: middle">手机：</td>
                                    <td class="numeric" style="vertical-align: middle">  {{auth('admin')->user()->cadre_phone}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </section>
                    </div><!-- /content-panel -->
                </div><!-- /col-lg-4 -->
            </div><!-- /row -->

        </section><! --/wrapper -->
    </section><!-- /MAIN CONTENT -->

@endsection