<?php
require 'database.php';
require 'includes/header.php';
// Verificar si se enviaron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se seleccionó un archivo de imagen
    if (isset($_FILES['fotografia']) && $_FILES['fotografia']['error'] === UPLOAD_ERR_OK) {
        // Recuperar los datos del formulario
        $nombre = $_POST['nombre'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        $estado = $_POST['estado'] ?? '';
        $precio = $_POST['precio'] ?? '';
        $vendedorid = "1" ?? '';

        // Recuperar la información del archivo de imagen
        $imagen_nombre = $_FILES['fotografia']['name'];
        $imagen_tipo = $_FILES['fotografia']['type'];
        $imagen_tamano = $_FILES['fotografia']['size'];
        $imagen_temporal = $_FILES['fotografia']['tmp_name'];

        // Leer el contenido del archivo de imagen
        $imagen_contenido = file_get_contents($imagen_temporal);

        // Preparar la consulta SQL para insertar el nuevo registro
        $query = "INSERT INTO articulos (Nombre, Descripción, Estado, Precio, Fotografia, usuario_idVendedor) VALUES (:nombre, :descripcion, :estado, :precio, :fotografia, :usuario_idVendedor)";
        $statement = $conn->prepare($query);

        // Vincular los parámetros con los valores recibidos del formulario
        $statement->bindParam(':nombre', $nombre);
        $statement->bindParam(':descripcion', $descripcion);
        $statement->bindParam(':estado', $estado);
        $statement->bindParam(':precio', $precio);
        $statement->bindParam(':fotografia', $imagen_contenido, PDO::PARAM_LOB);
        $statement->bindParam(':usuario_idVendedor', $vendedorid);
        // Ejecutar la consulta SQL
        if ($statement->execute()) {
            // Redirigir a una página de éxito o mostrar un mensaje de éxito
            header("Location: articulos.php");
            exit();
        } else {
            // Mostrar un mensaje de error si la inserción falla
            echo "Error al insertar el registro.";
        }
    } else {
        // Manejar el caso en que no se haya seleccionado ningún archivo
        echo "No se ha seleccionado ningún archivo de imagen.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Registro</title>
</head>
<body>
<div class="container ">
        <br>
        <div class="row accecolora text-center " style="padding: 30px;">
    <h2>Insertar Nuevo Artículo con Imagen</h2>
    <form action="nuevo.php" method="POST" enctype="multipart/form-data">
        <br><div class="row ">
            
            <div class="col-sm">
                <label for="nombre">Nombre:</label><br>
                <input type="text" id="nombre" name="nombre" required><br>
                <label for="descripcion">Descripción:</label><br>
                <textarea id="descripcion" name="descripcion" required></textarea><br>
                <label for="estado">Estado:</label><br>
                <input type="text" id="estado" name="estado" required><br>
                
            </div>
            <div class="col-sm">
                <label for="imagen">Imagen:</label><br>
                <input type="file" style="padding-left: 120px;" id="fotografia" name="fotografia" accept="image/*" required><br>
                <label style="padding-top: 80px;" for="precio">Precio ($):</label><br>
                <input type="number" id="precio" name="precio" step="1.00" placeholder="Ingresa tu precio aquí" required><br>
            </div>
        </div>
        
        <br><br>
        <button type="submit" class="btn btn-primary hover" style="background-color: rgb(114, 75, 124); border-color: blueviolet;">Insertar Artículo</button>
    </form>
</div>
</div>
</body>
</html>
