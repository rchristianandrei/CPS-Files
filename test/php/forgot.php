<?php
    session_start();

    if(isset($_SESSION['id'])){
        header("Location: home.php");
    }

    $page = $_SERVER['PHP_SELF'];
    $time = time() + 60;
    $student_id = $_COOKIE['student_id'] ?? '';
    $code = $_COOKIE['code'] ?? '';
    $pass = $_COOKIE['pass'] ?? '';
    $error = $_COOKIE['fmessage'] ?? '';
    $stage = $_COOKIE['stage'] ?? 'ID';

    setcookie('fmessage', '', $time);

    if(isset($_POST['submit'])){

        setcookie('submit', true, $time);

        if(isset($_POST['student_id'])){
            setcookie('student_id', $_POST['student_id'], $time);
        }

        if(isset($_POST['code'])){
            setcookie('code', $_POST['code'], $time);
        }

        if(isset($_POST['pass'])){
            setcookie('pass', $_POST['pass'], $time);
        }

        header('Location: '.$page);
    }

    if(isset($_COOKIE['submit'])){

        setcookie('submit', false, $time);

        include '../config/admin.php';

        $sql = "SELECT * FROM accounts WHERE student_id = '$student_id'";
        $result = mysqli_query($admin, $sql);
        $data = mysqli_fetch_assoc($result);

        if(mysqli_num_rows($result) == 1){   
            if($stage == "ID"){
                if($data['status'] == "CHANGEPASS"){
                    setcookie('stage', 'Code', $time);
                }
                else{
                    setcookie('fmessage', 'Changing password is not allowed', $time);
                }
            }
            elseif($stage == "Code"){
                if($data['code'] == $code){
                    setcookie('stage', 'Change', $time);
                }
                else{
                    setcookie('fmessage', 'Wrong Code', $time);
                }
            }
            elseif($stage == "Change"){
                $sql = "UPDATE accounts SET password = '$pass', status = 'RUNNING', code='0' WHERE student_id = '$student_id'";
                mysqli_query($admin, $sql);
                setcookie('stage', 'Done', $time);
            }
        }else{
            setcookie('fmessage', 'Error', $time);
        }

        header('Location: '.$page);

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
                        <div><h2>Forgot Password</h2></div>
                        <?php if($stage == "ID"): ?>
                        <div><label for="student_id">Student ID</label></div>
                        <div><input type="text" name="student_id" id="student_id" size="50" maxlength="30" required></div>
                        <?php elseif($stage == "Code"): ?>
                        <div><label for="code">Enter Code</label></div>
                        <div><input type="text" name="code" id="code" size="50" maxlength="4" required></div>
                        <?php elseif($stage == "Change"): ?>
                        <div><label for="pass">New Password</label></div>
                        <div><input type="password" name="pass" id="pass" size="50" maxlength="30" required></div>
                        <?php elseif($stage == "Done"): ?>
                        <div>Password Change Successfully</div>
                        <div><a href="login.php">Login</a></div>
                        <?php endif; ?>
                        <?php if($stage != "ID"): ?>
                        <div><input type="text" name="student_id" id="student_id" size="50" value="<?php echo htmlspecialchars($student_id); ?>" maxlength="30" hidden></div>
                        <?php endif; ?>
                        <div style="color: red;"><?php echo $error; ?></div>
                        <center>
                            <?php if($stage != "Done"): ?>
                            <div><input type="submit" name="submit" class="loginbutton" value="Submit"></div>
                            <?php endif; ?>
                        </center>
                    </form>
                </span>
            </div>
        </main>
    </body>
</html>