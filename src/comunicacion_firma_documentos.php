<?php 

$nombre_hotel=$_GET['nombre_hotel'];
$nombre_departamento=$_GET['nombre_departamento'];
$nombre_trabajador=$_GET['nombre_trabajador'];
$apellido1_trabajador= $_GET['apellido1_trabajador'];
$nombre_carpeta=$_GET['nombre_carpeta'];





?>

<html>
<head>



</head>
<body  style="padding: 200px; text-align:center;">
<table  style="border-collapse: collapse;"   width="100%"> 

        <tr>
            <td width="300" >
                <p>
                    <img width="200"  src="https://presentacion.bqhoteles.com/wp-content/uploads/2021/11/LOGO_BQ-2.png"/>
					
                    
					
                </p>
            </td>
            <td  >
                <p align="center">
                 <font size=12>  <strong> DOCUMENTOS DE PRL Y MANUALES PARA EL TRABAJADOR <?php echo $nombre_trabajador.' '.$apellido1_trabajador ?></strong></font>
                </p>
            </td>
            
            
        </tr>
      
       
      
    
</table>   







<table style="border-collapse: collapse; text-align: justify; margin-left: 4.8pt; margin-right: 4.8pt; margin-bottom:100px;" width="80%">
<tbody>


		<?php
		
		 if(!empty($nombre_trabajador)){
			 
			 
			 echo "<tr>
								<td>
								<p><strong><font size=5>NOMBRE:</font> </strong>
								</td>
								<td style='border-bottom: 1px dotted;'>
								<font size=5>$nombre_trabajador</font></p>
								</td>
					</tr>";
 		 
		 }
		 
		 if(!empty($apellido1_trabajador)){
			 
			 
			 echo "<tr>
								<td>
								<p><strong><font size=5>PRIMER APELLIDO:</font> </strong>
								</td>
								<td style='border-bottom: 1px dotted;'>
								<font size=5>$apellido1_trabajador</font></p>
								</td>
					</tr>";
 		 
		 }
		 
		 if(!empty($nombre_carpeta)){
			 
			 
			 echo "<tr>
								<td>
								<p><strong><font size=5>ENLACE CARPETA:</font> </strong>
								</td>
								<td style='border-bottom: 1px dotted;'>
								<font size=5>$nombre_carpeta</font></p>
								</td>
					</tr>";
 		 
		 }
		 
		 
		
		 
		 
		 
		 
		
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		?>

















</tbody>
</table>




<?php
										$contratos="SELECT contratos_finiquitados.id_contrato,hotel.nombre_hotel,contratos_finiquitados.festivos_resto,contratos_finiquitados.vacaciones_resto,contratos_finiquitados.inicio_contrato_trabajador FROM contratos_finiquitados INNER JOIN hotel ON contratos_finiquitados.id_hotel=hotel.id_hotel WHERE contratos_finiquitados.id_trabajador=$id_trabajador AND hotel.nombre_sociedad='$nombre_sociedad' ";										
										$resultado_contratos = mysqli_query($link, $contratos);
										
										 if (mysqli_num_rows($resultado_contratos) > 0) {
											while ($_GET = mysqli_fetch_assoc($resultado_contratos )) {
												
													$id_contrato=$_GET['id_contrato'];
													$nombre_hotel=$_GET['nombre_hotel'];
													$festivos_resto=$_GET['festivos_resto'];
													$vacaciones_resto=$_GET['vacaciones_resto'];
													$inicio_contrato_trabajador=$_GET['inicio_contrato_trabajador'];
													$inicio_contrato_trabajador= date("d-m-Y",strtotime($inicio_contrato_trabajador));
												
												
												echo "
												<table style='border-collapse: collapse; text-align: justify; margin-left: 4.8pt; margin-right: 4.8pt; margin-bottom:50px; border:1px solid black;' width='80%'>
<tbody>


<tr>
								<td>
								<p><font size=5>NOMBRE HOTEL:</font>
								</td>
								<td style='border-bottom: 1px dotted;'>
								<font size=5>$nombre_hotel</font></p>
								</td>
</tr>



<tr >
								<td >
								<p><font size=5> FECHA INICIO CONTRATO :  </font>
								</td>
								<td style='border-bottom: 1px dotted;'>
								<font size=5>$inicio_contrato_trabajador</font></p>
								</td>
								
</tr>




<tr>
								<td>
								<p><font size=5>DIAS DE VACACIONES PENDIENTES DE PAGAR :</font>
								</td>
								<td style='border-bottom: 1px dotted;'>
								<font size=5> $vacaciones_resto</font></p>
								</td>

</tr>

<tr>
								<td>
								<p><font size=5>DIAS FESTIVOS PENDIENTES DE PAGAR:</font>
								</td>
								<td style='border-bottom: 1px dotted;'>
								<font size=5>$festivos_resto</font> </p>
								</td>
				
</tr>

</tbody>
</table>	
													";
												
												
										
										} //  FINAL WHILE RESULTADO CONTRATOS
										 } // FINAL IF RESULTADO CONTRATOS
										
										?>














<!--    TABLA POR HOTELES -->





</body>

</html>

