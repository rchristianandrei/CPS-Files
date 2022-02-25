<?php
    include 'templates/connection.php';

    //  Query
    $student_id = $_POST['student_id'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM student_login WHERE student_id = '$student_id' AND password = '$password'";

    $result = mysqli_query($connect, $sql);

    if(mysqli_num_rows($result) == 1)
    {
        header('Location: student_data.php');
    } 
?>