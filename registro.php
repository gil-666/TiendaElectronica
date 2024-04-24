<?php
require 'database.php';
require 'includes/header.php';
if(isset($_SESSION['idUsuario'])) {
    header("location: index.php");
    exit(); // Make sure to exit after redirection
}
?>
<div class="container ">
        <br>
        <div class="row accecolora" style="padding: 30px;">
            <h1>Registro</h1>
            <form action="login.php" method="post">
                <br>
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
                    <label for="password">Confirmar Contraseña</label>
                    <input type="password" class="form-control" name="passwordconfirm" id="passwordconfirm" placeholder="">
                </div>
                <!-- <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div> -->
                <br>
                <button type="submit" class="btn btn-primary hover" style="background-color: rgb(114, 75, 124); border-color: blueviolet;">Submit</button>
            </form>
            <p class="form-text text-muted">ya tienes una cuenta? <a href="login.php">Inicia Sesión</a></p>
        </div>
    
        
    </div>