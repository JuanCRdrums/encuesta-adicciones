function  generateChartinatorJs(selectorId,chartType){
    var chartType = chartType || 'PieChart';
    var colors = ['#94ac27', '#3691ff', '#e248b3', '#f58327', '#bf5cff', '#FF8000','#0080FF','#31B404','#DF013A','#088A08','#FF00FF','#2EFEF7','#F78181'];

    var chart = $('#'+selectorId).chartinator({
        chartType: chartType,
        dataTitle: 'Gráfica',
        pieChart: {
            colors: colors,
            is3D: true, 
            height: 400,
            sliceVisibilityThreshold:0,
        },
        barChart: {
            colors: colors,
            height: 400,
        },
        showTable: 'hide'
    });
}

function generateChartJs(selectorId,type,dataChart,options){
    var ctx = document.getElementById(selectorId).getContext("2d");
    var type = type || "line";
    var dataChart = dataChart || [];

    if (type === 'pie' && "annotation" in options)
        delete options['annotation'];

    if (type === 'pie') { 
        $.each(dataChart.datasets, function(index, val) {
            dataChart.datasets[index].backgroundColor =  getArrayColors(dataChart.labels.length);
        });
    }

    var myChart = new Chart(ctx, {
        type: type,
        data: dataChart,
        options: options
    });
}