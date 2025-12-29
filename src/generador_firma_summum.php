<html>
<head>
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<style type="text/css">
    body { font-family: 'Calibri', sans-serif; color: #333; }
    .instrucciones { font-size: 14px; margin-bottom: 20px; color: #666; }
    input, select { padding: 8px; margin: 5px; border: 1px solid #ccc; border-radius: 4px; }
    .btn-generar { background-color: #1a1a1a; color: white; padding: 10px 20px; border: none; cursor: pointer; }
</style>
</head>
<body>

<a href="index.php" style="text-decoration:none; color:#666;">← Volver al selector</a>
<h1 style="color:#1a1a1a;">GENERADOR DE FIRMAS SUMMUM HOTEL GROUP</h1>

<div class="instrucciones">
    <li>1. Rellena los datos (Nombre y Apellido con mayúsculas iniciales).</li>
    <li>2. Pulsa Generar y copia el contenido del cuadro inferior.</li>
</div>

<form method="post" action="">
    <input type="text" name="nombre" placeholder="Nombre y Apellidos" required>
    <input type="text" name="cargo" placeholder="Cargo o Departamento" required>
    <input type="text" name="email" placeholder="Email " required>
    <input type="text" name="telefono" placeholder="Teléfono fijo" required>
    <input type="text" name="movil" placeholder="Movil" required>
    <input type="submit" name="submit" class="btn-generar" value="GENERAR FIRMA SUMMUM">
</form>

<div style="border: 1px solid #eee; padding: 20px; margin-top: 20px; background-color: white;">
<?php if (isset($_POST['submit'])) {

    $nombre = $_POST['nombre'];
    $cargo = $_POST['cargo'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $movil = $_POST['movil'];

    // URL de S3 para el logo de Summum
    $url_s3 = 'https://imagenes-firmas-corporativas.s3.eu-west-1.amazonaws.com/summum/';

    // Nota: Asegúrate de subir el logo de summum a S3 y cambiar el nombre aquí abajo si es distinto
    ?>

<table cellpadding="0" cellspacing="0" style="font-family: 'Segoe UI', Helvetica, Arial, sans-serif; border-collapse: collapse;">
  <tbody>
    <tr>
      <td style="vertical-align: middle; padding-right: 30px;">
        <img src="<?php echo $url_s3; ?>logosummum.png" width="220" style="display: block; border: 0;" alt="Summum Hotel Group">
      </td>

      <td width="1" style="width: 1px; border-left: 1px solid #808080; padding: 0;">
        <div style="height: 100px; width: 1px;"></div>
      </td>

      <td style="vertical-align: middle; padding-left: 30px;">
        <table cellpadding="0" cellspacing="0" style="line-height: 1.4;">
          <tr>
            <td style="font-size: 19px; font-weight: bold; color: #1a1a1a; padding-bottom: 2px;">
              <?php echo $nombre; ?>
            </td>
          </tr>
          <tr>
            <td style="font-size: 14px; color: #666666; padding-bottom: 12px; text-transform: capitalize;">
              <?php echo $cargo; ?>
            </td>
          </tr>
          <tr>
            <td style="font-size: 13px; padding-bottom: 2px;">
              <a href="mailto:<?php echo $email; ?>" style="color: #666666; text-decoration: none;">
                <?php echo $email; ?>
              </a>
            </td>
          </tr>
          <tr>
            <td style="font-size: 13px; color: #666666; padding-bottom: 10px;">
              <?php echo $telefono; ?> - Mov: <?php echo $movil; ?>
            </td>
          </tr>
          <tr>
            <td style="font-size: 14px; font-weight: bold; letter-spacing: 0.5px;">
              <a href="https://summumhotelgroup.com" style="color: #1a1a1a; text-decoration: none;">
                summumhotelgroup.com
              </a>
            </td>
          </tr>
        </table>
        <table cellpadding="0" cellspacing="0" style="width: 100%; border-collapse: collapse;">
    <tr><td height="20"></td></tr>
</table>

<table cellpadding="0" cellspacing="0" style="width: 100%; border-collapse: collapse; font-family: 'Segoe UI', Helvetica, Arial, sans-serif;">
    <tr>
        <td style="font-size: 11px; color: #228b22; line-height: 1.3;">
            Antes de imprimir este correo, por favor, asegúrese de que es necesario. Con una tonelada de papel que no utilicemos evitamos la tala de 17 árboles, ahorramos agua en un 86%, energía en un 62.5% y disminuimos la contaminación. Todos somos responsables del cuidado del medio ambiente.
        </td>
    </tr>
    <tr><td height="10"></td></tr>
    <tr>
        <td style="font-size: 9px; color: #666666; text-align: justify; line-height: 1.2;">
            De conformidad con lo dispuesto en la normativa vigente sobre protección de datos personales y en el Reglamento (UE) 2016/679 de 27 de abril de 2016 (GDPR), sus datos personales y dirección de correo electrónico, serán tratados bajo la responsabilidad de SUMMUM HOTEL GROUP SA. Finalidad: envío de comunicaciones sobre nuestros productos y servicios. Conservación: mientras exista un interés mutuo para ello, en función de los plazos legales aplicables. Legitimación: consentimiento del interesado o ejecución de un contrato. Destinatarios: los datos podrán ser comunicados a terceros o a otras empresas del grupo SUMMUM HOTEL GROUP, para alcanzar el fin antes expuesto. Le informamos que puede ejercer los derechos de acceso, rectificación y supresión de sus datos, así como los de limitación y oposición a su tratamiento, mediante notificación escrita, a la dirección C/ Bartolomé Fons 8, 07015, Palma de Mallorca o enviando un mensaje al correo electrónico <a href="mailto:lopd@summumhg.com" style="color: #0000ee; text-decoration: underline;">lopd@summumhg.com</a>. Más información en <a href="https://www.summumhotelgroup.com" style="color: #0000ee; text-decoration: underline;">www.summumhotelgroup.com</a>. Si considera que el tratamiento no se ajusta a la normativa vigente, podrá presentar una reclamación ante la autoridad de control en <a href="https://www.aepd.es" style="color: #0000ee; text-decoration: underline;">www.aepd.es</a> AVISO LEGAL: Este mensaje y sus archivos adjuntos van dirigidos exclusivamente a su destinatario, pudiendo contener información confidencial sometida a secreto profesional. No está permitida su comunicación, reproducción o distribución sin la autorización expresa de SUMMUM HOTEL GROUP. Si usted no es el destinatario final, por favor elimínelo e infórmenos por esta vía.
        </td>
    </tr>
</table>
      </td>
    </tr>
  </tbody>
</table>
<?php
} ?>
</div>

</body>
</html>