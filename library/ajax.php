<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>借阅动态</title>
    <!-- 引入 echarts.js -->
    <script src="https://cdn.staticfile.org/echarts/4.3.0/echarts.min.js"></script>
</head>
<body>
    <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
    <div id="main" style="width: 600px;height:400px;"></div>
    <script type="text/javascript">
        //基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));
        //loading加载动画
        myChart.showLoading();
        var arr1=[],arr2=[],arr3=[];
        function arrTest(){
            //这个功能块的作用就是读取json数据。
            $.ajax({
                type:"post",//请求服务器载入数据
                async:false,//异步属性
                url:"get.php",
                data:{},
                dataType:"json",
                success:function(result){
                    if (result) {
                        for (var i = 0; i < result.length; i++) {
                            arr1.push(result[i].借阅日期);
                            arr2.push(result[i].借阅者ID);
                            arr3.push(result[i].书本ID);
                        }
                    }
                }
            })
            return arr1,arr2;
        }
        arrTest();
        //加载完毕关闭loading加载
        myChart.hideLoading();

        // 指定图表的配置项和数据
        var option = {
            tooltip: {
                trigger: 'axis',
                position: function (pt) {
                    return [pt[0], '10%'];
                }
            },
            title: {
                left: 'center',
                text: '借阅动态',
            },
            toolbox: {
                feature: {
                    dataZoom: {
                        yAxisIndex: 'none'
                    },
                    restore: {},
                    saveAsImage: {}
                }
            },
            xAxis: {
                type: 'category',
                boundaryGap: false,
                data:arr1
            },
             yAxis: {
                type: 'value',
                boundaryGap: [0, '100%']
            },
            series: [
            {
                name:'借阅者ID',
                type:'line',
                smooth:true,
                symbol: 'none',
                sampling: 'average',
                itemStyle: {
                    normal: {
                        color: 'rgb(255, 70, 131)'
                    }
                },
                areaStyle: {
                    normal: {
                        color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                            offset: 0,
                            color: 'rgb(255, 158, 68)'
                        }, {
                            offset: 1,
                            color: 'rgb(255, 70, 131)'
                        }])
                    }
                },
                data: arr2
            }]
        };
        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    </script>
</body>
</html>