$(document).ready(function() {
    Highcharts.setOptions({
        lang: {
            decimalPoint: ',',
            thousandsSep: '.'
        }
    });
    var options = {
        chart: {
            renderTo: 'container_sugerencias',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: ''
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage: .2f} %</b>'
        },
        plotOptions: {
            pie: {
               allowPointSelect: true,
               cursor: 'pointer',
               dataLabels: {
                  enabled: true,
                  color: '#000000',
                  connectorColor: '#000000',
                  format: '{point.y:,.f}'
               },
               showInLegend: true
           }
       },
       series: [{
           type: 'pie',
           name: 'Sugerencias por estado',
           data: []
       }]
    }

    $.getJSON("highCharts/pie_sugerencias_estados.php", function(json) {
        options.series[0].data = json;
        chart = new Highcharts.Chart(options);
    });

    $("#boton").click(function() {
        var name = $("#combo_bug").val();
        var url= "highCharts/pie_sugerencias_estados.php";
        $.ajax ({
                type: 'POST',
                url: url,
                dataType:'json',
                data: $("#formulario").serialize() + "&var1="+name ,
                success: function(json)
                {
                        options.series[0].data= json;
                        chart = new Highcharts.Chart(options);
                }
        });
    }); 


    $("#combo_bug").on("change", function(){
        var name = $("#combo_bug").val();
            var url= "highCharts/pie_sugerencias_estados.php";
            $.ajax ({
                type: "POST",
                url: url,
                dataType: 'json',
                data: $("#formulario").serialize() + "&var1="+name ,
                success: function(json)
                {
                        options.series[0].data= json;
                        chart = new Highcharts.Chart(options);
                }
            });
    });
}); 