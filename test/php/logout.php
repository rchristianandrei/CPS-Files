<?php
    if(!isset($_SESSION['id'])){
        header("Location: home.php");
    }   
    session_start();
    session_unset();
    foreach ( $_COOKIE as $key => $value )
    {
        setcookie( $key, $value, time() - 3600);
    }
    session_destroy();
    session_abort();
    header('Location: login.php');
?>