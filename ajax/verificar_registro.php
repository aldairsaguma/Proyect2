
						<?php 
						require('../model/conexion.php');
							$id=$_POST['id'];
							$tipo=$_POST['tipo'];
							$cn=new Conexion();
							$conec=$cn->Conexion();
							$sql="SELECT registro FROM supervision_docente WHERE DNI=".$id."  ";
							$sql2="SELECT registro_docentes.tipoexamen from registro_docentes INNER JOIN supervision_docente on registro_docentes.id_sup_doc=supervision_docente.id_sup_doc where supervision_docente.DNI=".$id." AND registro_docentes.tipoexamen='$tipo' GROUP BY registro_docentes.tipoexamen";
							//var_dump($sql2);

							$registro=mysqli_query($conec,$sql);
							$registro2=mysqli_query($conec,$sql2);
							//echo "<br>";
							//var_dump($registro2);
							$filas=$registro2->num_rows;
							$row=$registro->fetch_row();
							$row2=$registro2->fetch_row();

									if($filas==0){
										echo 100;
									}elseif ($filas>=1) {
										echo "<h2 class='h2 mt-3 text-center text-danger' id='turnos_mostrar'>NOTA : Ya está registrado 
										<button class='btn btn-success' id='boton-ver' data-dni='$id' style='width: 120px; font-size:20px;'>Ver Turnos</button>
										</h2>";
									}

										
								
								//var_dump($registro);
						

						//include "../ajax/turnos_registrados.php"; ?>