<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Configuración de conexión
$host = 'localhost';
$db   = 'generador_passwords';
$user = 'generador';
$pass = '6qpEnGKMTCA6QAz';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

function generarPalabraClave($longitud = 8) {
    return bin2hex(random_bytes($longitud / 2));
}

function generarContrasena($email, $palabra_clave, $longitud = 10) {
    $hash = hash('sha256', $email . $palabra_clave, true);
    $base64 = base64_encode($hash);
    $base64 = preg_replace('/[^a-zA-Z0-9]/', '', $base64);
    while (strlen($base64) < $longitud) {
        $base64 .= base64_encode(hash('sha256', $base64, true));
        $base64 = preg_replace('/[^a-zA-Z0-9]/', '', $base64);
    }
    return substr($base64, 0, $longitud);
}

// REGISTRAR USUARIO
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['registro'])) {
    $email = trim($_POST['email']);
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        echo "<script>Swal.fire('Ya existe', 'El email ya está registrado.', 'warning');</script>";
    } else {
        $palabra_clave = generarPalabraClave();
        $stmt = $pdo->prepare("INSERT INTO usuarios (email, palabra_clave) VALUES (?, ?)");
        $stmt->execute([$email, $palabra_clave]);
        echo "<script>Swal.fire('Registrado', 'Usuario añadido correctamente.', 'success');</script>";
    }
}

// GENERAR CONTRASEÑA
$contraseña_generada = '';
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['generar'])) {
    $email = trim($_POST['email_generar']);
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        $usuario = $stmt->fetch();
        $contraseña_generada = generarContrasena($email, $usuario['palabra_clave']);
    } else {
        echo "<script>Swal.fire('No encontrado', 'El email no está registrado.', 'error');</script>";
    }
}

// REGENERAR PALABRA CLAVE
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['regenerar_clave']) && isset($_POST['email_clave'])) {
    $email = $_POST['email_clave'];
    $nueva_clave = generarPalabraClave();
    $stmt = $pdo->prepare("UPDATE usuarios SET palabra_clave = ? WHERE email = ?");
    $stmt->execute([$nueva_clave, $email]);
    echo "<script>Swal.fire('Palabra clave actualizada', 'La clave del usuario fue regenerada.', 'success');</script>";
}

// BORRAR USUARIO
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['borrar_usuario']) && isset($_POST['email_borrar'])) {
    $email = $_POST['email_borrar'];
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    echo "<script>Swal.fire('Eliminado', 'El usuario fue eliminado.', 'success');</script>";
}

// CARGAR USUARIOS
$stmt = $pdo->query("SELECT email, palabra_clave FROM usuarios ORDER BY email ASC");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestor de Contraseñas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-light">

<div class="container py-4">
    <h2 class="mb-4 text-center">Gestor de Contraseñas</h2>

    <!-- Registro -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Registrar nuevo email</h5>
            <form method="post">
                <div class="row g-2">
                    <div class="col-md-10">
                        <input type="email" name="email" class="form-control" placeholder="Correo electrónico" required>
                    </div>
                    <div class="col-md-2 d-grid">
                        <button type="submit" name="registro" class="btn btn-success">Registrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Generador -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Generar Contraseña</h5>
            <form method="post">
                <div class="row g-2">
                    <div class="col-md-10">
                        <input type="email" name="email_generar" class="form-control" placeholder="Correo electrónico" required>
                    </div>
                    <div class="col-md-2 d-grid">
                        <button type="submit" name="generar" class="btn btn-primary">Generar</button>
                    </div>
                </div>
            </form>
            <?php if ($contraseña_generada): ?>
                <div class="alert alert-info mt-3 d-flex justify-content-between align-items-center">
                    <span><strong>Contraseña:</strong> <span id="pwdGenerada"><?= htmlspecialchars($contraseña_generada) ?></span></span>
                    <button class="btn btn-sm btn-outline-secondary" onclick="copiarTexto('pwdGenerada')">Copiar</button>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Tabla de usuarios -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Listado de Usuarios</h5>
            <table class="table table-bordered table-striped table-sm align-middle">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Palabra Clave</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td id="email"><?= htmlspecialchars($usuario['email']) ?></td>
                            <td id="clave_<?= md5($usuario['email']) ?>"><?= htmlspecialchars($usuario['palabra_clave']) ?></td>
                            <td class="d-flex gap-2">
                            <form method="post" class="d-inline" id="form_borrar_<?= md5($usuario['email']) ?>">
                                    <input type="hidden" name="email_borrar" value="<?= htmlspecialchars($usuario['email']) ?>">
                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmarBorrado('form_borrar_<?= md5($usuario['email']) ?>')">Borrar</button>
                                    <input type="hidden" name="borrar_usuario" value="1">
                                </form>

                                <form method="post" class="d-inline" id="form_<?= md5($usuario['email']) ?>">
                                    <input type="hidden" name="email_clave" value="<?= htmlspecialchars($usuario['email']) ?>">
                                    <button type="button" class="btn btn-sm btn-outline-warning" onclick="confirmarRegeneracion('form_<?= md5($usuario['email']) ?>')">Regenerar</button>
                                    <input type="hidden" name="regenerar_clave" value="1">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($usuarios)): ?>
                        <tr><td colspan="3" class="text-center">No hay usuarios registrados.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function copiarTexto(id) {
    const texto = document.getElementById(id).innerText;
    navigator.clipboard.writeText(texto).then(() => {
        Swal.fire('Copiado', 'Texto copiado al portapapeles.', 'success');
    });
}

function confirmarRegeneracion(formId) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Esto generará una nueva palabra clave para este usuario.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, regenerar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(formId).submit();
        }
    });
}

function confirmarBorrado(formId) {
    Swal.fire({
        title: '¿Borrar usuario?',
        text: "Esta acción eliminará permanentemente al usuario.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, borrar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(formId).submit();
        }
    });
}
</script>

</body>
</html>