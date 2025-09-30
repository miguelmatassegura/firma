
<html>
<head>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<style type="text/css">
 @font-face {
font-family: 'Frutiger';
src: url('https://firma.bqhoteles.com/Frutiger.ttf') format('ttf'),
url('https://firma.bqhoteles.com/Frutiger.ttf') format('ttf');
font-weight: normal;
font-style: normal;
}
body{
	font-family: Frutiger,Calibri;
}

</style>
<script>
	console.log("Este es un mensaje de prueba desde JavaScript");
	</script>
</head>
<body>

<img  src="logo.png">
<h1 style="text-align:center; color:#fbaa21;">GENERADOR DE FIRMAS BQ HOTELES</h1>

<h2>Intrucciones de como crear y insertar la nueva firma en Outlook. IMPORTANTE! LEER BIEN LAS INSTRUCCIONES Y <b>NO MODIFICAR LA FIRMA A MANO</b> AUNQUE PAREZCA QUE ESTA MAL EDITADA AL COPIAR, PARA PERSONAL QUE ESTE EN DOS HOTELES SE TENDRA QUE CREAR DOS FIRMAR DIFERENTES</h2>
<li>1. Rellenar los datos en el formulario para generar su firma corporativa, todo en minuscula. Para recepciones el nombre tiene que ser : RECEPCION  y no poner ni apellidos ni departamento ni movil.Los datos que no se rellenen no apareceran en la firma.</li>
<li>2. Una vez generada se tiene que seleccionar toda la firma que esta dentro del cuadro rojo y copiar</li>
<li>3. Abriremos nuestro programa Outlook y en la parte superior izquierda de Outlook seleccionaremos  donde pone "ARCHIVO"</br><a href="img1.png"><b>IMAGEN EJEMPLO</b></a>. 
<li>4.Se abrira una ventana nueva y seleccionaremos "OPCIONES"</br><a href="img2.png"><b>IMAGEN EJEMPLO</b></a></li>
<li>5. Se abrira una  nueva ventana y en ella podremos ver en la parte izquierda los apartados y  a la derecha sus opciones.</li>
<li>6. Nos dirigiremos al apartado de CORREO que encontraremos en la columna de la izquierda, una vez seleccionado, buscaremos el apartado REDACTAR MENSAJES y dento elegiremos "Crear o modique firmas para los mensajes" BOTON:FIRMAS</li></br><a href="img3.png"><b>IMAGEN EJEMPLO</b></a>
<li>7. Se abrira una ventana para poder crear y editar nuestra firma.</li>
<li>8. Crearemos una nueva firma con el nombre FIRMACORP.</li>
<li>9. En el cuadro de texto donde inferior pegaremos la firma que hemos copiado en el generador de firmas.</li>
<li>10. Una vez tengamos ya la firma creada, comprobaremos que la firma predeterminada para mensajes nuevos y respuestas tenemos seleccionado la nueva firma creada.</li></br><a href="img4.png"><b>IMAGEN EJEMPLO</b></a>


</br></br></br><span>PARA CUALQUIER DUDA O PROBLEMA ESTOY DISPONIBLE VIA CORREO O TELEFONO EN HORARIO LABORAL.</span>
<br>
<br>
<form method="post" action="">
	<input type="text" name="nombre" placeholder="Nombre" required>
   <input type="text" name="apellido" placeholder="Primer apellido">
   <input type="text" name="cargo" placeholder="Cargo o departamento">
   <select id="hotel" name="hotel"required>
   <option value="a">BQ AUGUSTA</option>
   <option value="b">BQ BOUTIQUE PAGUERA</option>
   <option value="c">BQ BULEVAR</option>
   <option value="d">BQ BELVEDERE</option>
   <option value="e">BQ CENTRAL</option>
   <option value="f">BQ APOLO</option>
   <option value="g">BQ AMFORA BEACH</option>
   <option value="h">BQ AGUAMARINA</option>
   <option value="i">BQ CARMEN PLAYA</option>
   <option value="j">BQ SARAH</option>
   <option value="k">BQ CAN PICAFORT</option>
   <option value="l">BQ DELFIN AZUL</option>
   <option value="m">BQ SUN VILLAGE</option>
   <option value="n">BQ ANDALUCIA BEACH</option>
   <option value="o">BQ CALA RATJADA</option>
  
   </select>
	
	<input type="text" name="ext" placeholder="Extension">
	<input type="text" name="movil" placeholder="Telefono movil">
	<input type="text" name="email" placeholder="email" required><br><br>	
	
	
   <input type="submit" name="submit" value="GENERAR FIRMA">
	<button onclick="setTimeout(function(){location.reload();}, 3000);">RECARGAR INFORMACIÓN</button>
</form>
<div style="border: 1px solid red;">
<?php
if(isset($_POST['submit'])) 
{ 
	
    $nombre = $_POST['nombre'];
	$apellido=$_POST['apellido'];
	$cargo=$_POST['cargo'];
	$hotel=$_POST['hotel'];
	$ext=$_POST['ext'];
	$movil=$_POST['movil'];
	$email=$_POST['email'];
	$nombre = ucfirst($nombre); 
	$apellido = ucfirst($apellido);
	$cargo = ucfirst($cargo);	

		if (empty($ext)){
			$ext="&nbsp;";}
		else{
			$ext="Ext.$ext";
		}
		
		if (empty($movil)){
			$movil="";}
		else{
			$movil="Mov:$movil";
		}
		
	
	if($hotel==='a'){
		$hotel="BQ AUGUSTA";
		$fijo="971700813";
	$direccion="C/ Corb Marí, 22, 07015 Palma, Illes Balears";}
	elseif($hotel==='b'){
		$hotel="BQ PAGUERA BOUTIQUE";
		$fijo="971686598";
		$direccion="C/ Palmira, 29, 07160 Peguera, Illes Balears";}
	elseif($hotel==='c'){
		$hotel="BQ BULEVAR PEGUERA";
		$fijo="971686397";
		$direccion="C/ Eucalipto, 15, 07160 Peguera, Illes Balears";}
	elseif($hotel==='d'){
		$hotel="BQ BELVEDERE";
		$fijo="971401411";
		$direccion="C/ Mitja Lluna, 4, 07015 Palma, Illes Balears";}
	elseif($hotel==='e'){
		$hotel="BQ CENTRAL";
		$fijo="971707755";
		$direccion="C/ Marquès de la Sènia, 39 BAJOS, 07014 Palma, Illes Balears";}
	elseif($hotel==='f'){
		$hotel="BQ APOLO";
		$fijo="971262500";
		$direccion="C/ Miquel Massutí, 28, 07610 Palma, Illes";}
	elseif($hotel==='g'){
		$hotel="BQ AMFORA";
		$fijo="971491580";
		$direccion="C/ Volantí, 9, 07610 Palma, Illes Balears";}
	elseif($hotel==='h'){
		$hotel="BQ AGUAMARINA BOUTIQUE";
		$fijo="971261662";
		$direccion="C/ Sant Antoni de la Platja, 41, 07610 Palma, Illes Balears";}
	elseif($hotel==='i'){
		$hotel="BQ CARMEN PLAYA";
		$fijo="971744015";
		$direccion="C/ Ferran Alzamora, 32, 07600 Palma, Illes Balears";}
	elseif($hotel==='j'){
		$hotel="BQ SARAH";
		$fijo="971850425";
		$direccion="Av. Diagonal, 6, 07458 Can Picafort, Illes Balears";}
	elseif($hotel==='k'){
		$hotel="BQ CAN PICAFORT";
		$fijo="971850001";
		$direccion="C/ Arenal, 24, 07458 Can Picafort, Illes Balears";}
	elseif($hotel==='l'){
		$hotel="BQ DELFIN AZUL";
		$fijo="971891350";
		$direccion="C/ Fotja, 1, 07400 Alcúdia, Illes Balears";}
	elseif($hotel==='m'){
		$hotel="BQ ALCUDIA SUN VILLAGE";
		$fijo="971890500";
		$direccion="C / Circuit del Llac, 60, 07458 Muro, Illes Balears";}
	elseif($hotel==='n'){
		$hotel="BQ ANDALUCIA BEACH";
		$fijo="952547970";
		$direccion="Paseo Marítimo de Poniente s/n, 29740 Torre del Mar, Málaga";}
	elseif($hotel==='o'){
		$hotel="BQ CALA RATJADA";
		$fijo="971595080";
		$direccion="Carrer Floreal, 30, 07590 Cala Rajada, Illes Balears";}	
	
	
	
	
	
	
   
	  echo '<style type="text/css">
 @font-face {
font-family: "Frutiger";
src: url("https://firma.bqhoteles.com/Frutiger.ttf") format("ttf"),
url("https://firma.bqhoteles.com/Frutiger.ttf") format("ttf");
font-weight: normal;
font-style: normal;
}

table{
	
	font-family: Frutiger,Calibri;
	
}
a{
	text-decoration: none;
}
</style>

<table>
<tbody>
<tr>
<td>
<table>
<tbody>
<tr>
<td width="150" style="vertical-align: middle;">
<span style="margin-right: 20px; display: block;">
<img src="https://firma.bqhoteles.com/logobq.jpg">
</span></td><td style="vertical-align: middle;"><h3 color="#000000"  style="margin: 0px; font-size: 18px; color: rgb(0, 0, 0);">';
echo "<span>$nombre</span>";
echo "&nbsp;";
echo "<span>$apellido</span>";
echo '
</h3>
<h8 style="margin: 0px;">
<p color="#000000"   style="margin: 0px; color: rgb(0, 0, 0); font-size: 12px; line-height: 22px;">';
echo "<span>$cargo</span>";
echo '
<br>
<span style="margin: 0px; color: rgb(0, 0, 0); font-size: 12px; line-height: 22px;"></span>
</p>
</h8>
<h4 style="margin: 0px;">
<p color="#000000"   style="margin: 0px; color: rgb(0, 0, 0);  line-height: 22px;">';
echo "<span>$hotel</span>";
echo '
<br>
<span style="margin: 0px; color: rgb(0, 0, 0); font-size: 12px; line-height: 22px;"></span>
</p>
</h4>
</td>
<td width="30">
<div style="width: 30px;"></div>
</td>
<td color="#FFBF07" direction="vertical" width="1"  style="width: 1px; border-bottom: none; border-left: 1px solid rgb(255, 191, 7);"></td>
<td width="30"><div style="width: 30px;"></div>
</td>
<td style="vertical-align: middle;">
<table>
<tbody>
<tr height="25" style="vertical-align: middle;">
<td width="30" style="vertical-align: middle;">
<table>
<tbody>
<tr>
<td style="vertical-align: bottom;">
<span class="sc-kgAjT cuzzPp" style="width:11; display: block;">
<img src="https://firma.bqhoteles.com/telefono.png" >
</span>
</td>
</tr>
</tbody>
</table>
</td>
<td style="padding: 0px; color: rgb(0, 0, 0);">';

echo "<a href='tel:$fijo'"; 
echo ' color="#000000"  style="text-decoration: none; color: rgb(0, 0, 0); font-size: 12px;">';
echo "<span>$fijo</span>";
echo'</a><span style="color: rgb(0, 0, 0); font-size: 12px;">';
echo "&nbsp;";
echo "$ext</span>";
echo "&nbsp;";
echo "&nbsp;";
echo "&nbsp;";
echo "<a href='$movil'"; 
echo' color="#000000"  style="text-decoration: none; color: rgb(0, 0, 0); font-size: 12px;">';
echo "<span>$movil</span>";
echo'</a>
</td>
</tr>
<tr height="15" style="vertical-align: middle;">
<td width="10" style="vertical-align: middle;">
<table>
<tbody>
<tr>
<td style="vertical-align: bottom;">
<span color="#FFBF07" width="11"  style="display: block; ">
<img src="https://firma.bqhoteles.com/email.png" >
</span>
</td>
</tr>
</tbody>
</table>
</td>
<td style="padding: 0px;">';
echo"<a href='mailto:$email' 'color='#000000'  style='text-decoration: none; color: rgb(0, 0, 0); font-size: 12px;' <span color='#000000'  style=' color: rgb(0, 0, 0); font-size: 12px;'>$email</span><a>
"; 
echo'
</td>
</tr>
<tr height="25" style="vertical-align: middle;">
<td width="30" style="vertical-align: middle;">
<table>
<tbody><tr><td style="vertical-align: bottom;">
<span color="#FFBF07" width="11"  style="display: block; ">
<img src="https://firma.bqhoteles.com/web.png"  role="presentation">
</span>
</td>
</tr>
</tbody>
</table>
</td>
<td style="padding: 0px;">
<a href="https://www.bqhoteles.com" color="#000000"  style="text-decoration: none; color: rgb(0, 0, 0); font-size: 12px;">
<span>www.bqhoteles.com</span>
</a>
</td>
</tr>
<tr height="25" style="vertical-align: middle;">
<td width="30" style="vertical-align: middle;">
<table>
<tbody>
<tr>
<td style="vertical-align: bottom;">
<span color="#FFBF07" width="11"  style="display: block;" >
<img src="https://firma.bqhoteles.com/localizacion.png"></span>
</td>
</tr>
</tbody>
</table>
</td>
<td style="padding: 0px;">
<span color="#000000"  style="font-size: 12px; color: rgb(0, 0, 0);">';

echo "<span>$direccion</span>";
echo '
</span>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>
<table cellpadding="0" cellspacing="0" class="sc-gPEVay eQYmiW" style=" width: 100%;"><tbody>
<tr>
<td height="10"></td>
</tr>
<tr>
<td color="#FFBF07" direction="horizontal" height="1" class="sc-jhAzac hmXDXQ" style="width: 100%; border-bottom: 1px solid rgb(255, 191, 7); border-left: none; display: block;"></td>
</tr>
<tr>
<td height="10"></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>
<table style="width: 100%;"><tbody>
<tr>
<td  style="font-size: 12px; color: rgb(0, 0, 0);">
<a href="httpss://www.facebook.com/BQHoteles" target="_blank"><img src="https://firma.bqhoteles.com/face.png" role="presentation" width="30"  style="max-width: 30px;"></a>
<a href="httpss://www.instagram.com/bqhoteles/" target="_blank"><img src="https://firma.bqhoteles.com/ins.png" httpss role="presentation" width="30"  style="max-width: 30px;"></a>
<a href="httpss://twitter.com/BQHoteles" target="_blank"><img src="https://firma.bqhoteles.com/twi.png" role="presentation" width="30"  style="max-width: 30px;"></a>
<span><b>Siguenos!</b> </span>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>
<table  style="width: 100%;"><tbody>
<tr>
<td  style="font-size: 12px; color: #FBBB01;">
<img src="https://firma.bqhoteles.com/arbol.png" role="presentation" width="25"  style="max-width: 25px;"><span><i>Imprima este correo sólo si es necesario.</i></span>
</td>
</tr>
<tr>
<td style="font-size: 10px;">
<span>Puede consultar la información adicional y detallada sobre protección de datos en nuestra página web: <a style="color:#FBBB01;" href="httpss://bqhoteles.com/es/proteccion-de-datos">www.bqhoteles.com</a></span>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>';
	  
	  
    
}

?>
</div>
<script src="https://asistente.bqhoteles.com/widget-bot-bq.js"></script>

<!-- Lógica para mostrar/ocultar -->
<script>
  function abrirChatBQ() {
    const iframeDiv = document.getElementById("iframe-chat-bq");
    const btn = document.getElementById("btn-open-chat");

    const isOpen = iframeDiv.classList.contains("visible");
    if (isOpen) {
      iframeDiv.classList.remove("visible");
      setTimeout(() => (iframeDiv.style.display = "none"), 300);
      btn.textContent = "💬";
    } else {
      iframeDiv.style.display = "block";
      setTimeout(() => iframeDiv.classList.add("visible"), 10);
      btn.textContent = "❌";
    }
  }

  // Cierra el chat si se hace clic fuera
  document.addEventListener("click", (e) => {
    const widget = document.getElementById("chat-bqhoteles-widget");
    const iframeDiv = document.getElementById("iframe-chat-bq");
    const btn = document.getElementById("btn-open-chat");

    if (!widget.contains(e.target) && iframeDiv.classList.contains("visible")) {
      iframeDiv.classList.remove("visible");
      setTimeout(() => (iframeDiv.style.display = "none"), 300);
      btn.textContent = "💬";
    }
  });
</script>
</body>
</html>
