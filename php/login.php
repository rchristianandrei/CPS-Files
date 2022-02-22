<?php
    //  Connect to databse
    $connect = mysqli_connect('localhost', 'root', '', 'cps');

    //  Check Connection

    if(!$connect){
        echo 'Connection Eror: ' . mysqli_connect_error();
    }

    //  Query
    $student_id = $_POST['student_id'];
    $password = $_POST['password'];

    $sql = 'select * from student_login where student_id = ' . $student_id;

    $result = mysqli_query($connect, $sql);

    // Get multiple results for showing in table
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // header('Location: student_data.html');
?>