
@extends('layout.admin')

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i>驻村干部(不含第一书记)统计结果图表</h3>

            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel" >
                        <button class="btn btn-primary btn-sm" onclick="chart()" href="javascript:">生成图表</button>
                        <div class="row box-header">
                            <div style="width: 300px;height: 300px;float: left;" >
                                <canvas id="my_chart" ></canvas>
                            </div>
                            <div style="width: 300px;height: 300px;float: left;" >
                                <canvas id="my_chart2" ></canvas>
                            </div>
                            <div style="width: 300px;height: 300px;float: left;" >
                                <canvas id="my_chart3" ></canvas>
                            </div>
                            <div style="width: 300px;height: 300px;float: left;" >
                                <canvas id="my_chart4" ></canvas>
                            </div>
                            <div style="width: 300px;height: 300px;float: left;" >
                                <canvas id="my_chart5" ></canvas>
                            </div>
                        </div>
                    </div><!-- /content-panel -->
                </div><!-- /col-md-12 -->
            </div><!-- /row -->

        </section><! --/wrapper -->
    </section><!-- /MAIN CONTENT -->

<script>
    function chart() {
        $.get('get_chart_data',function (data, status) {
            var ctx = document.getElementById("my_chart").getContext("2d");
            var my_chart = new Chart(ctx,{
                type: 'pie',
                data: {
                    labels: [
                        "男",
                        "女"
                    ],
                    datasets: [{
                        data: data[0],
                        backgroundColor: [
                            window.chartColors.red,
                            window.chartColors.orange
                        ]
                    }]
                },
                options: {
                    responsive: true
                }
            });


            var ctx2 = document.getElementById("my_chart2").getContext("2d");
            var my_chart2 = new Chart(ctx2,{
                type: 'pie',
                data: {
                    labels: [
                        "中直",
                        "省直",
                        "市直",
                        "县直"
                    ],
                    datasets: [{
                        data: data[1],
                        backgroundColor: [
                            window.chartColors.red,
                            window.chartColors.orange,
                            window.chartColors.purple,
                            window.chartColors.green
                        ]
                    }]
                },
                options: {
                    responsive: true
                }
            });

            var ctx3 = document.getElementById("my_chart3").getContext("2d");
            var my_chart3 = new Chart(ctx3,{
                type: 'pie',
                data: {
                    labels: [
                        "厅级",
                        "处级",
                        "科级",
                        "一般干部"
                    ],
                    datasets: [{
                        data: data[2],
                        backgroundColor: [
                            window.chartColors.red,
                            window.chartColors.orange,
                            window.chartColors.purple,
                            window.chartColors.green
                        ]
                    }]
                },
                options: {
                    responsive: true
                }
            });


            var ctx4 = document.getElementById("my_chart4").getContext("2d");
            var my_chart4 = new Chart(ctx4,{
                type: 'pie',
                data: {
                    labels: [
                        "博士",
                        "硕士",
                        "本科",
                        "中专",
                        "中专及以下"
                    ],
                    datasets: [{
                        data: data[3],
                        backgroundColor: [
                            window.chartColors.red,
                            window.chartColors.orange,
                            window.chartColors.purple,
                            window.chartColors.green,
                            window.chartColors.blue
                        ]
                    }]
                },
                options: {
                    responsive: true
                }
            });


            var ctx5 = document.getElementById("my_chart5").getContext("2d");
            var my_chart5 = new Chart(ctx5,{
                type: 'pie',
                data: {
                    labels: [
                        "年龄：<35",
                        "年龄：35-45",
                        "年龄：45-60"
                    ],
                    datasets: [{
                        data: data[4],
                        backgroundColor: [
                            window.chartColors.red,
                            window.chartColors.orange,
                            window.chartColors.purple
                        ]
                    }]
                },
                options: {
                    responsive: true
                }
            });





        });
    }


    window.chartColors = {
        red: 'rgb(255, 99, 132)',
        orange: 'rgb(255, 159, 64)',
        yellow: 'rgb(255, 205, 86)',
        green: 'rgb(75, 192, 192)',
        blue: 'rgb(54, 162, 235)',
        purple: 'rgb(153, 102, 255)',
        grey: 'rgb(201, 203, 207)'
    };
</script>

@endsection