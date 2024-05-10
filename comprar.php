<?php
require 'database.php';
require 'includes/header.php';
if(!isset($_SESSION['idUsuario'])) {
        echo '<div class="text-center alert alert-danger" role="alert">
        Debes iniciar sesión para hacer eso!<br>
        <a href="login.php">Iniciar sesion</a><br>
        
      </div>
      <footer>
      <div class="text-center"><a class="btn btn-primary hover" href="index.php">Regresar a inicio</a></div>
        </footer>';
        exit(); // Make sure to exit after redirection
    }
if (isset($_GET['id'])) {
        // Recuperar el ID del artículo
        $idArticulo = $_GET['id'];
        $idyo = $_SESSION['idUsuario'];
        $idvendedor = "";
        $nombrevendedor = "";
        
        // Preparar la consulta SQL para obtener la información del artículo
        $query = $conn->prepare("SELECT * FROM articulos WHERE idArticulos = ?");
        // Ejecutar la consulta con el ID del artículo
        $query->execute([$idArticulo]);
        // Obtener el resultado de la consulta
        $producto = $query->fetch(PDO::FETCH_ASSOC);

        $query = $conn->prepare("SELECT usuario_idVendedor FROM articulos WHERE idArticulos = ?");
        // Ejecutar la consulta con el ID del artículo
        $query->execute([$idArticulo]);
        // Obtener el resultado de la consulta
        $idvendedor = $query->fetch(PDO::FETCH_ASSOC);

        $query = $conn->prepare("SELECT usuario.Nombre FROM usuario JOIN articulos ON articulos.usuario_idVendedor = idUsuario WHERE articulos.idArticulos = ?");
        // Ejecutar la consulta con el ID del artículo
        $query->execute([$idArticulo]);
        // Obtener el resultado de la consulta
        $nombrevendedor = $query->fetch(PDO::FETCH_ASSOC);

        // Verificar si se encontró el producto
        if ($producto) {
                // Mostrar la información del producto en la página
                ?>
<br>

<body>
        <div class="container">
                <div class="row">
                        <div class="col-md-6">
                                <div class="card">
                                        <div class="card-body">
                                                <!-- Mueve la imagen aquí -->
                                                <?php
                                                                if (!empty($producto['Fotografia'])) {
                                                                        // Convertir el blob de la imagen en una URL de datos base64
                                                                        $imagenBase64 = base64_encode($producto['Fotografia']);
                                                                        $imagenDataURL = 'data:image/png;base64,' . $imagenBase64;
                                                                        // Mostrar la imagen en la tarjeta
                                                                        echo '<img src="' . $imagenDataURL . '" alt="Imagen del artículo" style="width: 75px; height: 75px; float: left; margin-right: 15px; margin-top: 5px; ">';
                                                                } else {
                                                                        echo '<p class="text-center">No hay imagen disponible</p>';
                                                                }
                                                                ?>
                                                <!-- Fin de la imagen -->

                                                <!-- Detalles del producto -->
                                                <h5 class="card-title">
                                                        <?php echo $producto['Nombre']; ?>
                                                </h5>
                                                <p class="card-text">
                                                        <?php echo $producto['Descripción']; ?>
                                                </p>
                                                <p class="card-text"><strong>Precio:
                                                                $<?php echo $producto['Precio']; ?>
                                                        </strong></p>
                                                <p class="card-text"><strong>Vendido por: </strong>
                                                        <?php echo $nombrevendedor['Nombre']; ?>
                                                </p>

                                        </div>
                                </div>
                        </div>
                                                                    
                        <?php $query = $conn->prepare("SELECT * FROM metodopago WHERE Usuario_idUsuario = ?"); 
                                                                $query->execute([$idyo]);
                                                                ?>
                        <div class="col-md-6">
                                <div class="card">
                                        <div class="card-body">
                                                <h5 class="card-title">Seleccione el método de pago</h5>
                                                <form action="procesar_compra.php" method="post">
                                                        <input type="hidden" name="idArticulo"
                                                                value="<?php echo $idArticulo; ?>">
                                                        <input type="hidden" name="precio"
                                                                value="<?php echo $producto['Precio']; ?>">
                                                        <?php 

                    
                ?>
                                                        <?php if ($query->rowCount() > 0) { ?>
    <div class="form-group">
        <select name="metodoPago" id="metodoPago" class="form-control">
            <?php while ($row = $query->fetch(PDO::FETCH_ASSOC)) { 
                echo '<option value="', $row['idMetodoPago'], '">', $row['tipo'], ' - ', $row['numTarjeta'], '</option>'; 
            }?>
        </select>
    </div><br>
<?php } else { ?>
        <div class="text-center alert alert-danger" role="alert">
    <p class="font-monospace text-danger mt-2">No tienes métodos de pago! <a href="agregar_pago.php">Agrega uno.</a></p></div>
<?php } ?>

                                                        <?php if ($query->rowCount() > 0) { ?>
                                                        <button type="submit" class="btn btn-primary btn-block">Realizar
                                                                Compra</button>
                                                                <?php } ?>
                                                </form>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
        <!-- Agrega aquí tus enlaces a JavaScript si es necesario -->
        <script src="tu_script.js"></script>
</body>

</html>
<?php
        } else {
                // Si no se encontró el producto, mostrar un mensaje de error
                echo "<p>El producto no existe.</p>";
        }
} else {
        // Si no se proporciona el ID del artículo en la URL, redireccionar o mostrar un mensaje de error
        echo "<p>No se ha especificado el producto a comprar.</p>";
}
?>