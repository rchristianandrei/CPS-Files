<?php
    include 'include/connection.php';

    //  Query
    $student_id = $_POST['student_id'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM student_login WHERE student_id = '$student_id' AND password = '$password'";

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