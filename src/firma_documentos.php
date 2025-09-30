<?php
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\OAuth;
//Alias the League Google OAuth2 provider class
use League\OAuth2\Client\Provider\Google;

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require 'vendor/autoload.php';

// Establecer conexión a la base de datos
$con = new mysqli('mysql_server', 'firma_documentos', '57ni2eF', 'firma_bqhoteles', 3306);

// Comprobar la conexión
if ($con->connect_errno) {
    // Mostrar detalles del error de conexión
    echo 'Error de conexión a la base de datos: (' .
        $con->connect_errno .
        ') ' .
        $con->connect_error;
    exit(); // Detener la ejecución si no se puede conectar a la base de datos
}

// Establecer la codificación a utf8mb4 para evitar problemas con caracteres especiales
if (!$con->set_charset('utf8mb4')) {
    echo 'Error cargando el conjunto de caracteres utf8mb4: ' . $con->error;
}
?>



<html>
<head>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style type="text/css">
 @font-face {
font-family: ‘Frutiger’;
src: url(‘https://firma.bqhoteles.com/Frutiger.ttf′) format(‘ttf’),
url(‘https://firma.bqhoteles.com/Frutiger.ttf’) format(‘ttf’);
font-weight: normal;
font-style: normal;
}
body{
	font-family: Frutiger,Calibri;
}

</style>
</head>
<body>

<img  src="logo.png">
<h1 style="text-align:center; color:#fbaa21;">GENERADOR DE DOCUMENTOS A FIRMAR</h1>


<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

	<input type="text" name="email_trabajador" placeholder="Email Trabajador" autocomplete="off" required>
	<input type="text" name="email_con_copia" placeholder="Email con copia" autocomplete="off">
	
	<input type="text" name="nombre_trabajador" placeholder="Nombre trabajador" autocomplete="off" required>
	<input type="text" name="apellido1_trabajador" placeholder="Primer Apellido" autocomplete="off" required>
	
	
	
   <label>Departamento</label>
     <select id="id_departamento" name="id_departamento"required>
   <option value="1">RECEPCION</option>
   <option value="2">PISOS</option>
   <option value="3">SSTT</option>
   <option value="4">COMEDOR-BAR</option>
	<option value="5">COCINA</option>
  <option value="6">DIRECCION-INTERVENCION</option>
  <option value="7">SUPERMERCADO</option>
   </select>



   
     <label>Hotel</label>
   <select id="id_hotel" name="id_hotel"required>
   
   <?php
   $hoteles = 'SELECT * FROM hotel';
   $resultado_hoteles = mysqli_query($con, $hoteles);
   if (mysqli_num_rows($resultado_hoteles) > 0) {
       while ($row = mysqli_fetch_assoc($resultado_hoteles)) {
           $id_hotel = $row['id_hotel'];
           $nombre_hotel = $row['nombre_hotel'];

           echo "<option value='$id_hotel'>$nombre_hotel</option>";
       }
   }
   ?>   
   

  
   </select>

	
	
   <button type="submit" name="submit" value="ENVIAR DOCUMENTACION">ENVIAR EMAIL</button>
	<button  class="button" onclick="setTimeout(function(){location.reload();}, 3000);">RECARGAR INFORMACIÓN</button>
</form>
<div style="border: 1px solid red;">

</div>
</body>



<?php if (isset($_POST['submit'])) {
    $email_trabajador = $_POST['email_trabajador'];
    $email_con_copia = $_POST['email_con_copia'];
    $nombre_trabajador = $_POST['nombre_trabajador'];
    $apellido1_trabajador = $_POST['apellido1_trabajador'];
    $id_departamento = $_POST['id_departamento'];
    $id_hotel = $_POST['id_hotel'];

    $sql = "SELECT hotel.nombre_hotel,departamento.nombre_departamento,carpeta.nombre_carpeta,hotel.email FROM carpeta INNER JOIN hotel ON carpeta.id_hotel=hotel.id_hotel INNER JOIN departamento ON carpeta.id_departamento=departamento.id_departamento WHERE hotel.id_hotel=$id_hotel AND departamento.id_departamento=$id_departamento";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $nombre_hotel = $row['nombre_hotel'];
        $nombre_departamento = $row['nombre_departamento'];
        $nombre_carpeta = $row['nombre_carpeta'];
        $email_interventora = $row['email'];

        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        //Tell PHPMailer to use SMTP
        $mail->isSMTP();
        //Enable SMTP debugging
        //SMTP::DEBUG_OFF = off (for production use)
        //SMTP::DEBUG_CLIENT = client messages
        //SMTP::DEBUG_SERVER = client and server messages
        // /$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->SMTPDebug = SMTP::DEBUG_OFF;

        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';

        //Set the SMTP port number:
        // - 465 for SMTP with implicit TLS, a.k.a. RFC8314 SMTPS or
        // - 587 for SMTP+STARTTLS
        $mail->Port = 465;

        //Set the encryption mechanism to use:
        // - SMTPS (implicit TLS on port 465) or
        // - STARTTLS (explicit TLS on port 587)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;

        //Set AuthType to use XOAUTH2
        $mail->AuthType = 'XOAUTH2';

        //Start Option 1: Use league/oauth2-client as OAuth2 token provider
        //Fill in authentication details here
        //Either the gmail account owner, or the user that gave consent
        $clientId = getenv('GOOGLE_CLIENT_ID');
        $clientSecret = getenv('GOOGLE_CLIENT_SECRET');

        $email = 'soporte@bqhoteles.com';
        //Obtained by configuring and running get_oauth_token.php
        //after setting up an app in Google Developer Console.
        $refreshToken = getenv('GOOGLE_REFRESH_TOKEN');

        //Create a new OAuth2 provider instance
        $provider = new Google([
            'clientId' => $clientId,
            'clientSecret' => $clientSecret,
        ]);

        //Pass the OAuth provider instance to PHPMailer
        $mail->setOAuth(
            new OAuth([
                'provider' => $provider,
                'clientId' => $clientId,
                'clientSecret' => $clientSecret,
                'refreshToken' => $refreshToken,
                'userName' => $email,
            ]),
        );
        //End Option 1

        //Option 2: Another OAuth library as OAuth2 token provider
        //Set up the other oauth library as per its documentation
        //Then create the wrapper class that implements OAuthTokenProvider
        //$oauthTokenProvider = new MyOAuthTokenProvider(/* Email, ClientId, ClientSecret, etc. */);

        //Pass the implementation of OAuthTokenProvider to PHPMailer
        //$mail->setOAuth($oauthTokenProvider);
        //End Option 2

        //Set who the message is to be sent from
        //For gmail, this generally needs to be the same as the user you logged in as
        $mail->setFrom($email, 'BQHOTELES');

        //Set who the message is to be sent to
        $mail->addAddress($email_trabajador);
        $mail->addReplyTo($email_interventora);
        $mail->addCC($email_con_copia);
        //Set the subject line
        $mail->Subject =
            'Firma de documentos de ' .
            $nombre_trabajador .
            $apellido1_trabajador .
            ' del hotel ' .
            $nombre_hotel;

        $body = "

<html>
<head>
<style>
.button {
  background-color: #FD9407;
  color: white;
  padding: 15px 25px;
  text-decoration: none;
}
</style>

</head>
<body >
<table  style='border-collapse: collapse;'  width='100%'> 

        <tr>
            <td width='300' >
                <p>
                    <img width='200'  src='https://firma.bqhoteles.com/logo.png'/>
					
                    
					
                </p>
            </td>
            <td  >
                <p align='center'>
                 <font size=12>  <strong> DOCUMENTOS DE PRL Y MANUALES PARA EL DEPARTAMENTO $nombre_departamento DEL HOTEL $nombre_hotel</strong></font>
                </p>
            </td>
            
            
        </tr>
      
       
      
    
</table>   
<table>
			<tbody>
								<tr>
													<td>
													 <p> <font size=5>
													 
 Muy Atentamente $nombre_trabajador &nbsp; $apellido1_trabajador,
<br>
<br>
 

Cumpliendo con los pertinentes artículos de la Ley 31/95, de Prevención de Riesgos Laborales y según se establecen en los distintos Reales Decretos, sobre la protección de la salud y seguridad de los trabajadores, se hace entrega al trabajador de toda la documentación pertinente, así mismo también se le entrega la normativa interna, manuales y protocolos de actuación de BQ Hoteles.
<br>
 <br>
<br>

Ruego una vez reciban este correo accedan al siguiente enlace:

<br>
<br>
<a href='$nombre_carpeta'><button type='button' style='background-color: #FD9407;color: white;padding: 15px 25px; text-decoration: none;'><font size=12>ACCEDER</font></button></a>
<br>
<br>


Una vez leidos todos los documentos  contesten al mismo mail poniendo <strong> RECIBIDO, LEIDO Y ENTENDIDO</strong>
<br>
<br>

Para cualquier aclaración, no duden en contactar con su Jefe departamento o con dirección.
<br>
<br>
<br>

Saludos cordiales
</font></p>
													</td>
								</tr>
								
			</tbody>
</table>




</body>

</html>";

        // echo $body;

        //Set the subject line
        $mail->Body = $body;

        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $mail->CharSet = PHPMailer::CHARSET_UTF8;

        //Replace the plain text body with one created manually
        $mail->AltBody = 'This is a plain-text message body';

        //send the message, check for errors
        if (!$mail->send()) {
            echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se pudo enviar el email: " .
                addslashes($mail->ErrorInfo) .
                "',
        });
    </script>";
        } else {
            echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Enviado',
            text: 'El email se ha enviado correctamente a la direccion $email_trabajador ',
        });
    </script>";
        }
    }
} ?>

</html>







