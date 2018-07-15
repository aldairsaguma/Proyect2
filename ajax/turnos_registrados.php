<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<head>
  <link rel="stylesheet" type="text/css" href="../css/css-turno-registrados.css">
</head>
<?php
 // $tipo=$_GET['tipoexa'];
 // var_dump($tipo);

$id=$_POST['id'];
$tipo=$_POST['tipoexa'];
if($id!="" && $tipo!=''){


require_once("../model/conexion.php");
$conexion=new conexion();
$cn=$conexion->conexion();

$sql="SELECT * FROM turnos";
$result=mysqli_query($cn,$sql);


/*Turnos de la sesion*/
$sql2="SELECT turnos.id_turno FROM turnos
INNER JOIN registro_docentes on turnos.id_turno=registro_docentes.id_turno 
INNER JOIN supervision_docente on supervision_docente.id_sup_doc=registro_docentes.id_sup_doc where supervision_docente.DNI=".$id." AND registro_docentes.tipoexamen='$tipo'";
$result2=mysqli_query($cn,$sql2);

$array=array();
//Todos los turnos


while ($rowturno=$result->fetch_row()){
	$checkbox="disabled='true'";
	$bg=" style='; 
  '";
	//$bg2=" style='background:blue;'";
	$array += [$rowturno[0]=> ['checkbox'=>$checkbox, 'bg'=>$bg]];

	while ($rowinner=$result2->fetch_row()) {
		$array[$rowinner[0]]['checkbox']="checked='true' disabled='true'";
		$array[$rowinner[0]]['bg']= "style=''";
	}
}
//print_r($array);

	

?>



<!-- <script>
    function imprimir(){
      if(window.print) window.print()
        else alert("Puede utilizar Ctrl+P");
    }

  </script> -->
  <?php
  //obtener url completa
// $enlace_actual = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
// var_dump($enlace_actual);
  ?>
  <!-- <script>
function imprSelec(muestra)
{
  var ficha=document.getElementById(muestra);
  var ventimp=window.open("../ajax/turnos_registrados.php" + "<?php  echo "?codigo=$id" ?>");
   ventimp.print();
   window.close();
}

</script>
<style>
  @media print {
  @page { margin: 0; }
  @page {size: landscape}
  body {  
  float:none;
  width:auto;
  margin:0;
  padding: 0;
  margin-top: 20%;
  background:black;
  }
  #btnimprimir{
  display: none;
  }
  #tabla{
    font-size: 25px;
    padding: 20px;
    color: black;
    width: 96%;
    border: inset black 2px;
  }
  #cabecera{
    font-weight: bolder;
    color: black;
  }
  table thead th{  
    color: #212529;
   font-size: 30px;
  }
  input[type='checkbox'] {
    width: 30px;
    height: 30px;
    float: left;
    margin: 0 auto;
    width: 100%;

  }
  #titulo{
   font-size: 40px;
  }
}
</style> -->
 <div id="muestra">
   <table class="table text-center" id="tabla" border="1"  style="width: 770px;margin: 0 auto;">
 
   <!--  <iframe src="horario.php"></iframe> -->
              <thead class="thead-dark" id="cabecera">
                <tr id="titulo_horario">
                  <th colspan="6"  class="h2" id="titulo" >HORARIO <?php echo $tipo; ?></th>
                </tr>
                <tr>
                  <th scope="col">HORA/DÍA</th>
                  <th scope="col">LUNES</th>
                  <th scope="col">MARTES</th>
                  <th scope="col">MIERCOLES</th>
                  <th scope="col">JUEVES</th>
                  <th scope="col">VIERNES</th>
                </tr>

              </thead>

              <tbody>
                <tr>
                  <th scope="row">08:00 am-10:00 am</th>
                  <td <?php echo $array[18]['bg'];?>>
                    <div class="form-check" >
                      <input type="checkbox" <?php echo $array[18]['checkbox'];?>    value="18" name="chk[]" id="18" >

                    </div>
                  </td>
                  <td <?php echo $array[28]['bg'];?>>
                    <div class="form-check"  >
                      <input type="checkbox" <?php echo $array[28]['checkbox'];?>    value="28"  name="chk[]"  id="28" >

                    </div>
                  </td>
                  <td <?php echo $array[38]['bg'];?>>
                    <div class="form-check"  >
                      <input type="checkbox" <?php echo $array[38]['checkbox'];?>    value="38" name="chk[]" id="38">

                    </div>
                  </td>
                  <td <?php echo $array[48]['bg'];?>>
                    <div class="form-check"  >
                      <input type="checkbox" <?php echo $array[48]['checkbox'];?>     value="48" name="chk[]" id="48">

                    </div>
                  </td>
                  <td <?php echo $array[58]['bg'];?>>
                    <div class="form-check"  >
                        <input type="checkbox" <?php echo $array[58]['checkbox'];?>   value="58"  name="chk[]" id="58">

                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">10:00 am-12:00 pm</th>
                  <td  <?php echo $array[110]['bg'];?>>
                    <div class="form-check"  >
                      <input type="checkbox" <?php echo $array[110]['checkbox'];?>    value="110"  name="chk[]"  id="110" >

                    </div>
                  </td>
                  <td <?php echo $array[210]['bg'];?>>
                    <div class="form-check"  >
                      <input type="checkbox" <?php echo $array[210]['checkbox'];?>     value="210" name="chk[]"  id="210" >

                    </div>
                  </td>
                  <td <?php echo $array[310]['bg'];?>>
                    <div class="form-check"  >
                      <input type="checkbox" <?php echo $array[310]['checkbox'];?>    value="310"  name="chk[]" id="310" >

                    </div>
                  </td>
                  <td <?php echo $array[410]['bg'];?>>
                    <div class="form-check"  >
                      <input type="checkbox" <?php echo $array[410]['checkbox'];?>     value="410" name="chk[]" id="410" >

                    </div>
                  </td>
                  <td  <?php echo $array[510]['bg'];?> >
                    <div class="form-check"  >
                      <input type="checkbox" <?php echo $array[510]['checkbox'];?>     value="510" name="chk[]" id="510" >

                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">12:00 pm-14:00 pm</th>
                  <td <?php echo $array[112]['bg'];?>>
                    <div class="form-check"  >
                      <input type="checkbox" <?php echo $array[112]['checkbox'];?>     value="112" name="chk[]"  id="112" >

                    </div>
                  </td>
                  <td <?php echo $array[212]['bg'];?>>
                    <div class="form-check"  >
                      <input type="checkbox" <?php echo $array[212]['checkbox'];?>     value="212" name="chk[]"  id="212" >

                    </div>
                  </td>
                  <td <?php echo $array[312]['bg'];?>  >
                    <div class="form-check"  >
                      <input type="checkbox" <?php echo $array[312]['checkbox'];?>     value="312" name="chk[]" id="312" >

                    </div>
                  </td>
                  <td <?php echo $array[412]['bg'];?>>
                    <div class="form-check"  >
                      <input type="checkbox" <?php echo $array[412]['checkbox'];?>     value="412" name="chk[]" id="412" >

                    </div>
                  </td>
                  <td <?php echo $array[512]['bg'];?>>
                    <div class="form-check"  >
                      <input type="checkbox" <?php echo $array[512]['checkbox'];?>    value="512"  name="chk[]" id="512" >

                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">14:00 pm-16:00 pm</th>
                  <td <?php echo $array[114]['bg'];?>>
                    <div class="form-check"  >
                      <input type="checkbox" <?php echo $array[114]['checkbox'];?>     value="114" name="chk[]"  id="114" >

                    </div>
                  </td>
                  <td <?php echo $array[214]['bg'];?>>
                    <div class="form-check"  >
                      <input type="checkbox" <?php echo $array[214]['checkbox'];?>     value="214" name="chk[]"  id="214" >

                    </div>
                  </td>
                  <td <?php echo $array[314]['bg'];?>>
                    <div class="form-check"  >
                      <input type="checkbox" <?php echo $array[314]['checkbox'];?>    value="314"  name="chk[]" id="314" >

                    </div>
                  </td>
                  <td <?php echo $array[414]['bg'];?>>
                    <div class="form-check"  >
                      <input type="checkbox" <?php echo $array[414]['checkbox'];?>    value="414"  name="chk[]" id="414" >

                    </div>
                  </td>
                  <td  <?php echo $array[514]['bg'];?>>
                    <div class="form-check"  >
                      <input type="checkbox" <?php echo $array[514]['checkbox'];?>    value="514"  name="chk[]" id="514" >

                    </div>
                  </td>
                </tr>
                </tbody>
              </table>
 </div>

               			
<?php

}else{
	echo "No hay ningun profesor";
}


?>
<table style="margin: auto">
  <tr>
    <td></td>
  </tr>
<!--   <tr>
<td colspan='7' style="text-align: center; width: 20%"> -->
  <!-- <input type="button" class='btn btn-success' style='width:150px;font-size:20px;' name="imprimir" value="Imprimir" onClick="javascript:imprimir();"> -->

 <!--  <input id="btnimprimir" type="button" class='btn btn-success' style='width:40%;font-size:20px;' media="print" name="imprimir" value="Imprimir" onClick="javascript:imprSelec('muestra')"> -->

<!--   <a href="javascript:imprSelec('muestra')">Imprimir Tabla</a> -->
<!-- </td>
</tr> -->
</table>


  
