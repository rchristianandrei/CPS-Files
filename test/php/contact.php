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
            <span class="form">
                <form action="https://formspree.io/f/xdobzbnk" method="POST" autocomplete="off">
                    <div><label for="contact_name">Name</label></div>
                    <div><input type="text" class="textbox" name="contact_name" id="contact_email" placeholder="Enter your name" required></div>
                    <div><label for="contact_email">Email</label></div>
                    <div><input type="text" class="textbox" name= "contact_email" id="contact_email" placeholder="email@address.com" required></div>
                    <div><label for="subject">Subject</label></div>
                    <div><input type="text" class="textbox" name= "subject" id="subject" placeholder="Provide context" value="<?php echo $subject; ?>"></div>
                    <div><label for="message">Message</label></div>
                    <div><textarea id="message" name="message" class="messagebox" rows="4" cols="50" placeholder="Write your question here" required></textarea></div>
                    <div style="display: flex; justify-content: space-between;"></div>
                    <center><div><input type="submit" class="messagebutton" value="Send a message"></div></center>
                </form>
            </span>
        </div>
    </main>
    <footer>
        <?php include '../templates/footer.php'; ?>
    </footer>
</body>
</html>