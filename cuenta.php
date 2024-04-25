<?php
require 'database.php';
include "includes/header.php";
?>
<div class="container">
    <div class="row accecolora align-items-center">
        <div class="col-sm text-center">
                <img src="images/user.png" alt="" width="100px" height="100px"> 
                <h2>
                    <?php echo $_SESSION['Nombre'] ?>
                </h2><br>

        </div>
        <div class="col-sm text-center justify-content-center">
        <h5>Carrera: </h5>
                    <p>
                    <?php echo $_SESSION['Carrera'];?><br>
                    </p>
                <h5>Semestre: </h5>
                    <p>  
                    <?php echo $_SESSION['Semestre'];?>
                    </p>
        </div>
        <div class="col text-center justify-content-center">
        <h5>Correo: </h5>
                    <p>
                    <?php echo $_SESSION['Correo'];?>
                    </p>
                <h5>Teléfono: </h5>
                    <p>
                    <?php echo $_SESSION['Telefono'];?>    
                    </p>
                <h5>Dirección: </h5>
                    <p>
                    <?php echo $_SESSION['Direccion'];?>
                    </p>
        </div>
    </div>
    <br>
</div>
<?php
include "includes/footer.php";
?>