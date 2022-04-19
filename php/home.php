<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../templates/head.php'; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="This is a website used ny CPS to update, manage, and delete data about students.">
    <title>CPS-Laguna</title>
    <link rel="stylesheet" type="text/css" href="../css/homepage.css">
    <script>
        function showAlert() {
            alert("Thanks for sending your email address, we will get back in touch with you soon.");
        }
    </script>
    <script src="https://kit.fontawesome.com/8070704d72.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <header>
        <?php include '../templates/header.php'; ?>
    </header>
    <main>
        <section class="title">
            <h2>Home</h2>
        </section>

       

        <!-- CPS -->
        <section id="CPSociety">
            <h1 style="text-align: center; padding-top: 30px">Our Exclusive Events</h1>
            <p style="text-align: center; padding-left:80px; padding-right:80px; padding-top: 10px">Information on past and upcoming events of CPS organization and School wide events will be placed here. Schedules
                of the upcoming Events will also be here for the CPS members, Officers and Admins to see.</p>
        </section>

        <div class="CPSociety">
            <h2 class="news-title"></h2>
            <div class="row">
                <div class="column">
                    <div class="ct-blog col-sm-6 col-md-4">
                        <div class="inner">
                            <div class="fauxcrop">
                                <a href="#"><img alt="News Entry" src="../images/competition.png"></a>
                            </div>
                            <div class="ct-blog-content">
                                <div class="ct-blog-date">
                                    <span>March</span><strong>1</strong>
                                </div>
                                <h3 class="ct-blog-header">
                                    Coding Challenges Let’s You into A Faster and Focused Transform Coder
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="ct-blog col-sm-6 col-md-4">
                        <div class="inner">
                            <div class="fauxcrop">
                                <a href="#"><img alt="News Entry" src="../images/webinar.png"></a>
                            </div>
                            <div class="ct-blog-content">
                                <div class="ct-blog-date">
                                    <span>February</span><strong>27</strong>
                                </div>
                                <h3 class="ct-blog-header">
                                    Digital Media, Technology and Society: A four-part series promoting media and information literacy
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="column">
                        <h1 style="text-align: left;">Our Blog</h1><br>
                        <h4>Computer Programming Society - Laguna warmly welcomes IT/CS Freshmen students for the SY 2020-2021. We, the officers of CPS, are hoping that you will participate and learn from us in the upcoming and exciting events of this organization. With the theme of Innovating Leaders Through Technology 2.0, we strive to work hard and give contribution to the institution and to the society. </h4><br>
                        <article>
                            <h4><a href="about.php">Need More Information?</a></h4>
                            <h6 class="lead">To know more about our organization, you may click the read more.</h6><br>
                            <a href="about.php" title="Title here">Read more...</a>
                        </article>
                    </div>
                    <div class="column"><img src="../images/blog.png" alt="login photo" class="login_photo leftside"></div>
                </div>
                <div class="row">
                    <div class="column"><img src="../images/want.png" alt="login photo" class="login_photo leftside"></div>
                    <div class="column">
                        <h1 style="text-align: left;">Want to be part of CPS?</h1><br>
                        <h4>Over the years, technology has revolutionized our world and daily lives. Additionally, technology for seniors has created amazing tools and resources, putting useful information at our fingertips.
                            Right now, technology related jobs has emerged as one of the high paying jobs both locally and globally!</h2><br>
                            <p>Do you want to be part of it?
                                Enroll Now and be part of LPU-Laguna and CPS family!
                                Learn Different. Live Different.
                                ENROLL NOW!</p><br>
                            <div><input type="text" class="textbox" name="contact_email" id="contact_email" placeholder="email@address.com"><button onclick="showAlert()" class="contactbutton">Send</button>
                            </div>
                            <br>
                            <p>
                            <h6>By clicking "Send" you accepting to create account to the application portal in the CPS Database. </h6>
                            </p>
                    </div>
                </div>
            </div>
    </main>
    <footer>
        <?php include '../templates/footer.php'; ?>
    </footer>
</body>

</html>