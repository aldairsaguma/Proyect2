<!DOCTYPE html>
<html>
<head>
	<title>Inasistencia</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	 <script src="../js/validar.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script>
		
		$(document).ready(function(){
			$("#cbo-ina").on('change',function(){
			var ina=$('#cbo-ina option:selected').val();
			var boton=document.getElementById('boton');
			//alert (boton);
			//alert(ina);
			if(ina!=''){
				$.ajax({
					type:'post',
					url:'../ajax/dato-inasis.php',
					data:{ina:ina},
					success:function(rpta){
						$("#contenedor").html(rpta);
					},error:function(res){
						console.log("error",res);
					}
				});
				boton.disabled=false;
			}
			if (ina=='[Seleccione día]') {
				boton.disabled=true;
			}

			});

		});
		function Imprimir(){
			var divToPrint = document.getElementById('contenedor');
    		var htmlToPrint = '' +
		        '<style>' + 

		         '#contenedor{'+
		        // 'border:solid red 1px;'+
		        'width:100%;'+
		        'margin: 0 auto;'+
		        '}'+

		        'th{'+
		       	'font-size:24px;'+
		       	'font-family: sans-serif'+ 	
		       	 
		        '}'+

		        'td{'+
		        'font-family:serif'+
		        'font-size:16px'+
		        'text-align:center'+

		        '}'+

		         'table tr,td{'+ 
		      	 'padding: 10px;'+
		      	  // 'border:solid black 1px;'+
		      	  'text-align:center'+
		      	  'margin: 0 auto;'+
		        '}'+

		        '</style>';
		    htmlToPrint += divToPrint.outerHTML;
		    newWin = window.open("");
		    newWin.document.write("<h2 style='color:black;margin-top: 20px;font-size:44px;text-align:center;'>Profesores Inasistentes</h2>");
		    newWin.document.write(htmlToPrint);
		    newWin.print();
		    newWin.close();

		}
	</script>
	<style>
		@media print{
			@page { margin: 0; }
  			@page {size: landscape}
 
		}
	</style>
</head>
<body>
<div style="width: 90%; margin: auto;" >
	<div>
	<h2 class="h2 text-center text-danger" style="margin-top: 20px; font-size: 44px;">Profesores Inasistentes </h2>
	<br>
	<div style="margin: 0 auto; width: 200px;">
	<!-- <h3>Seleccione día</h3> -->
	<select class="custom-select" style="text-align: center;" id="cbo-ina">
	<option>[Seleccione día]</option>
	<option value="1">Lunes</option>
	<option value="2">Martes</option>
	<option value="3">Miercoles</option>
	<option value="4">Jueves</option>
	<option value="5">Viernes</option>
	<option value="todo">Reporte Semanal</option>
	</select>
	</div>
	<br>
</div>
<div >
	<table class="table table-hover " id="contenedor" border="1" style="text-align: center;margin: 0 auto;">
	</table>
</div>
<div style="width: 170px; margin: 0 auto;">
	<a href=''><button id="boton" class="btn btn-success m-2" disabled="true;" style="width: 150px;" 
	onclick='Imprimir();' media="print">IMPRIMIR</button></a>
</div>
</div>
</body>
</html>