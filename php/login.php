<?php
    session_start();

    $page = $_SERVER['PHP_SELF'];

    $student_id = $_COOKIE['student_id'] ?? '';
    $pass = $_COOKIE['password'] ?? '';
    $error = '';

    if(isset($_POST['submit'])){

        $time = time() + 60;
        setcookie('student_id', $_POST['student_id'], $time);
        setcookie('password', $_POST['password'], $time);

        header('Location: ' . $page);
    }

    if(isset($_COOKIE['student_id'])){

        include '../config/admin.php';

        $sql = "SELECT * FROM accounts WHERE student_id = '$student_id' AND password = '$pass'";
        $result = mysqli_query($admin, $sql);
        $data = mysqli_fetch_assoc($result);

        if(mysqli_num_rows($result) == 1)
        {
            $id = $data['student_id'];
            $_SESSION['authorization'] = $data['authorization'];

            $sql = "SELECT * FROM students WHERE id = '$id'";
            $result = mysqli_query($admin, $sql);
            $data = mysqli_fetch_assoc($result);

            $_SESSION['id'] = $data['id'];
            $_SESSION['surname'] = $data['last_name'];
            header('Location: home.php');
        }else
            $error = "Invalid ID or password";

        mysqli_free_result($result);
        mysqli_close($admin);
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include '../templates/head.php' ?>
        <link rel="stylesheet" type="text/css" href="../css/login.css">
    </head>
    <body>
        <main>
            <div class="formlayout">
                <img src="../images/title.png" alt="login photo" class="login_photo">
                <span class="form">
                    <form action="<?php echo $page; ?>" method="post" autocomplete="off">
                        <div><h2>Log In</h2></div>
                        <div><label for="student_id">Student ID</label></div>
                        <div><input type="text" name="student_id" id="student_id" value="<?php echo htmlspecialchars($student_id); ?>" size="50" maxlength="30" placeholder="Username" required></div>
                        <div><label for="password">Password</label></div>
                        <div><input type="password" name="password" id="password" size="50" maxlength="30" placeholder="Password" required>
                        <i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>
                        </div>
                        
                        <div>
                            <a href="contact.php?subject=forgotpassword">Forgot Password?</a>
                        </div>
                        <div style="color: red;"><?php echo $error; ?></div>

                        <button style="margin-bottom: 20%" type="submit" name="submit" class="loginbutton" value="Log In">Log In</button>
                    </form>
                    <script>
                        const togglePassword = document.querySelector('#togglePassword');
                        const password = document.querySelector('#password');
                        
                        togglePassword.addEventListener('click', function (e) {
                            // toggle the type attribute
                            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                            password.setAttribute('type', type);
                            // toggle the eye slash icon
                            this.classList.toggle('fa-eye-slash');
                        });
                    </script>
                </span>
            </div>
        </main>
    </body>
</html>
