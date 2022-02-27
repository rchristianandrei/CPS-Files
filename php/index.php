<?php

    $student_id = $error = '';

    if(isset($_POST['submit'])){
        include 'templates/connection.php';

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
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="This is a website used ny CPS to update, manage, and delete data about students.">
        <title>CPS-Laguna</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../css/login.css">
    </head>
    <body>
        <header>
            <img src="../images/cps-logo.png" alt="cps logo" class="logo">
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Events</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </nav>
            <button><a href="index.html">Login</a></button>
        </header>
        <main>
            <div class="formlayout">
                <img src="../images/login-photo.JPG" alt="login photo" class="login_photo leftside">
                <span class="form">
                    <form action="../php/index.php" method="post">
                        <div><h2>Login</h2></div>
                        <div><label for="student_id">Student ID</label></div>
                        <div><input type="text" name="student_id" id="student_id" value="<?php echo $student_id; ?>" required></div>
                        <div><label for="password">Password</label></div>
                        <div><input type="password" name="password" id="password" required></div>
                        <div style="display: flex; justify-content: space-between;">
                            <span>
                                <input type="checkbox" name="remember_me" id="remember_me"><label for="remember_me"> Remember Me</label>
                            </span>
                            <span>
                                <a href="#">Forgot Password?</a>
                            </span>
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
            <div>
                <img src="../images/footer-logo.jpg" alt="cps logo" class="logo"> 
                <hr>
                <div style="display: flex;">
                    <span class="news">
                        <span>Subscribe to our newsletter</span>
                    </span>
                    <span class="about">
                        <section class="section">
                            <ul>
                                <caption>Site Map</caption>
                                <li><a href="#">Home</a></li>
                                <li><a href="#">About</a></li>
                                <li><a href="#">Events</a></li>
                                <li><a href="#">Contact Us</a></li>
                            </ul>
                        </section>
                        <section class="section">
                            <ul>
                                <caption>About</caption>
                                <li><a href="#">Our Story</a></li>
                                <li><a href="#">Benefits</a></li>
                                <li><a href="#">Team</a></li>
                                <li><a href="#">Carrers</a></li>
                            </ul>
                        </section>
                        <section class="section">
                            <ul>
                                <caption>Follow Us</caption>
                                <li><a href="#">Facebook</a></li>
                                <li><a href="#">Instagram</a></li>
                                <li><a href="#">Twitter</a></li>
                            </ul>
                        </section>
                    </span>
                </div>
                
                <div class="bottom">
                    <span class="rights">
                        © Computer Programming Society. All Rights Reserved.
                    </span>
                    <span class="terms">
                        <span style="margin-right: 40px;">
                            Terms & Condition
                        </span>
                        <span>
                            Privacy Policy
                        </span>
                    </span>
                </div>
            </div>
        </footer>
    </body>
</html>