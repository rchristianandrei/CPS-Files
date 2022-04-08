<?php
    session_start();

    $subject = '';

    if(isset($_GET['subject'])){

        if($_GET['subject'] == 'forgotpassword')
            $subject = 'Forgot Password';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../templates/head.php'; ?>
    <link rel="stylesheet" type="text/css" href="../css/contact.css">
</head>
<body>
    <header>
        <?php include '../templates/header.php'; ?>
    </header>
    <main>
        <section class="title">
            <h2>Contact Us</h2>
        </section>
        <div class="formlayout">
        <img src="../images/contact/peninsula.jpg" alt="contact photo" class="contact_photo">
            <span class="form">
                <form action="https://formspree.io/f/xdobzbnk" method="POST" autocomplete="off">
                    <div><h2>Contact Us</h2></div>
                    <div><label for="contact_name">Full Name</label></div>
                    <div><input type="text" class="textbox" name="contact_name" id="contact_email" placeholder="Your Name" required></div>
                    <div><label for="contact_email">Email</label></div>
                    <div><input type="text" class="textbox" name= "contact_email" id="contact_email" placeholder="Your Email" required></div>
                    <div><label for="subject">Subject</label></div>
                    <div><input type="text" class="textbox" name= "subject" id="subject" placeholder="Your Subject" value="<?php echo $subject; ?>"></div>
                    <div><label for="message">Message</label></div>
                    <div><textarea id="message" name="message" class="messagebox" rows="4" cols="50" placeholder="Message" required></textarea></div>
                    <div style="display: flex; justify-content: space-between;"></div>
                    
                    <div>
                        <button style="margin-bottom: 20%" type="submit" class="messagebutton" value="Send a message">Send</button>
                    </div>
                    
                </form>
            </span>
        </div>
    </main>
    <footer>
        <?php include '../templates/footer.php'; ?>
    </footer>
</body>
</html>
