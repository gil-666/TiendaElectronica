<?php
require 'database.php';
require 'includes/header.php';
if(!isset($_SESSION['idUsuario'])) {
    header("location: login.php");
    exit(); // Make sure to exit after redirection
}
// Verificar si se enviaron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se seleccionó un archivo de imagen
    if (isset($_FILES['fotografia']) && $_FILES['fotografia']['error'] === UPLOAD_ERR_OK) {
        // Recuperar los datos del formulario
        $nombre = $_POST['nombre'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        $estado = $_POST['estado'] ?? '';
        $precio = $_POST['precio'] ?? '';
        $vendedorid = $_SESSION['idUsuario'];

        // Recuperar la información del archivo de imagen
        $imagen_nombre = $_FILES['fotografia']['name'];
        $imagen_tipo = $_FILES['fotografia']['type'];
        $imagen_tamano = $_FILES['fotografia']['size'];
        $imagen_temporal = $_FILES['fotografia']['tmp_name'];

        // Leer el contenido del archivo de imagen
        $imagen_contenido = file_get_contents($imagen_temporal);

        // Preparar la consulta SQL para insertar el nuevo registro
        $query = "INSERT INTO articulos (Nombre, Descripción, Estado, Precio, Stock, Fotografia, usuario_idVendedor) VALUES (:nombre, :descripcion, :estado, :precio, :stock, :fotografia, :usuario_idVendedor)";
        $statement = $conn->prepare($query);

        // Vincular los parámetros con los valores recibidos del formulario
        $statement->bindParam(':nombre', $nombre);
        $statement->bindParam(':descripcion', $descripcion);
        $statement->bindParam(':estado', 'Disponible');
        $statement->bindParam(':precio', $precio);
        $statement->bindParam(':stock', $stock);
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
    <title>Vender Artículo</title>
</head>
<body>
<div class="container ">
        <br>
        <div class="row accecolora text-center " style="padding: 30px;">
    <h2>Publicar nuevo artículo</h2>
    <form action="nuevo.php" method="POST" enctype="multipart/form-data">
        <br><div class="row ">
            
            <div class="col-sm">
                <label for="nombre">Nombre:</label><br>
                <input type="text" id="nombre" name="nombre" required><br>
                <label for="descripcion">Descripción:</label><br>
                <textarea id="descripcion" name="descripcion" required></textarea><br>
                <label for="stock">Stock:</label><br>
                <input type="number" min="1" max="999" id="estado" name="estado" required><br>
                <span><p class="text-form text-muted">Para publicar solo 1 artículo,<br> deja el campo vacío o escribe <strong>1</strong></p></span>
                <br>
            </div>
            <div class="col-sm">
                <label for="imagen">Imagen:</label><br>
                <input type="file" style="padding-left: 120px;" id="fotografia" name="fotografia" accept="image/*" required onchange="previewImage(event)"><br>
                <div class="image-preview-container" style="width: 250px; height: 200px; overflow: hidden; margin: 10px auto;">
                    <img id="preview" src="#" alt="Vista previa de la imagen" style="max-width: 100%; max-height: 100%; display: block; margin: auto;">
                </div>
                <label  for="precio">Precio ($):</label><br>
                <input type="number" id="precio" name="precio" step="1.00" placeholder="Ingresa tu precio aquí" required><br>
            </div>
        </div>
        
        <br><br>
        <button type="submit" class="btn btn-primary hover" style="background-color: rgb(114, 75, 124); border-color: blueviolet;">Insertar Artículo</button>
    </form>
</div>
</div>
<script>
    function previewImage(event) {
        var input = event.target;
        var preview = document.getElementById('preview');

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
</body>
</html>
<?php
include "includes/footer.php";
?>