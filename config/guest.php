<?php
    //  Connect to databse
    $connect = mysqli_connect('localhost', 'guest', '123456', 'cps');

    //  Check Connection

    if(!$connect){
        echo 'Connection Eror: ' . mysqli_connect_error();
    }
?>