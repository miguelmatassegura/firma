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
    <input type="text" name="telefono" placeholder="Teléfono fijo " required>
    <input type="text" name="movil" placeholder="Movil " required>
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
      </td>
    </tr>
  </tbody>
</table>
<?php
} ?>
</div>

</body>
</html>