<?php
        require 'database.php';
        require 'includes/header.php';
        ?>
<main class="container text-center d-flex flex-column alto justify-content-center">
    

    <div class="row">
        
        <?php
        // Seleccionar todos los artículos de la tabla 'articulos'
        $query = $conn->query("SELECT * FROM articulos");

        // Verificar si hay artículos
        if ($query->rowCount() > 0) {
            // Recorrer los resultados y mostrarlos en tarjetas
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                echo '<article class="col-12 col-md-4 my-3">';
                echo '<div class="border border-white rounded-3 custom-card">';
                if (!empty($row['Fotografia'])) {
                    // Convertir el blob de la imagen en una URL de datos base64
                    $imagenBase64 = base64_encode($row['Fotografia']);
                    $imagenDataURL = 'data:image/png;base64,' . $imagenBase64;
                    
                    // Mostrar la imagen en la tarjeta
                    echo '<img src="' . $imagenDataURL . '" alt="Imagen del artículo" class="img-fluid">';
                } else {
                    echo '<p class="text-center">No hay imagen disponible</p>';
                }
                echo '<h2 class="mt-5 fw-bold">' . $row['Nombre'] . '</h2>';
                echo '<p class="font-monospace mt-3"><strong>Precio: $' . $row['Precio'] . '</strong></p>';
                echo '<p class="font-monospace mt-3"><strong>Estado: ' . $row['Estado'] . '</strong></p>';
                echo '<p class="mt-3">' . $row['Descripción'] . '</p>';
                echo '<a href="#" class="accecolora text-white d-block py-3 text-decoration-none">Acceder</a>';
                echo '</div>'; // Cerrar custom-card
                echo '</article>'; // Cerrar col-12 col-md-4
            }
        } else {
            echo '<p class="text-center">No hay artículos disponibles.</p>';
        }
        ?>
    </div> <!-- Cerrar row -->

    
</main> <!-- Cerrar container -->
