<?php
        require 'database.php';
        require 'includes/header.php';
        if (isset($_SESSION['message'])) {
            echo '<div class="text-center alert alert-danger" role="alert">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']); // limpia la variable para que no vuelva a aparecer
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener los datos del formulario
            $tipo = $_POST["tipo"];
            $numTarjeta = $_POST["num"];
            $caducidad = $_POST["caducidad"];
            $pin = $_POST["pin"];
            $idyo = $_SESSION["idUsuario"]; // Asumiendo que ya tienes la sesión iniciada
            if (!empty($tipo) && !empty($numTarjeta) && !empty($caducidad) && !empty($pin)&& !empty($idyo)){
            // Insertar la venta en la tabla
            $query = $conn->prepare("INSERT INTO metodopago (tipo,numTarjeta,caducidad,pin,Usuario_idUsuario) VALUES (?,?,?,?,?)");
            $query->execute([$tipo, $numTarjeta, $caducidad, $pin, $idyo]);
        
        
            // Redireccionar o mostrar un mensaje de éxito
            header("Location: cuenta.php");
            $_SESSION["message"] = "Se agregó el método de pago existosamente";
            }
            else{
                header("location: agregar_pago.php");
                $_SESSION["message"] = "Todos los campos son requeridos!";
                exit();
            }
        }
    
        ?>
        <div class="container">
    <br>
    <div class="row accecolora" style="padding: 30px;">
        <h1>Agregar método de pago</h1>
        <form action="agregar_pago.php" method="post" onsubmit="return validateForm()">
            <div class="form-group">
                <br>
                <label for="num">Número de tarjeta*</label>
                <input type="tel" maxlength="16" class="form-control" name="num" id="num" placeholder="Ingresa tu Número de tarjeta a 16 dígitos">
            </div><br>
            <!-- <div class="form-group">
                <label for="tipo">Tipo</label>
                <input type="text" class="form-control" name="tipo" id="tipo" placeholder="Ingresa tu Tipo">
            </div><br> -->
            <div class="form-group">
                <label for="tipo">Tipo de tarjeta*</label>
                <select class="form-control" name="tipo" id="tipo" placeholder="Ingresa tu Carrera">
                    <option value="VISACRE">Visa Crédito</option>
                    <option value="MASTERCRE">MasterCard Crédito</option>
                    <option value="VISADEB">Visa Débito</option>
                    <option value="MASTERDEB">MasterCard Débito</option>
                    <option value="UDG">Credencial Estudiantil</option>
                </select>
            </div><br>
            <div class="form-group">
                <label for="caducidad">Fecha de caducidad (Mes-Año)*</label>
                <input type="month" class="form-control" name="caducidad" id="caducidad" placeholder="Mes y año de caducidad">
            </div><br>
            <div class="form-group">
                <label for="pin">CVV*</label>
                <input type="tel" maxlength="3" class="form-control" name="pin" id="pin" placeholder="Ingresa el código de seguridad (CVV)">
            </div><br>
            <!-- <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div> -->
            <br>
            <button type="submit" class="btn btn-primary hover" style="background-color: rgb(114, 75, 124); border-color: blueviolet;">Submit</button>
        </form>
        <br>
        <p class="form-text text-danger">*Campos requeridos</p>
        <p class="form-text text-muted"><strong>Verifica que los datos sean correctos, Gracias.</strong></p>
    </div>
</div>
<script>
    function validateForm() {
        var num = document.getElementById("num").value;
        var pin = document.getElementById("pin").value;
        // Check if num contains only numbers
        if (!/^\d+$/.test(num)) {
            alert("El número de tarjeta solo puede contener números.");
            return false;
        }
        // Check if pin contains only numbers
        if (!/^\d+$/.test(pin)) {
            alert("El CVV solo puede contener números.");
            return false;
        }
        return true;
    }
</script>