<?php
// Configuración inicial
$url_s3 = 'https://imagenes-firmas-corporativas.s3.eu-west-1.amazonaws.com/bqhoteles/'; ?>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <title>Generador de Firmas - BQ Hoteles</title>
    <style type="text/css">
        @font-face {
            font-family: 'Frutiger';
            src: url('https://firma.bqhoteles.com/Frutiger.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        body { font-family: 'Frutiger', 'Calibri', sans-serif; color: #333; line-height: 1.5; background-color: #f4f4f4; margin: 0; padding: 0; }
        .container-admin { max-width: 1000px; margin: 20px auto; padding: 30px; background-color: white; border-radius: 10px; shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .instrucciones { background-color: #fffaf0; padding: 20px; border-radius: 8px; border-left: 5px solid #fbaa21; margin-bottom: 30px; border: 1px solid #ffe4b5; }
        .instrucciones h3 { margin-top: 0; color: #fbaa21; }
        .instrucciones li { margin-bottom: 8px; font-size: 14px; }
        input, select { padding: 10px; margin: 5px; border: 1px solid #ccc; border-radius: 4px; width: 280px; font-family: sans-serif; }
        .btn-generar { background-color: #fbaa21; color: white; padding: 12px 25px; border: none; cursor: pointer; font-weight: bold; text-transform: uppercase; border-radius: 4px; }
        .btn-generar:hover { background-color: #e59a1f; }
        .preview-box { border: 2px dashed #fbaa21; padding: 25px; margin-top: 25px; background-color: white; display: inline-block; }
        .btn-volver { text-decoration: none; color: #666; font-size: 14px; display: inline-block; margin-bottom: 20px; }
        .btn-volver:hover { color: #fbaa21; }
    </style>
</head>
<body>

<div class="container-admin">
    <a href="index.php" class="btn-volver">← Volver al selector de marcas</a>
    
    <div style="text-align: center; margin-bottom: 30px;">
        <img src="<?php echo $url_s3; ?>logobq.gif" style="max-width: 150px;">
        <h1 style="color:#fbaa21; margin-top: 10px;">GENERADOR DE FIRMAS BQ HOTELES</h1>
    </div>

    <div class="instrucciones">
        <h3>🚀 Instrucciones de Instalación</h3>
        <table width="100%" style="border-collapse: collapse;">
            <tr>
                <td width="50%" style="vertical-align: top; padding-right: 20px; border-right: 1px solid #eee;">
                    <strong>En Outlook:</strong>
                    <ol>
                        <li>Rellena el formulario y pulsa "Generar".</li>
                        <li>Selecciona con el ratón la firma dentro del recuadro rojo.</li>
                        <li><b>Copia (Ctrl+C)</b>.</li>
                        <li>En Outlook: <b>Archivo > Opciones > Correo > Firmas</b>.</li>
                        <li>Crea una nueva, <b>Pega (Ctrl+V)</b> y guarda.</li>
                    </ol>
                </td>
                <td width="50%" style="vertical-align: top; padding-left: 20px;">
                    <strong>En Gmail:</strong>
                    <ol>
                        <li>Rellena el formulario y pulsa "Generar".</li>
                        <li>Selecciona la firma generada y <b>Copia (Ctrl+C)</b>.</li>
                        <li>En Gmail: <b>Configuración > General > Firma</b>.</li>
                        <li><b>Pega (Ctrl+V)</b> en el cuadro.</li>
                        <li>Marca "Insertar firma antes del texto citado".</li>
                    </ol>
                </td>
            </tr>
        </table>
    </div>

    <form method="post" action="">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="apellido" placeholder="Primer apellido">
        <input type="text" name="cargo" placeholder="Cargo o departamento">
        <select id="hotel" name="hotel" required>
            <option value="" disabled selected>Selecciona Hotel</option>
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
        <input type="text" name="ext" placeholder="Extensión">
        <input type="text" name="movil" placeholder="Teléfono móvil">
        <input type="text" name="email" placeholder="Email corporativo" required>
        <br><br>
        <input type="submit" name="submit" class="btn-generar" value="GENERAR FIRMA BQ">
    </form>

    <?php if (isset($_POST['submit'])) {

        $nombre = ucfirst($_POST['nombre']);
        $apellido = ucfirst($_POST['apellido']);
        $cargo = ucfirst($_POST['cargo']);
        $hotel_key = $_POST['hotel'];
        $ext = !empty($_POST['ext']) ? 'Ext.' . $_POST['ext'] : '';
        $movil = !empty($_POST['movil']) ? 'Mov: ' . $_POST['movil'] : '';
        $email = $_POST['email'];

        // Lógica de datos por hotel
        $hoteles = [
            'a' => [
                'h' => 'BQ AUGUSTA',
                't' => '971700813',
                'd' => 'C/ Corb Marí, 22, 07015 Palma, Illes Balears',
            ],
            'b' => [
                'h' => 'BQ PAGUERA BOUTIQUE',
                't' => '971686598',
                'd' => 'C/ Palmira, 29, 07160 Peguera, Illes Balears',
            ],
            'c' => [
                'h' => 'BQ BULEVAR PEGUERA',
                't' => '971686397',
                'd' => 'C/ Eucalipto, 15, 07160 Peguera, Illes Balears',
            ],
            'd' => [
                'h' => 'BQ BELVEDERE',
                't' => '971401411',
                'd' => 'C/ Mitja Lluna, 4, 07015 Palma, Illes Balears',
            ],
            'e' => [
                'h' => 'BQ CENTRAL',
                't' => '971707755',
                'd' => 'C/ Marquès de la Sènia, 39 BAJOS, 07014 Palma, Illes Balears',
            ],
            'f' => [
                'h' => 'BQ APOLO',
                't' => '971262500',
                'd' => 'C/ Miquel Massutí, 28, 07610 Palma, Illes',
            ],
            'g' => [
                'h' => 'BQ AMFORA',
                't' => '971491580',
                'd' => 'C/ Volantí, 9, 07610 Palma, Illes Balears',
            ],
            'h' => [
                'h' => 'BQ AGUAMARINA BOUTIQUE',
                't' => '971261662',
                'd' => 'C/ Sant Antoni de la Platja, 41, 07610 Palma, Illes Balears',
            ],
            'i' => [
                'h' => 'BQ CARMEN PLAYA',
                't' => '971744015',
                'd' => 'C/ Ferran Alzamora, 32, 07600 Palma, Illes Balears',
            ],
            'j' => [
                'h' => 'BQ SARAH',
                't' => '971850425',
                'd' => 'Av. Diagonal, 6, 07458 Can Picafort, Illes Balears',
            ],
            'k' => [
                'h' => 'BQ CAN PICAFORT',
                't' => '971850001',
                'd' => 'C/ Arenal, 24, 07458 Can Picafort, Illes Balears',
            ],
            'l' => [
                'h' => 'BQ DELFIN AZUL',
                't' => '971891350',
                'd' => 'C/ Fotja, 1, 07400 Alcúdia, Illes Balears',
            ],
            'm' => [
                'h' => 'BQ ALCUDIA SUN VILLAGE',
                't' => '971890500',
                'd' => 'C / Circuit del Llac, 60, 07458 Muro, Illes Balears',
            ],
            'n' => [
                'h' => 'BQ ANDALUCIA BEACH',
                't' => '952547970',
                'd' => 'Paseo Marítimo de Poniente s/n, 29740 Torre del Mar, Málaga',
            ],
            'o' => [
                'h' => 'BQ CALA RATJADA',
                't' => '971595080',
                'd' => 'Carrer Floreal, 30, 07590 Cala Rajada, Illes Balears',
            ],
        ];

        $hotel = $hoteles[$hotel_key]['h'];
        $fijo = $hoteles[$hotel_key]['t'];
        $direccion = $hoteles[$hotel_key]['d'];
        ?>

    <div class="preview-box">
        <table cellpadding="0" cellspacing="0" style="font-family: 'Frutiger', Calibri, sans-serif; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="vertical-align: middle; padding-right: 20px;">
                        <img src="<?php echo $url_s3; ?>logobq.gif" width="150" style="display: block; border: 0;">
                    </td>
                    <td style="vertical-align: middle; padding-left: 20px;">
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="font-size: 18px; font-weight: bold; color: #000000;"><?php echo "$nombre $apellido"; ?></td>
                            </tr>
                            <tr>
                                <td style="font-size: 12px; color: #000000; padding-bottom: 5px;"><?php echo $cargo; ?></td>
                            </tr>
                            <tr>
                                <td style="font-size: 13px; font-weight: bold; color: #000000;"><?php echo $hotel; ?></td>
                            </tr>
                        </table>
                    </td>
                    <td width="30"></td>
                    <td width="1" style="border-left: 1px solid #fbaa21; height: 80px;"></td>
                    <td width="30"></td>
                    <td style="vertical-align: middle;">
                        <table cellpadding="0" cellspacing="0" style="font-size: 12px; color: #000000;">
                            <tr>
                                <td><img src="<?php echo $url_s3; ?>telefono.png" width="12" style="margin-right:8px;"> <a href="tel:<?php echo $fijo; ?>" style="color:#000; text-decoration:none;"><?php echo $fijo; ?></a> <?php echo $ext; ?> <?php echo $movil; ?></td>
                            </tr>
                            <tr>
                                <td style="padding: 4px 0;"><img src="<?php echo $url_s3; ?>email.png" width="12" style="margin-right:8px;"> <a href="mailto:<?php echo $email; ?>" style="color:#000; text-decoration:none;"><?php echo $email; ?></a></td>
                            </tr>
                            <tr>
                                <td style="padding-bottom: 4px;"><img src="<?php echo $url_s3; ?>web.png" width="12" style="margin-right:8px;"> <a href="https://www.bqhoteles.com" style="color:#000; text-decoration:none;">www.bqhoteles.com</a></td>
                            </tr>
                            <tr>
                                <td><img src="<?php echo $url_s3; ?>localizacion.png" width="12" style="margin-right:8px;"> <?php echo $direccion; ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" style="padding-top: 15px;">
                        <div style="border-bottom: 1px solid #fbaa21; width: 100%;"></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" style="padding-top: 10px;">
                        <a href="https://www.facebook.com/BQHoteles"><img src="<?php echo $url_s3; ?>face.png" width="24" style="margin-right:5px;"></a>
                        <a href="https://www.instagram.com/bqhoteles/"><img src="<?php echo $url_s3; ?>ins.png" width="24" style="margin-right:5px;"></a>
                        <a href="https://twitter.com/BQHoteles"><img src="<?php echo $url_s3; ?>twi.png" width="24" style="margin-right:10px;"></a>
                        <span style="font-size: 12px; font-weight: bold; vertical-align: super;">Siguenos!</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" style="padding-top: 15px;">
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="font-size: 12px; color: #fbaa21;">
                                    <img src="<?php echo $url_s3; ?>arbol.gif" width="20" style="vertical-align: middle; margin-right:5px;">
                                    <i>Imprima este correo sólo si es necesario.</i>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 10px; color: #333; padding-top: 5px;">
                                    Puede consultar la información adicional y detallada sobre protección de datos en nuestra web: <a href="https://bqhoteles.com/es/proteccion-de-datos" style="color:#fbaa21;">www.bqhoteles.com</a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <p style="color: #fbaa21; font-weight: bold; margin-top: 15px; text-align: center;">↑ Selecciona el contenido del recuadro para copiar tu firma ↑</p>
    <?php
    } ?>
</div>

</body>
</html>