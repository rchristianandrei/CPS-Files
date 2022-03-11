<?php
    if(isset($_SESSION['login'])){
        $login = $_SESSION['login']['student_id'];
        $isAdmin;
        if($_SESSION['login']['authorization'] === "admin"){
            $isAdmin = true;
        }else{
            $isAdmin = false;
        }
    }
?>
<a href="../php/homepage.php"><img src="../images/cps-logo.png" alt="cps logo" class="logo"></a>
<nav>
    <ul>
        <li><a href="../php/homepage.php" id = "home">Home</a></li>
        <?php if($isAdmin): ?>
            <li><a href="../php/students.php" id = "retrieve">Search</a></li>
            <li><a href="../php/student_input2.php" id = "add">Add Info</a></li>
        <?php endif; ?>
        <!-- <li><a href="../php/events2.php" id = "events">Events</a></li> -->
        <li><a href="#">Contact Us</a></li>
    </ul>
</nav>
<?php if(isset($login)): ?>
    <button id = "login" class="login"><a href="../php/logout.php"><?php echo $login; ?></a></button>
<?php else:?>
    <button id = "login" class="login"><a href="../php/index.php">Login</a></button>
<?php endif;?>