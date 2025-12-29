<html>
<head>
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<style type="text/css">
    body { font-family: 'Calibri', sans-serif; color: #333; line-height: 1.5; }
    .container-admin { max-width: 900px; margin: 0 auto; padding: 20px; }
    .instrucciones { background-color: #f9f9f9; padding: 20px; border-radius: 8px; border-left: 5px solid #1a1a1a; margin-bottom: 30px; }
    .instrucciones h3 { margin-top: 0; color: #1a1a1a; }
    .instrucciones li { margin-bottom: 10px; font-size: 14px; }
    input, select { padding: 10px; margin: 5px; border: 1px solid #ccc; border-radius: 4px; width: 250px; }
    .btn-generar { background-color: #1a1a1a; color: white; padding: 12px 25px; border: none; cursor: pointer; font-weight: bold; }
    .btn-generar:hover { background-color: #333; }
    .preview-box { border: 2px dashed #fbaa21; padding: 20px; margin-top: 20px; background-color: white; }
</style>
</head>
<body>

<div class="container-admin">
    <a href="index.php" style="text-decoration:none; color:#666;">← Volver al selector de marcas</a>
    <h1 style="color:#1a1a1a; border-bottom: 2px solid #eee; padding-bottom: 10px;">GENERADOR DE FIRMAS SUMMUM HOTEL GROUP</h1>

    <div class="instrucciones">
        <h3>🚀 Instrucciones de Instalación</h3>
        <table width="100%">
            <tr>
                <td width="50%" style="vertical-align: top; padding-right: 20px;">
                    <strong>En Outlook:</strong>
                    <ol>
                        <li>Rellena el formulario y pulsa "Generar".</li>
                        <li>Selecciona con el ratón toda la firma del recuadro rojo y <b>Cópiala (Ctrl+C)</b>.</li>
                        <li>En Outlook: Archivo > Opciones > Correo > Firmas.</li>
                        <li>Crea una nueva, <b>Pega (Ctrl+V)</b> y guarda cambios.</li>
                    </ol>
                </td>
                <td width="50%" style="vertical-align: top; border-left: 1px solid #ddd; padding-left: 20px;">
                    <strong>En Gmail:</strong>
                    <ol>
                        <li>Rellena el formulario y pulsa "Generar".</li>
                        <li>Selecciona toda la firma y <b>Cópiala (Ctrl+C)</b>.</li>
                        <li>En Gmail: Configuración > Ver todos los ajustes > General > Firma.</li>
                        <li><b>Pega (Ctrl+V)</b> en el cuadro de texto y marca "Insertar firma antes del texto citado".</li>
                    </ol>
                </td>
            </tr>
        </table>
    </div>

    <form method="post" action="">
        <input type="text" name="nombre" placeholder="Nombre y Apellidos" required>
        <input type="text" name="cargo" placeholder="Cargo o Departamento" required>
        <input type="text" name="email" placeholder="Email corporativo" required>
        <input type="text" name="telefono" placeholder="Teléfono fijo (ej: +34 971...)" required>
        <input type="text" name="movil" placeholder="Móvil (ej: +34 600...)">
        <br><br>
        <input type="submit" name="submit" class="btn-generar" value="GENERAR FIRMA SUMMUM">
    </form>

    <?php if (isset($_POST['submit'])) {

        $nombre = $_POST['nombre'];
        $cargo = $_POST['cargo'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $movil = $_POST['movil'];

        // URL de S3 (Asegúrate de que la carpeta y el logo existen)
        $url_s3 = 'https://imagenes-firmas-corporativas.s3.eu-west-1.amazonaws.com/summum/';
        ?>
    
    <div class="preview-box">
        <table cellpadding="0" cellspacing="0" style="font-family: 'Segoe UI', Helvetica, Arial, sans-serif; border-collapse: collapse; background-color: #ffffff;">
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
                    <td style="font-size: 19px; font-weight: bold; color: #1a1a1a; padding-bottom: 2px;"><?php echo $nombre; ?></td>
                  </tr>
                  <tr>
                    <td style="font-size: 14px; color: #666666; padding-bottom: 12px;"><?php echo $cargo; ?></td>
                  </tr>
                  <tr>
                    <td style="font-size: 13px; padding-bottom: 2px;">
                      <a href="mailto:<?php echo $email; ?>" style="color: #666666; text-decoration: none;"><?php echo $email; ?></a>
                    </td>
                  </tr>
                  <tr>
                    <td style="font-size: 13px; color: #666666; padding-bottom: 10px;">
                      <?php echo $telefono; ?> <?php echo !empty($movil)
     ? ' - Mov: ' . $movil
     : ''; ?>
                    </td>
                  </tr>
                  <tr>
                    <td style="font-size: 14px; font-weight: bold; letter-spacing: 0.5px;">
                      <a href="https://summumhotelgroup.com" style="color: #1a1a1a; text-decoration: none;">summumhotelgroup.com</a>
                    </td>
                  </tr>
                  
                </table>
              </td>
            </tr>
            <tr>
                <td colspan="3" style="padding-top: 15px; text-align: center;">
                    <img src="<?php echo $url_s3; ?>banner.gif" width="500" style="max-width: 100%; height: auto; display: block; border: 0;" alt="">
                </td>
                <td colspan="3" style="padding-top: 20px;">
                    <table cellpadding="0" cellspacing="0" style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="font-size: 11px; color: #228b22; font-family: 'Segoe UI', Arial, sans-serif; padding-bottom: 10px;">
                                <img src="https://imagenes-firmas-corporativas.s3.eu-west-1.amazonaws.com/bqhoteles/arbol.gif" width="20" style="vertical-align: middle; margin-right: 5px;">
                                <i>Antes de imprimir este correo, por favor, asegúrese de que es necesario. Cuidemos el medio ambiente.</i>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size: 10px; color: #999999; line-height: 1.2; text-align: justify; font-family: Arial, sans-serif;">
                                Puede consultar la información adicional y detallada sobre protección de datos en nuestra página web: 
                                <a href="https://www.summumhotelgroup.com/es/politica/" style="color: #666666; text-decoration: underline;">www.summumhotelgroup.com/es/politica/</a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
          </tbody>
        </table>
        </div>
    <p style="color: #fbaa21; font-weight: bold;">↑ Selecciona desde aquí arriba hasta el logo para copiar ↑</p>
    <?php
    } ?>
</div>

</body>
</html>