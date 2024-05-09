<?php
        require 'database.php';
        require 'includes/header.php';
        
        // if(!isset($_SESSION['idUsuario'])) {
        //     header("location: login.php");
        //     exit(); // Make sure to exit after redirection
        // }
        ?>
<main class="container text-center d-flex flex-column alto justify-content-center ">
    <style>
        /* Custom CSS for maintaining card height and adjusting content */
        .custom-card {
            height: 100%; /* Ensures all cards have the same height */
            display: flex; /* Use flexbox to control content layout */
            flex-direction: column; /* Arrange content vertically */
            justify-content: space-between; /* Space out content vertically */
            padding: 20px; /* Add padding to the card */
        }

        .custom-card-content {
            flex-grow: 1; /* Allow content area to grow and occupy remaining space */
        }

        .custom-card img {
            max-width: 100%; /* Ensure images don't exceed card width */
            height: auto; /* Maintain aspect ratio */
        }
    </style>
    <br>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
        <?php
        // Seleccionar todos los artículos de la tabla 'articulos'
        $query = $conn->query("SELECT * FROM articulos WHERE Estado = 'Disponible'");

        // Verificar si hay artículos
        if ($query->rowCount() > 0) {
            // Recorrer los resultados y mostrarlos en tarjetas
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                echo '<article class="col my-3">';
                echo '<div class="border border-white rounded-3 custom-card ">';
                if (!empty($row['Fotografia'])) {
                    // Convertir el blob de la imagen en una URL de datos base64
                    $imagenBase64 = base64_encode($row['Fotografia']);
                    $imagenDataURL = 'data:image/png;base64,' . $imagenBase64;
                    
                    // Mostrar la imagen en la tarjeta
                    echo '<img src="' . $imagenDataURL . '" alt="Imagen del artículo" class="img-fluid">';
                } else {
                    echo '<p class="text-center">No hay imagen disponible</p>';
                }
                echo '<div class="custom-card-content">';
                echo '<h2 class="mt-3 fw-bold">' . $row['Nombre'] . '</h2>';
                echo '<p class="font-monospace mt-2"><strong>Precio: $' . $row['Precio'] . '</strong></p>';
                echo '<p class="font-monospace mt-2"><strong>Estado: ' . $row['Estado'] . '</strong></p>';
                echo '<p class="mt-3">' . $row['Descripción'] . '</p>';
                echo '</div>'; // Cerrar custom-card-content
                echo '<a href="comprar.php?id=' . $row['idArticulos'] . '&precio=' . $row['Precio'] . '" class="accecolora text-white d-block py-3 mt-2 text-decoration-none">Comprar</a>';
              
                echo '<a href="#" class="accecolorb text-white d-block py-3 text-decoration-none">Agregar al carrito</a>';
                echo '</div>'; // Cerrar custom-card
                echo '</article>'; // Cerrar col
            }
        } else {
            echo '<p class="text-center">No hay artículos disponibles.</p>';
        }
        ?>
    </div> <!-- Cerrar row -->

</main>
