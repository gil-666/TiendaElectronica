<?php
    session_start();

    // Unset all of the session variables
    $_SESSION = array();

    // If the session is set, destroy the session
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-42000, '/');
    }

    // Destroy the session
    session_destroy();

    // Unset and destroy the cookie
    setcookie("idUsuario", "", time() - 3600, "/");

    // Redirect to the login page or any other page as needed
    header("location: index.php");
    exit();
?>
