<?php
// URL base de tus imágenes en S3
$url_s3 = 'https://imagenes-firmas-corporativas.s3.eu-west-1.amazonaws.com/'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Firmas Corporativas - BQ Hoteles</title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <style>
        body {
            font-family: 'Calibri', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        h1 {
            color: #fbaa21;
            margin-bottom: 50px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .container {
            display: flex;
            gap: 40px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            padding: 40px;
            text-align: center;
            transition: all 0.3s ease;
            text-decoration: none;
            width: 250px;
            border: 2px solid transparent;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
            border-color: #fbaa21;
        }

        .card img {
            width: 100%;
            height: auto;
            max-height: 120px;
            object-fit: contain;
            margin-bottom: 20px;
        }

        .card span {
            display: block;
            font-weight: bold;
            color: #555;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>

    <h1>Seleccione el Generador de Firmas</h1>

    <div class="container">
        <a href="generador_firma_bqhoteles.php" class="card">
            <img src="<?php echo $url_s3; ?>bqhoteles/logobq.gif" alt="BQ Hoteles">
            <span>BQ HOTELES</span>
        </a>

        <a href="generador_firma_summum.php" class="card">
            <img src="<?php echo $url_s3; ?>summum/logosummum.png" alt="Summum">
            <span>SUMMUM</span>
        </a>
    </div>

</body>
</html>