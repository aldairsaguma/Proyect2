	<thead class="thead-dark">
	<tr>
		<th>N°</th>
		<th>Profesores</th>
		<th>N° faltas</th>
		<th>Día</th>
	</tr>
	</thead>
<tbody>
	
	<?php
	include '../model/conexion.php';

	$conexion=new Conexion();
	$cn=$conexion->Conexion();
	$ina=$_POST['ina'];
	// $lunes="Lunes ";
	// $Martes="Martes ";
	// $Miercoles="Miercoles ";
	// $Jueves="Jueves ";
	// $Viernes="Viernes ";
	if ($ina=='1' or $ina=='2' or $ina=='3' or $ina=='4' or $ina=='5'){

	$sql="SELECT DISTINCT concat(docentes.APELLIDO_PATERNO,' ' ,docentes.APELLIDO_MATERNO,', ',docentes.NOMBRE) as 	Nombres,
	COUNT(registro_docentes.id_sup_doc)-SUM(registro_docentes.asistencia) as N_faltas,GROUP_CONCAT( turnos.dia,' ', 	turnos.hora) as d_falta
	from docentes 
	INNER JOIN supervision_docente on docentes.DNI=supervision_docente.DNI
	INNER JOIN  registro_docentes on supervision_docente.id_sup_doc=registro_docentes.id_sup_doc 
	INNER JOIN turnos on registro_docentes.id_turno=turnos.id_turno
	WHERE registro_docentes.id_turno like '".$ina."%' and (SELECT  COUNT(registro_docentes.id_sup_doc)-SUM(registro_docentes.asistencia) from docentes)>0
	GROUP BY registro_docentes.id_sup_doc
	ORDER BY docentes.APELLIDO_PATERNO,turnos.dia
	";

	$rs=mysqli_query($cn,$sql);
	$contar=$rs->num_rows;
	$contador=1;
	if ($contar>0) {
		while ($row=$rs->fetch_row()) {
		
			echo "<tr>
				<td>".$contador++."</td>
				<td>".$row[0]."</td>
				<td>".$row[1]."</td>
				<td>".$row[2]."</td>
		</tr>";
		
	}
	
	}else{
			echo "<tr>
				<td colspan='4' style='text-align:center;'>No hay datos</td>
				</tr>";
		}
}else if ($ina=="todo") {
	$sql="SELECT DISTINCT concat(docentes.APELLIDO_PATERNO,' ' ,docentes.APELLIDO_MATERNO,', ',docentes.NOMBRE) as 	Nombres,
	COUNT(registro_docentes.id_sup_doc)-SUM(registro_docentes.asistencia) as N_faltas,GROUP_CONCAT( turnos.dia,' ', 	turnos.hora) as d_falta
	from docentes 
	INNER JOIN supervision_docente on docentes.DNI=supervision_docente.DNI
	INNER JOIN  registro_docentes on supervision_docente.id_sup_doc=registro_docentes.id_sup_doc 
	INNER JOIN turnos on registro_docentes.id_turno=turnos.id_turno
	WHERE  (SELECT  COUNT(registro_docentes.id_sup_doc)-SUM(registro_docentes.asistencia) from docentes)>0
	GROUP BY registro_docentes.id_sup_doc
	ORDER BY docentes.APELLIDO_PATERNO,turnos.dia
	";

	$rs=mysqli_query($cn,$sql);
	$contador=1;
	while ($row=$rs->fetch_row()) {
		
			echo "<tr>
				<td>".$contador++."</td>
				<td>".$row[0]."</td>
				<td>".$row[1]."</td>
				<td>".$row[2]."</td>
		</tr>";
		
	}
}
	?>
	</tbody>
