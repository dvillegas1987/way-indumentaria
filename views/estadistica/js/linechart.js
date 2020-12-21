 $(document).ready(function() {

        	 Highcharts.setOptions({
				  lang: {
				       decimalPoint: ',',
				       thousandsSep: '.'
				  }
			 })

            var options = {
                chart: {
                    renderTo: 'container2',
                    type: 'line',
                    marginRight: 130,
                    marginBottom: 50
                },
                title: {
                    text: 'Ventas',
                    x: -20 //center
                },
                 
                /*subtitle: {
                    //text: '',
                    x: -20
                },*/
                xAxis: {
                    categories: []
                },
                plotOptions: {
           		 series: {
                connectNulls: true
		            }
		        },

                yAxis: {
				       title: {
				            text: 'Ventas por vendedor [ $ ]'
				       },
				       plotLines: [{
				              value: 0,

				              width: 1,
				              color: '#808080'
				       }], 

				       labels: {
				            format: '{value:,1f}'
				       },
				       min:0
				 },
				 tooltip: {
				       pointFormat: "Ventas: $ {point.y:,.2f}"
				 },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    x: -10,
                    y: 100,
                    borderWidth: 0
                },
                series: []
            }
            
           $.getJSON("highCharts/line.php", function(json) {
            	
                options.xAxis.categories = json[0]['data'];

                var longitud = json.length-1;
	        	for(var i=0; i < longitud; i++){

	        		options.series[i] = json[i+1];

	        	}
		        chart = new Highcharts.Chart(options);
            });

           $ ("#boton7").click(function() {
			
				var url= "highCharts/line.php";
				$.ajax ({
					type: 'POST',
					url: url,
					dataType: 'json',
					data: $("#formulario").serialize(),
					success: function(json)
					{
						options.xAxis.categories = json[0]['data'];

						var longitud = json.length-1;
			        	for(var i=0; i < longitud; i++){

			        		options.series[i] = json[i+1];

			        	}
				        chart = new Highcharts.Chart(options);
					}
				});
			}); 

         /*  $ ("#boton").click(function() {
			
				var url= "highCharts/line.php";
				$.ajax ({
					type: 'POST',
					url: url,
					dataType: 'json',
					data: $("#formulario").serialize(),
					success: function(json)
					{
						options.xAxis.categories = json[0]['data'];

						var longitud = json.length-1;
			        	for(var i=0; i < longitud; i++){

			        		options.series[i] = json[i+1];

			        	}
				        chart = new Highcharts.Chart(options);
					}
				});
			}); */
        });




