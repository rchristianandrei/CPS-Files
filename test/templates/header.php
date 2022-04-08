<section>
    <nav class="nav-bar">
        <a href="../php/home.php"><img class="logo" src="../images/cps-logo.png" alt="cps logo" title="CPS"></a>
       <?php if(isset($_SESSION['id'])): ?> 
            <section class="user"><span id="user"><?php echo $_SESSION['surname'].' (' . $_SESSION['id'].')'; ?></span><i class="fa-solid fa-bars menu-bar rotate" id="menu"></i></section>
        <?php else: ?>
            <a href="../php/login.php"><button class="login">Login</button></a>
        <?php endif; ?>
        <ul class="menu-items show">
            <li><a href="../php/profile.php">Profile</a></li>
            <?php if($_SESSION['authorization'] == 'Admin'): ?>
                <li><a href="../php/search.php" id="search">Search</a></li>
                <li><a href="../php/add.php">Add</a></li>
            <?php endif; ?>
            <li><a href="#">Events</a></li>
            <li><a href="#">Achievements</a></li>
            <li><a href="../php/contact.php">Contact Us</a></li>
            <li><a href="../php/about.php">About</a></li>
            <li><a href="../php/logout.php">Logout</a></li>
        </ul>
    </nav>
</section>