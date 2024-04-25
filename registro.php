<?php
require 'database.php';
require 'includes/header.php';
if(isset($_SESSION['idUsuario'])) {
    header("location: index.php");
    exit(); // Make sure to exit after redirection
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $nombre = $_POST['nombre'];
    $tipo = "cliente";
    $carrera = $_POST['carrera'];
    $semestre = $_POST['semestre'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $confirm_password = $_POST['passwordconfirm'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    if (!empty($nombre) && !empty($tipo) && !empty($carrera) && !empty($semestre) && !empty($correo) && !empty($password) && !empty($confirm_password) && !empty($telefono) && !empty($direccion)) {
        // Check if passwords match
        if ($password === $confirm_password) {
            // Prepare an SQL statement to insert data into the users table
            $sql = "INSERT INTO usuario (nombre, tipo, carrera, semestre, correo, password, telefono, direccion) VALUES (:nombre, :tipo, :carrera, :semestre, :correo, :password, :telefono, :direccion)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->bindParam(':carrera', $carrera);
            $stmt->bindParam(':semestre', $semestre);
            $stmt->bindParam(':correo', $correo);
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':direccion', $direccion);

            // Execute the prepared statement
            if ($stmt->execute()) {
                $message = 'Se creó el usuario';
            } else {
                $message = 'Hubo un error al crear la cuenta';
            }
        } else {
            $message = 'Las contraseñas no coinciden';
        }
    } else {
        $message = 'Todos los campos son requeridos';
    }
}

// Set the PDO object to null to close the connection
$conn = null;
?>

<div class="container">
    <br>
    <div class="row accecolora" style="padding: 30px;">
        <h1>Registro</h1>
        <form action="registro.php" method="post">
            <br>
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresa tu Nombre">
            </div><br>
            <!-- <div class="form-group">
                <label for="tipo">Tipo</label>
                <input type="text" class="form-control" name="tipo" id="tipo" placeholder="Ingresa tu Tipo">
            </div><br> -->
            <div class="form-group">
                <label for="carrera">Carrera</label>
                <input type="text" class="form-control" name="carrera" id="carrera" placeholder="Ingresa tu Carrera">
            </div><br>
            <div class="form-group">
                <label for="semestre">Semestre</label>
                <input type="text" class="form-control" name="semestre" id="semestre" placeholder="Ingresa tu Semestre">
            </div><br>
            <div class="form-group">
                <label for="correo">Correo electrónico</label>
                <input type="email" class="form-control" name="correo" id="correo" aria-describedby="emailHelp" placeholder="Ingresa tu Email">
                <small id="emailHelp" class="form-text text-muted">No compartas esta información con nadie</small>
            </div><br>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
            </div><br>
            <div class="form-group">
                <label for="passwordconfirm">Confirmar Contraseña</label>
                <input type="password" class="form-control" name="passwordconfirm" id="passwordconfirm" placeholder="">
            </div><br>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Ingresa tu Teléfono">
            </div><br>
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Ingresa tu Dirección">
            </div><br>
            <!-- <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div> -->
            <br>
            <button type="submit" class="btn btn-primary hover" style="background-color: rgb(114, 75, 124); border-color: blueviolet;">Submit</button>
        </form>
        <p class="form-text text-muted">¿Ya tienes una cuenta? <a href="login.php">Inicia Sesión</a></p>
    </div>
</div>
