<?php
    //  Connect to databse
    $guest = mysqli_connect('localhost', 'guest', '123456', 'cps');

    //  Check Connection

    if(!$guest){
        echo 'Connection Eror: ' . mysqli_connect_error();
    }
?>