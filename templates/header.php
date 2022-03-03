<?php
    if(isset($_SESSION['login'])){
        $login = $_SESSION['login']['student_id'];
    }
?>
<a href="../php/homepage.php"><img src="../images/cps-logo.png" alt="cps logo" class="logo"></a>
<nav>
    <ul>
        <li><a href="../php/homepage.php" id = "home">Home</a></li>
        <li><a href="../php/students.php" id = "retrieve">Retrieve</a></li>
        <li><a href="../php/student_input.php" id = "add">Add Info</a></li>
        <li><a href="#">Events</a></li>
        <li><a href="#">Contact Us</a></li>
    </ul>
</nav>
<?php if(isset($login)): ?>
    <button id = "login"><a href="../php/logout.php"><?php echo $login; ?></a></button>
<?php else:?>
    <button id = "login"><a href="../php/index.php">Login</a></button>
<?php endif;?>