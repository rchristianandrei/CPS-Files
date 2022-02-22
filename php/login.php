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

    $sql = "SELECT * FROM student_login WHERE student_id = '" . $student_id . "' AND password = '" . $password . "'";
    //  Query for student data
    //  $studentData = 'select * from student limit 10';

    $result = mysqli_query($connect, $sql);

    if(mysqli_num_rows($result) == 1)
    {
        echo "Login Successful!";
        header('Location: ../html/student_data.html');
    }
    else{
        echo "Login Failed..";
    }

    //  Get multiple results for showing in table
    //  $data = mysqli_fetch_all($result, MYSQLI_ASSOC); 
?>