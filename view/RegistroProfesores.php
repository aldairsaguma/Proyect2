<?php 

    session_start();
    if($_SESSION["id"]==0){
        header("location:index.html");
    }else{
        header("Expires: Tue, 01 Jul 2001 06:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");

    }

    ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title></title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	 <script src="../js/validar.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="../js/chkvalidar.js"></script>
	<script src="../js/desabilita_div_horarios.js"></script>
	

	
	<link rel="stylesheet" type="text/css" href="../js/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="../js/css/themes/default.css">

	
	<script src="../js/alertify.js"></script>
		

	<script>
		$(document).ready(function(){


		let cuenta=0;
		let cuentar=0;

			$('#doc').on('change', function(){
 			var val = $(this).val();
  			var name = $('#doc option:selected').text();
  			if($(this).val()==""){
  				$("#kevin").html(null);
  				//$("#turnos_mostrar").html(null);
  			}else{

  				$("#kevin").html(name);
  				//$("#turnos_mostrar").html(name);
  				
  			}

  		});

			$('#doc').on('change',function(){
			var val = $(this).text();
			//alert(val);
  			var name = $('#turnos_mostrar').text();
  			if($(this).val()==""){
  				$("#turnos_mostrar").html(null);
  				//$("#turnos_mostrar").html(null);
  			}else{

  				$("#turnos_mostrar").html(name);
  				//$("#turnos_mostrar").html(name);
  				
  			}
  			  $('#tipo-id').removeAttr('disabled');
			});

		$(document).on('submit','#form-1',function(e){
			e.preventDefault();
			$.ajax({
				method: 'POST',
				data: $('#form-1').serialize(),
				url: '../ajax/registro_profe.php',
				success:function(resp){
					$("#alerta-id").html(resp);
				}
			});			
		});

		// $(document).on('click','#boton-ver',function(){
		// 	let dniboton=$(this).data('dni');

		// 	// definimos la anchura y altura de la ventana
		// var altura=350;
		// var anchura=600;
		
		// // calculamos la posicion x e y para centrar la ventana
		// var y=parseInt((window.screen.height/2)-(altura/2));
		// var x=parseInt((window.screen.width/2)-(anchura/2));
		


		 //window.open('../ajax/turnos_registrados.php?codigo='+dniboton, target='blank','width='+anchura+',height='+altura+',top='+y+',left='+x+',toolbar=no,location=no,status=no,menubar=no,scrollbars=no,directories=no,resizable=no');
		// });

		function modal(){
			//let dniboton=$(this).data('dni');
			let tipoexa=$("#tipo-id").val();
			let id=$("#doc").val();
			//alert (tipoexa);
			if(id!='' && tipoexa!='' ){

				$.ajax({

					type: 'post',
					url: '../ajax/turnos_registrados.php',
					data: {id:id,tipoexa:tipoexa},
					success :function(resp){
						$("#respuesta-modal").html(resp);
						$("#asist-id").modal('show');
					},
					error: function(respuesta){
						console.log("error",respuesta);
					}



				});

			}else{

				alert("DEBE SELECCIONAR EL TURNO Y EL TIPO DE EXAMEN");
				
			}
		}

		 $(document).on('click','#boton-ver',function(){
		// 	let dniboton=$(this).data('dni');
		// 	let tipoexa=$("#tipo-id").val();
		// 	alert(tipoexa);
		// 	alert (dniboton);
		// 	window.open('../ajax/turnos_registrados.php?codigo='+dniboton,'640x480','toolbar=no,status=no,scrollbars=no,location=no,menubar=no,directories=no,width=640,height=290');
		// 	window.open('../ajax/turnos_registrados.php?codigo='+dniboton,'640x480','toolbar=no,status=no,scrollbars=no,location=no,menubar=no,directories=no,width=700,height=290,scroll=no,location=no,resizable=no,titlebar=no');
			modal();
		 });

		// 	$("##boton-ver").click(function(e){
		// 	//valordnitotal=[];
		// 	e.preventDefault();
		// 	modal();
		// });


		function getturnos(){

			for(let i = 1; i<6; i++){
				for (let j = 8; j<17; j+=2) {
				$("#"+i+j).prop("checked",false);
				$("#"+i+j).prop("disabled",true);
			}
			
		}
		cuentar=0;
			let doc=$("#doc").val();
			let tipo=$("#tipo-id").val();
			//regresar horario cuando no seleccionen profesor
			if(doc==''){
				$.ajax({
					type:'GET',
					url:"../ajax/horario.php",
					success:function(data) {
						$('#tabla-id').html(data);
					}
				})
			}

			if(doc!='' && tipo!=''){
				
				$.ajax({
					type:'POST',
					url:'../ajax/verificar_registro.php',
					data:{id:doc,tipo:tipo},
					success:function(data){
						if(data!=100){
							$('#tabla-id').html(data);
						}
						
					}
				});


				$.ajax({
				type:'post',
				url:'../ajax/turnos.php',
				data:{dni:doc,tipo:tipo},
				success:function(res){
					$('#turnos-id').val(res);
					cuenta=res;
					if(cuenta==0){
						//alert('certo');
						for(let i = 1; i<6; i++){
							for (let j = 8; j<17; j+=2) {
								$("#"+i+j).prop("disabled",true);
							}
						}
					}else{
						for(let i = 1; i<6; i++){
							for (let j = 8; j<17; j+=2) {
								$("#"+i+j).prop("disabled",false);
							}
						}
					}}
				});
			}else{
				$('#turnos-id').val('');
			}
		}

		$(document).on("change","#doc",function(){
			getturnos();


		});
		$(document).on("change","#tipo-id",function(){
			getturnos();
			// let doc=$("#doc").val();
			// let tipo=$("#tipo-id").val();
			// if(doc!='' && tipo!=''){
				
			// 	$.ajax({
			// 		type:'POST',
			// 		url:'../ajax/verificar_registro.php',
			// 		data:{id:doc,tipo:tipo},
			// 		success:function(data){
			// 			if(data!=100){
			// 				$('#tabla-id').html(data);
			// 			}
						
			// 		}
			// 	});
			// }
		});

		// $(document).on("change"),"tipo_examen"
		for(let i = 1; i<6; i++){
			for (let j = 8; j<17;j+=2){
		    $(document).on("click","#"+i+j,function(){
		    	valid();
		        if($("#"+i+j).prop('checked')==true){
		        	cuentar++;
		        }else{
		        	cuentar--;
		        }
		        if(cuenta==cuentar){
		        	console.log('iguales');
		        	for(let i = 1; i<6; i++){
							for (let j = 8; j<17; j+=2){
		        		if($("#"+i+j).prop('checked')==false){
		        			//console.log(i);
		        			$( "#"+i+j ).prop( "disabled", true );
		        			$( "#btn-submit").prop( "disabled", false );
		        		}else{
		        			$( "#"+i+j ).prop( "disabled", false );
		     
		        		}
		        	}
		        	}
		        }else{
		        	$( "#btn-submit").prop( "disabled", true );
		        }
		    })
		}
	}

	
		

	
});
 //    '#tabla{'+
    			// 'font-size: 25px;'+
    			// 'padding: 20px;'+
    			// 'color: black;'+
    			// 'width:100%;'+
    			// '}'+
function Imprimir(){
	DivToPrint=document.getElementById('tabla');
	//alert(DivToPrint);
	HtmlToPrint=''+
	 '<style>' + 
	 '@media print{'+
  '#tabla{'+
    'font-size: 25px;'+
    'padding: 20px;'+
    'color: black;'+
    'width: 100%;'+
    'margin:0 auto'+
    'border:none'+
  '}'+

  '#cabecera{'+
    'font-weight: bolder;'+
    'color: black;'+
  '}'+

  'table thead th{'+  
    'color: #212529;'+
   'font-size: 30px;'+
  '}'+

  'input[type="checkbox"]{'+
    'width: 30px;'+
    'height: 30px;'+
    'float: left;'+
    'margin: 0 auto;'+
    'width: 100%;'+
	'}'+

  '#titulo{'+
   'font-size: 40px;'+
  '}'+
'}'+
	'</style>';
	 		HtmlToPrint += DivToPrint.outerHTML;
		    newWin = window.open("");
		    // newWin.document.write("<h2 style='color:black;margin-top: 20px;font-size:44px;text-align:center;'>Horario Profesor</h2>");
		    newWin.document.write(HtmlToPrint);
		    newWin.print();
		    newWin.close();
}


function logout(){
			
			

			alertify.confirm("Salir del Sistema","¿Esta Seguro que desea Salir?",
		  function(){
					alertify.success('Ok');
				location.assign('../model/logout.php')
			},
			function(){
			alertify.error('Cancel');
			
			  });
				
			}

	</script>



</head>

<body>
<form id="noform"></form>
<?php

require_once("../model/conexion.php");
require_once("../model/mostrar_profesores.php");

$con=new Conexion();
$cn=$con->Conexion();
	

?>


	
	<nav class="navbar navbar-expand-lg  navbar-dark bg-dark sticky-top ">

		<a class="navbar-brand" href="administrador.php">
			<img src="../img/logo.png" width="40" height="40" class="d-inline-block align-top float-left" alt="">
			<span class="navbar-brand text-muted">OERAAE</span>
			<div id="alerta-id"></div>
		</a>



		<button class="navbar-toggler navbar-toggler-right" data-toggle="collapse" data-target="#navbarTogglerDemo01" type="button">

			<span class="navbar-toggler-icon"></span>


		</button>

		<div class="collapse navbar-collapse text-center" id="navbarTogglerDemo01">

			<div class="navbar-nav">
				<?php if ($_SESSION['rol']==1){?>
				<a href="Sorteo2.php" class="nav-item nav-link  ">Registro de Supervision</a>
				<?php }?>
				<a href="RegistroProfesores.php " class="nav-item nav-link ">Registro de Profesores</a>

				
				<span onclick="logout();" href="../model/logout.php" class="nav-item nav-link">Cerrar Sesion</span>

			</div>

		</div>

	</nav>

	<div class="container">
		<h2 class="h2 mt-3 text-center text-danger">NOTA : NO SE PUEDE SELECCIONAR 2 TURNOS CONSECUTIVOS</h2>



		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">DATOS</h5>

				</div>

				<div class="modal-body ">
				
<form class="was-validated" id='form-1' method="post" action="">
					<div class="form-group">
						<input type="text"  name="id"  hidden="" value="<?php echo $_SESSION["id"]; ?>">
					<label for="">DOCENTES</label>
					<select id="doc" class="custom-select" required disabled="true" name="nombre_profesores">



					<option value="">Abrir para ver todos los docentes</option>

				<?php
				$obj=new Nombre_profesores();
				$sql="SELECT * FROM docentes 
INNER JOIN supervision_docente ON docentes.DNI=supervision_docente.DNI WHERE supervision_docente.DNI= ".$_SESSION['id']." ";

				$datos=$obj->mostrardatos($sql);
				foreach ($datos as $key) {
				  
				?>
					<option value=<?php  echo $key['DNI'];?>>
				<?php 
				echo $key['APELLIDO_PATERNO'];
				echo $key['APELLIDO_MATERNO'];
				echo  ", ". $key['NOMBRE'];
				 ?>
				</option>			
					<?php
					}	  
				?>

					</select>

					<div class="invalid-feedback">Elige uno de las opciones</div>
				</div>


						<div class="form-group">
							<label for="">TIPO DE EXAMEN</label>
							<select  class="custom-select" required id="tipo-id" name="tipo_examen" disabled="true">
								<option value="">Abrir para ver los tipo de examenes</option>
						<?php 
						// $sql="SELECT DISTINCT supervision_docente.id_sup_doc,registro_docentes.tipoexamen FROM registro_docentes INNER JOIN supervision_docente on registro_docentes.id_sup_doc=supervision_docente.id_sup_doc where supervision_docente.DNI=".$_SESSION['id']."";
						// 		$registro=mysqli_query($cn,$sql);
						// 		$FINAL='FINAL';
						// 			$PARCIAL='PARCIAL';
						// 			$SUSTI='SUSTI';
						// 		while($row=$registro->fetch_row()){
									
						// 			if($row[1]==$FINAL){
						// 				$disabled="disabled";
						// 			}else{
						// 			$disabled="";
						// 			}
						// 			if($row[1]==$PARCIAL){
						// 				$disabled="disabled";
						// 			}else{
						// 			$disabled="";
						// 			}
						// 			if($row[1]==$SUSTI){
						// 			$disabled="";
						// 			}else{
						// 			$disabled="";
						// 			}
						// 		}
								
								?>
								<option value="FINAL">FINALES</option>

								<option value="PARCIAL">PARCIALES</option>
								<option value="SUSTITURIO">SUSTITUTORIOS</option>

								
							</select>
							<div class="invalid-feedback">Elegir un tipo de examen </div>
						</div>

						<div class="row col-12 d-flex justify-content-between ">
							<div class="custom-control custom-checkbox mb-3 ">
								<input type="checkbox" class="custom-control-input " id="habilitar" required form="noform">
								<label class="custom-control-label" for="habilitar">HABILITAR LISTA DE DOCENTE</label>


								<div class="invalid-feedback col-5">Habilitar para ver la lista de docentes</div>


							</div>
							<div class="col-2-md ml-3">
								<label class="text-center-sm ml-4" for="">TOTAL DE TURNOS:</label>
								<input  name="N_turnos" readonly="true" type="text"  value="" class="form-control" id='turnos-id' style="background: lightgray;" required>
							</div>

						</div>


				</div>

	
			</div>
		</div>


		<div class="modal-dialog modal-lg" role="document" id="div-horarios">
			<div class="modal-content">
				<div class="modal-header">

					<h2 class="text-center text-muted ">HORARIO</h2>

					<hr>
					<h5 id="kevin"> </h5>


				</div>

				<div class="modal-body">
					<div class="table-responsive-lg" id="tabla-id">
				<?php 
				include "../ajax/horario.php";
				 ?>
					</div>
				</div>
			</div>
		</div>

		<div class="form-group d-flex justify-content-center m-2">
			<input type="submit" class="btn btn-success m-2" value="GUARDAR" id="btn-submit" disabled="true" name="btnenviar">
			<a href='../post/imprimir.php' target="blank"><button class="btn btn-success m-2" form="###">REPORTES</button></a>
		</div>
	</div>
</form>






<div class="modal fade" id="asist-id" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    	
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
		</div>

		<div class="modal-body">
				
				<div class="form-group row m-0" id="respuesta-modal" id="DivtoImprimir">
					<!-- aqui se scribe la lista por ajax-->
				</div>
				<div class="form-group d-flex justify-content-center m-2">
						<!-- <button value="IMPRIMIR" id="hola2" type="submit" class="btn btn-outline-success"  data-target=".asistenciaDocentes">IMPRIMIR</button>
 -->
				<input id="btnimprimir" type="button" class='btn btn-outline-success' style='width:40%;font-size:20px;' media="print" name="imprimir" value="Imprimir" onclick="Imprimir();">
				</div>
			
		</div>
		</div>
	</div>		
</div>

</body>

</html>

