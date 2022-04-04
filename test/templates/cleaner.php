<?php
    if(strpos($page, 'login.php') === false){

        if(isset($_SESSION['student_id']))
            unset($_SESSION['student_id']);

        if(isset($_SESSION['error']))
        unset($_SESSION['error']);
    }
?>