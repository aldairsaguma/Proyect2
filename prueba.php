<?php 
								require'model/conexion.php';
								$cn=new Conexion();
								$conec=$cn->Conexion();
								$sql="SELECT DISTINCT supervision_docente.id_sup_doc,registro_docentes.tipoexamen FROM registro_docentes INNER JOIN supervision_docente on registro_docentes.id_sup_doc=supervision_docente.id_sup_doc where supervision_docente.DNI='44052294'";
								$registro=mysqli_query($conec,$sql);
								$row=$registro->fetch_row();
								echo $row[0];
								echo $row[1];
								
								?>