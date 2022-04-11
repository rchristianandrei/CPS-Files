<?php
    session_start();

    include '../config/admin.php';

    $page = $_SERVER['PHP_SELF'];

    $student_id = $_COOKIE['student_id'] ?? '';
    $pass = $_COOKIE['password'] ?? '';
    $message = '';
    $stage = $_GET['stage'] ?? 'student_id';
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
                <form action="<?php echo $page;?>" method="post" autocomplete="off">
                    <div><h2>Forgot Password</h2></div>
                    <div><label for="student_id">Student ID</label></div>
                    <div><input type="text" name="student_id" id="student_id" value="<?php echo htmlspecialchars($student_id); ?>" size="50" maxlength="30" placeholder="2020-xxxx" required></div>
                    <div style="color: red;"><?php echo $message; ?></div>
                    
                    <button style="margin-bottom: 20%" type="submit" name="submit" class="loginbutton" value="Submit">Submit</button>
                    </form>
                </span>
            </div>
        </main>
    </body>
</html>