<?php
require 'database.php';
include "includes/header.php";
$idyo = $_SESSION['idUsuario'];
$query = $conn->prepare("SELECT * FROM metodopago WHERE Usuario_idUsuario = ?"); 
$query->execute([$idyo]);

                                                               
?>
<div class="container">
    
    <div class="row accecolora align-items-center">
        <div style="margin:10px;" class="row">
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
        
    </div>
    <br>
    <div class="accecolora align-items-center">
        <br>
        <div class="row my-3 text-center">
        <h2>Metodos de pago</h2><br>
        </div>
        <div class="row p-3 justify-content-md-center">
        <?php if ($query->rowCount() > 0) {
            while($metodopago = $query->fetch(PDO::FETCH_ASSOC)){
                echo '<div style="margin:10px;" class="col col-lg-2 card "><div class="card-body text-center justify-content-center">
        <h5>Tipo: </h5>
                    <p>
                    '.$metodopago['tipo'].'
                    </p>
                <h5>Numero de tarjeta: </h5>
                    <p>
                    '.$metodopago['numTarjeta'].'
                    </p>
                <h5>Caducidad: </h5>
                    <p>
                    '.$metodopago['caducidad'].'
                    </p>
        </div></div>';
            }
        }
        ?>
        </div>
    </div>
</div>
<?php
include "includes/footer.php";
?>