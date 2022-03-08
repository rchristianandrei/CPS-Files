<?php

    session_start();
    $_SESSION['page'] = "Home";

    if(!isset($_SESSION['login'])){
        session_abort();
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../templates/head.php' ?>

    <link rel="stylesheet" type="text/css" href="../css/homepage.css">
    <script src="https://kit.fontawesome.com/8070704d72.js" crossorigin="anonymous"></script>
    <style>
        #home{
            opacity: 50%;
        }
    </style>
</head>
<body>
    <header>
        <?php include '../templates/header.php' ?>
    </header>
    <main>
        <div class="container" >
            <img src="../images/homepage.png" alt="Snow" style="width:100%;">
            <div class="centered">
                <h2>Home Page</h2><br>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ultrices eros in cursus turpis massa tincidunt dui ut. Viverra mauris in aliquam
                    sem fringilla ut morbi. Imperdiet dui accumsan sit amet. Mauris pharetra et ultrices neque.</p><br>
                    <div><button><a href="contact_us.html">Contact Us</a></button></div>
                </div>
          </div>

        <!-- CPS -->
        <section id="CPSociety">
            <h1 style="text-align: center;">Our Exclusive Events</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua.</p>
        </section>
          <div class="row">
            <div class="column">
                <h1 style="text-align: left;">Our Blog</h1><br>
                <h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua.</h2><br>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua.</p></div>
            <div class="column"><img src="../images/blog.png" alt="login photo" class="login_photo leftside"></div>
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
        <?php include '../templates/footer.php' ?>
    </footer>
</body>
</html>