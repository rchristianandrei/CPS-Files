<?php
    //  Connect to databse
    $admin = mysqli_connect('localhost', 'root', '', 'cps');

    //  Check Connection

    if(!$admin){
        echo 'Connection Eror: ' . mysqli_connect_error();
    }
?>