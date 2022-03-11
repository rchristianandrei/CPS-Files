<?php
    if(!isset($_SESSION['login'])){
        session_abort();
        header('Location: ../index/index.php');
    }
?>