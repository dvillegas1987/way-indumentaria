//Una vez que cargue el documento se cargara la funcion
	$(document).ready(function() {
		
		Highcharts.setOptions({
			lang: {
				decimalPoint: ',',
				thousandsSep: '.'
			}
		});
		var options = {
			chart: {
	            renderTo: 'container',
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
	           name: 'Ventas por Localidad',
	           data: []
	       }]
	    }
	    // Aqui la seccion del archivo del cual obtendremos los datos
	   $.getJSON("highCharts/pie_ventas_localidad.php", function(json) {
			options.series[0].data = json;
	        chart = new Highcharts.Chart(options);
	    });
	        
	     
		
		$ ("#boton").click(function() {
		
			var name = $("#comboVend").val();
			var url= "highCharts/pie_ventas_localidad.php";
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

		$("#comboVend").on("change", function(){
				
				var name = $("#comboVend").val();
				var url= "highCharts/pie_ventas_localidad.php";
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
		
		/*$ ("#boton2").click(function() {
		
			var url= "highCharts/data1_Actual.php";
			$.ajax ({
				type: 'POST',
				url: url,
				dataType: 'json',
				data: $("#formulario").serialize(),
				success: function(json)
				{
					options.series[0].data= json;
					chart = new Highcharts.Chart(options);
				}
			});
		}); */
		 
		
		
	        
      	}); 