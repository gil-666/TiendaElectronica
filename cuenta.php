<?php
require 'database.php';
include "includes/header.php";
$idyo = $_SESSION['idUsuario'];
$query = $conn->prepare("SELECT * FROM metodopago WHERE Usuario_idUsuario = ?"); 
$query->execute([$idyo]);
if (isset($_SESSION['message'])) {
    echo '<div class="text-center alert alert-success" role="alert">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']); // limpia la variable para que no vuelva a aparecer
}
        $querycompras = $conn->prepare("SELECT * FROM articulos JOIN venta ON articulos.idArticulos = venta.Articulos_idArticulos WHERE venta.Usuario_idUsuario = ?");
        // Ejecutar la consulta con el ID del artículo
        $querycompras->execute([$idyo]);
        // Obtener el resultado de la consulta
        

                                                               
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
    
    <div class="accecolora m-2 align-items-center"><!-- metodos de pago -->
        <br>
        <div class="text-center justify-content-md-center">
            <div class="col-sm"></div>
            <div class="col-sm">
            <h2>Metodos de pago</h2><br>
            </div>

        <a class="btn btn-primary hover"href="agregar_pago.php">Agregar metodo de pago</a>
        
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
    <div class="row accecolora m-2 align-items-center">
        <br>
        <div class="col-sm text-center">
            <br>
            <h2>Mis compras</h2><br>
            <div class="row m-5 ">
            <?php
            while ($compras = $querycompras->fetch(PDO::FETCH_ASSOC)){
                echo '<div class="card col-sm m-3 align-items-center">';
                if (!empty($compras['Fotografia'])) {
                    // Convertir el blob de la imagen en una URL de datos base64
                    $imagenBase64 = base64_encode($compras['Fotografia']);
                    $imagenDataURL = 'data:image/png;base64,' . $imagenBase64;
                    // Mostrar la imagen en la tarjeta
                    echo '<img src="' . $imagenDataURL . '" alt="Imagen del artículo" style="width: 75px; height: 75px; float: left; margin-right: 15px; margin-top: 5px; ">';
            } else {
                    echo '<p class="text-center">No hay imagen disponible</p>';
            }
            //encontrar el nombre del vendedor de cada articulo
            $querynomvendedor = $conn->prepare("SELECT usuario.Nombre FROM usuario JOIN articulos ON articulos.usuario_idVendedor = idUsuario WHERE articulos.idArticulos = ?");
            // Ejecutar la consulta con el ID del artículo
            $querynomvendedor->execute([$compras['idArticulos']]);
            $nomvendedor = $querynomvendedor->fetch(PDO::FETCH_ASSOC);
                echo '<h5 class="card-title">
                        '.$compras['Nombre'].'
                </h5>
                <p class="card-text">
                        '.$compras['Descripción'].'
                </p>
                <p class="card-text"><strong>Precio:
                                '.$compras['Precio'].'
                        </strong></p>
                <p class="card-text"><strong>Vendido por: </strong>
                        '.$nomvendedor['Nombre'].'
                </p>
            </div>';
            } ?>
            
        </div>
    </div>
    <br>
</div>
<?php
include "includes/footer.php";
?>