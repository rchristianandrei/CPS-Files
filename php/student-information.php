<?php
    session_start();

    if(!isset($_SESSION['login'])){
        session_abort();
        header('Location: index.php');
    }

    //  Global Variables
    include '../config/connection.php';

    if(isset($_GET['id'])){
        
        $id = mysqli_real_escape_string($connect, $_GET['id']);

        $sql = "SELECT * FROM students WHERE id = '$id'";
        $result = mysqli_query($connect, $sql);
        $data = mysqli_fetch_assoc($result);

    }else{

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../templates/head.php' ?>

    <link rel="stylesheet" href="../css/view-info.css">
</head>
<body>
    <header>
        <?php include '../templates/header.php' ?>
    </header>
    <main>
        <div class="main">
            <h2>Profile</h2>
            <h3>Student Info</h3>
            <div class="sub">
                <div class="details">
                    <span>
                        <caption><h4>Primary</h4></caption>
                        <div>
                            <label>Student ID: </label><span><?php echo htmlspecialchars($data['id']); ?></span>
                        </div>
                        <div>
                            <label>E-mail: </label><span><?php echo htmlspecialchars($data['email']); ?></span>
                        </div>
                        <div>
                            <label>First Name: </label><span><?php echo htmlspecialchars($data['first_name']); ?></span>
                        </div>
                        <div>
                            <label>Middle Name: </label><span><?php echo htmlspecialchars($data['middle_name']); ?></span>
                        </div>
                        <div>
                            <label>Last Name: </label><span><?php echo htmlspecialchars($data['last_name']); ?></span>
                        </div>
                        <div>
                            <label>Suffix: </label><span><?php echo htmlspecialchars($data['suffix']); ?></span>
                        </div>
    
                        <hr>
    
                        <caption><h4>Career</h4></caption>
                        <div>
                            <label>Course: </label><span><?php echo htmlspecialchars($data['course']); ?></span>
                        </div>
                        <div>
                            <label>Skills: </label><span><?php echo htmlspecialchars($data['skills']); ?></span>
                        </div>
                    </span>
                    <span>
                        <caption><h4>Address</h4></caption>
                        <div>
                            <label>Street: </label><span><?php echo htmlspecialchars($data['street']); ?></span>
                        </div>
                        <div>
                            <label>City: </label><span><?php echo htmlspecialchars($data['city']); ?></span>
                        </div>
                        <div>
                            <label>Province: </label><span><?php echo htmlspecialchars($data['province']); ?></span>
                        </div>
                        <div>
                            <label>Postal Code: </label><span><?php echo htmlspecialchars($data['postal']); ?></span>
                        </div>
                        <div>
                            <label>Country: </label><span><?php echo htmlspecialchars($data['country']); ?></span>
                        </div>
                        <div>
                            <label>Contact: </label><span><?php echo htmlspecialchars($data['contact']); ?></span>
                        </div>
    
                        <hr>
    
                        <div>
                            <label>Date Created: </label><span><?php echo htmlspecialchars($data['created_at']); ?></span>
                        </div>
                    </span>
                </div>
                <center>
                    <form action="student-information.php" method="post">
                        <input class="edit" name="edit" value="Edit" type="submit">
                    </form>
                </center>
            </div>
        </div>
    </main>
    <footer>
        <?php include '../templates/footer.php' ?>
    </footer>
</body>
</html>