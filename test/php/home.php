<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../templates/head.php'; ?>
    <link rel="stylesheet" type="text/css" href="../css/homepage.css">
</head>
<body>
    <header>
        <?php include '../templates/header.php'; ?>
    </header>
    <main>
        <section class="title">
            <h2>Home</h2>
        </section>
        <section>

        </section>
        <div class="row">
        <div class="column">
            <h1 style="text-align: left;">Our Blog</h1><br>
            <h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
            dolore magna aliqua.</h2><br>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua.</p></div>
        <div class="column"><img src="../images/events.JPG" alt="login photo" class="login_photo leftside"></div>
        </div>
        <div class="row">
        <div class="column"><img src="../images/want.png" alt="login photo" class="login_photo leftside"></div>
        <div class="column">
            <h1 style="text-align: left;">Want to be part of CPS?</h1><br>
            <h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
            dolore magna aliqua.</h2><br>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua.</p><br>
                <div><input type="text" class="textbox" name= "contact_email" id="contact_email" placeholder="email@address.com"><button><a href="#">Send</a></button>
                </div>
                <br>
            <p><h6>By clicking "Send you accepting lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua.</h6></p>
            </div>
            </div>
        </div>
    </main>
    <footer>
        <?php include '../templates/footer.php'; ?>
    </footer>
</body>
</html>