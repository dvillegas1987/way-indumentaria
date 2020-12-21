

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
	                    text: 'Importe de Ventas [ $ ]'
	                },
	                plotLines: [{
	                    value: 0,
	                    width: 1,
	                    color: '#808080'
	                }]
	            },
	            tooltip: {
	            	
	            	//pointFormat: '{series.name}: <b>{point.percentage: .2f} %</b>',
	            	pointFormat: "{series.name} <br/> <b> Ventas: $ {point.y:,.2f}</b>"
	                
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
	                    
	                }
	            },
	            series: []
	        }

	        $ ("#boton").click(function() {
		
				var url= "highCharts/data4.php";
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

	      $ ("#botonImp").click(function() {
			
				var url= "highCharts/dataLoc_imp.php";
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