<?php
include "includes/header.php";
if(isset($_SESSION['idUsuario'])) {
    header("location: articulos.php");
    exit(); // Make sure to exit after redirection
}
?>
<?php
include "includes/footer.php";
?>