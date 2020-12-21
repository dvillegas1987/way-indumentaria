

$(document).ready(function() {
			
			Highcharts.setOptions({
				lang: {
					decimalPoint: ',',
					thousandsSep: '.'
				}
			});

			var options = {
	            chart: {
	                renderTo: 'containerColumn',
	                type: 'column',
	                marginRight: 130,
	                marginBottom: 25
	            },
	            title: {
	                text: '',
	                x: -20 //center
	            },
	            subtitle: {
	                text: '',
	                x: -20
	            },
	            xAxis: {
	                categories: []
	            },
	            yAxis: {
	                title: {
	                    text: 'Cantidad de Ventas'
	                },
	                plotLines: [{
	                    value: 0,
	                    width: 1,
	                    color: '#808080'
	                }]
	            },
	            tooltip: {
	                formatter: function() {
	                        return '<b>' + this.x + '</b><br/>' +
		                    this.series.name + ': ' + this.y + '<br/>' +
		                    'Total: ' + this.point.stackTotal;
	                }
	            },
	            legend: {
	                layout: 'vertical',
	                align: 'right',
	                verticalAlign: 'top',
	                x: -10,
	                y: 100,
	                borderWidth: 0
	            },
	             plotOptions: {
	                column: {
	                    stacking: 'normal',
	                    dataLabels: {
	                        enabled: true,

	                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
	                    }
	                }
	            },
	            series: []
	        };
	        
	        $.getJSON("highCharts/column_cant_ventas_localidad.php", function(json){

				options.xAxis.categories = json[0]['data'];

					
					var longitud = json.length-1;

		        	for(var i=0; i < longitud; i++){

		        		options.series[i] = json[i+1];

		        	}
	        	
		        chart = new Highcharts.Chart(options);
	        });


	        $ ("#boton").click(function() {
		
			
			var url= "highCharts/column_cant_ventas_localidad.php";
			$.ajax ({
				type: 'POST',
				url: url,
				dataType: 'json',
				data: $("#formulario").serialize(),
				success: function(json)
				{
					

					options.xAxis.categories = json[0]['data'];

					var longitud = json.length-1;
					
		        	for(var i=0; i < longitud ; i++){

		        		options.series[i] = json[i+1];

		        	}
			        chart = new Highcharts.Chart(options);
				}
			});
		}); 


	      $ ("#botonCant").click(function() {
			
			var url= "highCharts/column_cant_ventas_localidad.php";
			$.ajax ({
				type: 'POST',
				url: url,
				dataType: 'json',
				data: $("#formulario").serialize(),
				success: function(json)
				{
					options.xAxis.categories = json[0]['data'];

					var longitud = json.length-1;
					
		        	for(var i=0; i < longitud ; i++){

		        		options.series[i] = json[i+1];

		        	}
			        chart = new Highcharts.Chart(options);
				}
			});
		});

	});