$(document).ready(function() {
    Highcharts.setOptions({
        lang: {
            decimalPoint: ',',
            thousandsSep: '.'
        }
    });
    var options = {
        chart: {
            renderTo: 'containerVentasLinea',
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
                  format: '$ {point.y:,.2f}'
               },
               showInLegend: true
           }
       },
       series: [{
           type: 'pie',
           name: 'Ventas por Linea',
           data: []
       }]
    }

    $.getJSON("highCharts/pie_ventas_linea.php", function(json) {
        options.series[0].data = json;
        chart = new Highcharts.Chart(options);
    });

    $("#boton").click(function() {
        var name = $("#comboVend2").val();
        var url= "highCharts/pie_ventas_linea.php";
        $.ajax ({
                type: 'POST',
                url: url,
                dataType:'json',
                data: $("#formulario").serialize() + "&par1="+name ,
                success: function(json)
                {
                        options.series[0].data= json;
                        chart = new Highcharts.Chart(options);
                }
        });
    }); 


    $("#comboVend2").on("change", function(){
        var name = $("#comboVend2").val();
            var url= "highCharts/pie_ventas_linea.php";
            $.ajax ({
                type: "POST",
                url: url,
                dataType: 'json',
                data: $("#formulario").serialize() + "&par1="+name ,
                success: function(json)
                {
                        options.series[0].data= json;
                        chart = new Highcharts.Chart(options);
                }
            });
    });
}); 