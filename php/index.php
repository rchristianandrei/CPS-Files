<?php

    $student_id = $error = '';

    if(isset($_POST['submit'])){
        // session_start();
        include '../templates/connection.php';

        //  Query
        $student_id = $_POST['student_id'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM student_login WHERE student_id = '$student_id' AND password = '$password'";

        $result = mysqli_query($connect, $sql);

        if(mysqli_num_rows($result) == 1)
        {
            header('Location: student_data.php');
        }else{
            $error = "Invalid ID or password";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include '../templates/head.php' ?>
        <link rel="stylesheet" type="text/css" href="../css/login.css">
    </head>
    <body>
        <header>
            <?php include '../templates/header.php' ?>
        </header>
        <main>
            <div class="formlayout">
                <img src="../images/homepage.png" alt="login photo" class="login_photo leftside">
                <span class="form">
                    <form action="../php/index.php" method="post">
                        <div><h2>Login</h2></div>
                        <div><label for="student_id">Student ID</label></div>
                        <div><input type="text" name="student_id" id="student_id" value="<?php echo htmlspecialchars($student_id); ?>" required></div>
                        <div><label for="password">Password</label></div>
                        <div><input type="password" name="password" id="password" required></div>
                        <div>
                            <a href="#">Forgot Password?</a>
                        </div>
                        <div style="color: red;"><?php echo $error; ?></div>
                        <center>
                            <div><input type="submit" name="submit" class="loginbutton" value="Login"></div>
                        </center>
                    </form>
                </span>
            </div>
        </main>
        <footer>
            <?php include '../templates/footer.php' ?>
        </footer>
    </body>
</html>