<?php
session_start();
include("../inicio/conexiones/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $adminId = $_GET["id"];
    $eliminarSql = "DELETE FROM usuarios WHERE id = ?";
    $eliminarStmt = $conexion->prepare($eliminarSql);
    $eliminarStmt->bind_param("i", $adminId);
    $eliminarStmt->execute();

    if ($eliminarStmt->affected_rows > 0) {
        $_SESSION['mensaje_exitoso'] = "Administrador eliminado exitosamente.";
    } else {
        $_SESSION['mensaje_error'] = "Error al eliminar el administrador: " . $eliminarStmt->error;
    }

    $eliminarStmt->close();

    header("Location: index.php");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $contrasena = password_hash($_POST["contrasena"], PASSWORD_DEFAULT); 
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $rol = $_POST["rol"];
    if (empty($email) || empty($contrasena) || empty($nombre) || empty($apellido) || empty($rol)) {
        $_SESSION['mensaje_error'] = "Por favor, complete todos los campos.";
        header("Location: Administrador.php");
        exit;
    }
    $insertSql = "INSERT INTO usuarios (Email_Reg, Contrasena, Nombre_Reg, Apellido_Reg, Rol) VALUES (?, ?, ?, ?, ?)";
    $insertStmt = $conexion->prepare($insertSql);

    if ($insertStmt) {
        $insertStmt->bind_param("sssss", $email, $contrasena, $nombre, $apellido, $rol);

        if ($insertStmt->execute()) {
            $_SESSION['mensaje_exitoso'] = "¡Usuario agregado exitosamente!";
            header("Location: Administrador.php");
            exit;
        } else {
            $_SESSION['mensaje_error'] = "Error al agregar el usuario: " . $insertStmt->error;
        }

        $insertStmt->close();
    } else {
        $_SESSION['mensaje_error'] = "Error en la preparación de la consulta: " . $conexion->error;
    }
}
$sqlAdmin = "SELECT id, Email_Reg, Rol FROM usuarios WHERE Rol = 'administrador'";
$resultAdmin = $conexion->query($sqlAdmin);

$administradores = [];
if ($resultAdmin && $resultAdmin->num_rows > 0) {
    while ($row = $resultAdmin->fetch_assoc()) {
        $administradores[] = $row;
    }
}
$sqlUsuario = "SELECT id, Nombre_Reg, Rol FROM usuarios WHERE Rol = 'usuario'";
$resultUsuario = $conexion->query($sqlUsuario);

$usuarios = [];
if ($resultUsuario && $resultUsuario->num_rows > 0) {
    while ($row = $resultUsuario->fetch_assoc()) {
        $usuarios[] = $row;
    }
}
$conexion->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrativo</title>
    <link rel="shortcut icon" href="favicon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="./cssPanel/Panel.css">
    <link rel="icon" href="../img/Logo.png">
</head>
<body>
<center>

<div class="menu-btn" onclick="toggleNav()">&#9776;</div>
<div id="myMenu" class="menu">
<div class="search-container">
    <form id="searchForm">
        <i class="ri-search-line"></i>
        <input type="text" id="searchInput" placeholder="Buscar...">
        <button type="button" onclick="searchFolders()">Buscar</button>
    </form>
</div>
<center>
    <a href="javascript:void(0)" class="close-btn" onclick="toggleNav()">&times;</a>
    <a href="../TecEmpleo.php"><i class="ri-home-2-fill"></i>TecEmpleo</a>
    <a href="categoria/categorias.php"><i class="ri-layout-grid-fill"></i>Categoría</a>
    <li>
         <a href="../inicio/cerrar_sesion.php"><i class="ri-logout-box-line" style="color: #ffffff;"></i>Cerrar Sesión</a>
                        </li>
</div>
<center>
<div class="container mt-4">
    <h2 class="text-left text-primary">Bienvenido Administrador</h2>
    <a href="#" class="btn btn-custom btn-primary mb-2" data-toggle="modal" data-target="#agregarAdminModal">Agregar Admin</a>

<center>
<div class="modal fade" id="agregarAdminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Administrador</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="Administrador.php">
                    <div class="form-group">
                        <label for="email"><i class="ri-mail-settings-fill"></i> Email..</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="contrasena"><i class="ri-key-fill"></i> Contraseña..</label>
                        <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                    </div>
                    <div class="form-group">
                        <label for="nombre"><i class="ri-user-fill"></i> Nombre..</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido"><i class="ri-user-fill"></i> Apellido..</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" required>
                    </div>
                    <div class="form-group">
                        <label for="rol"><i class="ri-shield-user-fill"></i> Rol..</label>
                        <select class="form-control" id="rol" name="rol" required>
                            <option value="administrador">Administrador</option>
                            <option value="recursos_humanos">Recursos Humanos</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Agregar</button>
                </form>
            </div>
        </div>
    </div>
</div>

</div>
<center>
    <table class="table table-bordered rounded">
        <thead>
            <tr>
                <th>Administrador</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($administradores as $admin): ?>
    <tr>
        <td style="border: none;"><i class="ri-user-settings-line text-primary" style="font-size: 36px;"></i></td>
        <td><?php echo $admin['Email_Reg']; ?></td>
        <td>
            <?php 
            if ($admin['Rol'] == 'administrador') {
                echo 'Administrador';
            } elseif ($admin['Rol'] == 'recursos_humanos') {
                echo 'Recursos Humanos';
            } else {
                echo $admin['Rol']; 
            }
            ?>
        </td> 
        <td>
            <a href="Administrador.php?id=<?php echo $admin['id']; ?>" class="btn btn-danger">Eliminar</a>
        </td>
        <?php if (isset($_SESSION['mensaje_exitoso_admin']) && !empty($_SESSION['mensaje_exitoso_admin'])): ?>
            <div class="mensaje-exitoso"><?php echo $_SESSION['mensaje_exitoso_admin']; ?></div>
            <?php $_SESSION['mensaje_exitoso_admin'] = ""; ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['mensaje_error_admin']) && !empty($_SESSION['mensaje_error_admin'])): ?>
            <div class="mensaje-error"><?php echo $_SESSION['mensaje_error_admin']; ?></div>
            <?php $_SESSION['mensaje_error_admin'] = ""; ?>
        <?php endif; ?>
    </tr>
<?php endforeach; ?>


<center>
        </tbody>
    </table>
</div>
<div class="container mt-4">
    <h2 class="text-left text-primary">Usuarios</h2>

    <div class="table-responsive">
        <table class="table table-bordered rounded">
            <thead>
                <tr>
                    <th><i class="ri-user-star-fill"></i> Usuarios</th>
                    <th>Nombre</th>
                    <th>Rol</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td style="border: none;"><i class="ri-user-star-fill" text-primary" style="font-size: 36px;"></i></td>
                        <td><?php echo $usuario['Nombre_Reg']; ?></td>
                        <td><?php echo $usuario['Rol']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<center>
</div>
<script src="javascript/menu.js"></script>
</body>
</html>
