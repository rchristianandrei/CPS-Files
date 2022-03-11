<?php
    session_start();

    //  Check if logged in
    if(isset($_SESSION['login'])){
        header('Location: homepage.php');
    }

    //  Global Variables
    $_SESSION['page'] = "Login";
    $student_id = $error = '';

    //  Check if form was submitted
    if(isset($_POST['submit'])){

        //  Connections
        include '../config/guest.php';
        include '../config/admin.php';

        //  Query
        $student_id = $_POST['student_id'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM accounts WHERE student_id = '$student_id' AND password = '$password'";

        //  Get result
        $result = mysqli_query($guest, $sql);
        $_SESSION['login'] = mysqli_fetch_assoc($result);

        //  Check result
        if(mysqli_num_rows($result) == 1)
        {
            //  Decide which connection to use
            if($_SESSION['login']['authorization'] === "admin"){

                $_SESSION['conn'] = $admin;

            }else{

                $_SESSION['conn'] = $guest;

            }
            
            header('Location: students.php');
        }else{
            $error = "Invalid ID or password";
        }

        mysqli_free_result($result);
        mysqli_close($guest);
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include '../templates/head.php' ?>
        <link rel="stylesheet" type="text/css" href="../css/login.css">
        <style>
            #login{
                opacity: 50%;
            }
        </style>
    </head>
    <body>
        <main>
            <div class="formlayout">
                <img src="../images/homepage.png" alt="login photo" class="login_photo">
                <span class="form">
                    <form action="../php/index.php" method="post">
                        <div><h2>Login</h2></div>
                        <div><label for="student_id">Student ID</label></div>
                        <div><input type="text" name="student_id" id="student_id" value="<?php echo htmlspecialchars($student_id); ?>" size="50" maxlength="30"  required></div>
                        <div><label for="password">Password</label></div>
                        <div><input type="password" name="password" id="password" size="50" maxlength="30" required></div>
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
    </body>
</html>