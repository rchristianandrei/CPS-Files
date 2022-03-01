<?php
    //  Connect to databse
    $connect = mysqli_connect('localhost', 'root', '', 'cps');

    //  Check Connection

    if(!$connect){
        echo 'Connection Eror: ' . mysqli_connect_error();
    }
?>