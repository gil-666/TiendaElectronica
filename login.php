<?php
        require 'database.php';
        require 'includes/header.php';
        ?>
<html>
    <div class="container ">
        <br>
        <div class="row accecolora" style="padding: 30px;">
            <h1>Iniciar sesión</h1>
            <form>
                <br>
                <div class="form-group">
                    <label for="correo">Correo electrónico</label>
                    <input type="email" class="form-control" id="correo" aria-describedby="emailHelp" placeholder="Ingresa tu Email">
                    <small id="emailHelp" class="form-text text-muted">No compartas esta información con nadie</small>
                </div><br>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" id="password" placeholder="Password">
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