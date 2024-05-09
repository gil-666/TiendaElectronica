<?php
    require 'database.php';
    require 'includes/header.php';
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    // Check if session is already active
    if(isset($_SESSION['idUsuario'])) {
        header("location: index.php");
        exit(); // Make sure to exit after redirection
    }
    if (isset($_SESSION['message'])) {
        echo '<div class="text-center alert alert-success" role="alert">' . $_SESSION['message'] . '</div>';
        unset($_SESSION['message']); // limpia la variable para que no vuelva a aparecer
    }
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $correo = $_POST['correo'];
        $password = $_POST['password'];

        // SQL query to check if the user exists in the database
        $query = "SELECT * FROM usuario WHERE Correo = :correo AND Password = :password";
        
        // Prepare the statement
        $stmt = $conn->prepare($query);
        
        // Bind parameters
        $stmt->bindParam(":correo", $correo);
        $stmt->bindParam(":password", $password);
        
        // Execute the statement
        $stmt->execute();
        
        // Check if the user exists
        if($stmt->rowCount() == 1) {
            // Fetch user details
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Store user details in session
            $_SESSION['idUsuario'] = $row['idUsuario'];
            $_SESSION['Nombre'] = $row['Nombre'];
            $_SESSION['Tipo'] = $row['Tipo'];
            $_SESSION['Carrera'] = $row['Carrera'];
            $_SESSION['Semestre'] = $row['Semestre'];
            $_SESSION['Correo'] = $row['Correo'];
            $_SESSION['Telefono'] = $row['Telefono'];
            $_SESSION['Direccion'] = $row['Direccion'];

            // Set cookie
            setcookie("idUsuario", $row['idUsuario'], time() + (86400 * 30), "/"); // 30 days

            // Redirect to dashboard or any other page
            header("location: articulos.php");
            
        } else {
            echo '<div class="text-center alert alert-danger" role="alert">
                Correo o contraseña incorrecta!
                </div>';
             
            
        }
    }
?>

<html>
    <div class="container ">
        <div class="row accecolora" style="padding: 30px;">
            <h1>Iniciar sesión</h1>
            <form action="login.php" method="post">
                <br>
                <div class="form-group">
                    <label for="correo">Correo electrónico</label>
                    <input type="email" class="form-control" name="correo" id="correo" aria-describedby="emailHelp" placeholder="Ingresa tu Email">
                    <!-- <small id="emailHelp" class="form-text text-muted">No compartas esta información con nadie</small> -->
                </div><br>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                </div>
                <!-- <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div> -->
                <br>
                <button type="submit" class="btn btn-primary hover" style="background-color: rgb(114, 75, 124); border-color: blueviolet;">Submit</button>
            </form>
            <p class="form-text text-muted">No tienes una cuenta? <a href="registro.php">Registrate</a></p>
        </div>
    
        
    </div>
    <?php
include "includes/footer.php";
?>