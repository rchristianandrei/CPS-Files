<?php
    session_start();
    $_SESSION['page'] = "Input";

    if(!isset($_SESSION['login'])){
        session_abort();
        header('Location: index.php');
    }

    include '../config/connection.php';
    $id = $mail = $firstName = $midName = $lastName = $suffix = $m = $f = $relate = $parent = $guardian = '';
    $street = $city = $postal = $province = $country = $contact = '';
    $message = '';

    if(isset($_POST['submit'])){
        $statement = '';

        $id = mysqli_real_escape_string($connect, $_POST['id']);
        $mail = mysqli_real_escape_string($connect, $_POST['mail']);
        $firstName = mysqli_real_escape_string($connect, $_POST['fname']);
        $midName = mysqli_real_escape_string($connect, $_POST['mname']);
        $lastName = mysqli_real_escape_string($connect, $_POST['lname']);
        $suffix = mysqli_real_escape_string($connect, $_POST['suffix']);
        $sex = mysqli_real_escape_string($connect, $_POST['sex']);
        $relate = mysqli_real_escape_string($connect, $_POST['relate']);

        $street = mysqli_real_escape_string($connect, $_POST['street']);
        $city = mysqli_real_escape_string($connect, $_POST['city']);
        $province = mysqli_real_escape_string($connect, $_POST['province']);
        $postal = mysqli_real_escape_string($connect, $_POST['postal']);
        $country = mysqli_real_escape_string($connect, $_POST['country']);
        $contact = mysqli_real_escape_string($connect, $_POST['contact']);

        $sql = "INSERT INTO parents VALUES(null, '$id', '$mail', '$relate', '$sex', '$firstName', '$midName', '$lastName', '$suffix', '$street', '$city', '$province' , '$postal', '$country', '$contact', null)"; 

        try{
            mysqli_query($connect, $sql);
            $message = "Submit success";
        }catch(Exception $e){
            $message = 'Message: ' . $e->getMessage() . " or student does not exist";
        }
        
        if($sex == "M"){
            $m = 'selected="selected"';
        }else{
            $f = 'selected="selected"';
        }

        if($relate == "Parent"){
            $parent = 'selected="selected"';
        }else{
            $guardian = 'selected="selected"';
        }

        mysqli_close($connect);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "../templates/head.php"; ?>

    <link rel="stylesheet" href="../css/index.css">
    <style>
        #add, #parent{
            opacity: 50%;
        }
    </style>
</head>
<body>
    <header class="header">
        <?php include "../templates/header.php"; ?>
    </header>
    <main>
        <?php include '../templates/subheader_input.php'; ?>
        <div class="main">
            <h2>Input</h2>
            <h3>Parent / Guardian Info</h3>
            <form action="parent_input2.php" method="post">
                <div class="sub">
                    <div class="grid">
                        <span class="padding">
                            <caption><h4>Primary</h4></caption>
                            <div>
                                <label for="id">Student ID: </label>
                                <input class="details"  type="text" name="id" id="id" maxlength="30" value="<?php echo htmlspecialchars($id); ?>" placeholder="1234-12345" pattern="[1-9]{1}[0-9]{3}-[0-9]{5}" required>
                            </div>
                            <div>
                                <label for="mail">E-mail: </label>
                                <input class="details"  type="text" name="mail" id="mail" maxlength="30" value="<?php echo htmlspecialchars($mail); ?>" placeholder="sonny@mail.com" required>
                            </div>
                            <div>
                                <label for="fname">First Name: </label>
                                <input class="details"  type="text" name="fname" id="fname" maxlength="30" value="<?php echo htmlspecialchars($firstName); ?>" placeholder="Sonny" required>
                            </div>
                            <div>
                                <label for="mname">Middle Name: </label>
                                <input class="details"  type="text" name="mname" id="mname" maxlength="15" value="<?php echo htmlspecialchars($midName); ?>" placeholder="High" required>
                            </div>
                            <div>
                                <label for="lname">Last Name: </label>
                                <input class="details"  type="text" name="lname" id="lname" maxlength="20" value="<?php echo htmlspecialchars($lastName); ?>" placeholder="Noon" required>
                            </div>
                            <div>
                                <label for="suffix">Suffix: </label>
                                <input class="details"  type="text" name="suffix" id="suffix" maxlength="4" value="<?php echo htmlspecialchars($suffix); ?>" placeholder="IV" required>
                            </div>
                            <div>
                                <label for="sex">Sex: </label>
                                <select class="details center select" name="sex" id="sex" required>
                                    <option value="M" <?php echo htmlspecialchars($m); ?>>Male</option>
                                    <option value="F" <?php echo htmlspecialchars($f); ?>>Female</option>
                                </select>
                            </div>
                            <div>
                                <label for="relate">Relationship: </label>
                                <select class="details center select" name="relate" id="relate" required>
                                    <option value="Parent" <?php echo htmlspecialchars($parent); ?>>Parent</option>
                                    <option value="Guardian" <?php echo htmlspecialchars($guardian); ?>>Guardian</option>
                                </select>
                            </div>
                        </span>
                        <span class="padding">
                            <caption><h4>Address</h4></caption>
                            <div>
                                <label for="street">Street: </label>
                                <input class="details"  type="text" name="street" id="street" maxlength="40" value="<?php echo htmlspecialchars($street); ?>" placeholder="Texas St." required>
                            </div>
                            <div>
                                <label for="city">City: </label>
                                <input class="details"  type="text" name="city" id="city" maxlength="20" value="<?php echo htmlspecialchars($city); ?>" placeholder="Luna City" required>
                            </div>
                            <div>
                                <label for="postal">Postal Code: </label>
                                <input class="details"  type="text" name="postal" id="postal" value="<?php echo htmlspecialchars($postal); ?>" placeholder="4027" pattern="[1-9]{1}[0-9]{3}" required>
                            </div>
                            <div>
                                <label for="province">Province: </label>
                                <input class="details"  type="text" name="province" id="province" maxlength="20" value="<?php echo htmlspecialchars($province); ?>" placeholder="Laguna" required>
                            </div>
                            <div>
                                <label for="country">Country: </label>
                                <input class="details"  type="text" name="country" id="country" maxlength="15" value="<?php echo htmlspecialchars($country); ?>" placeholder="Philippines" required>
                            </div>
                            <div>
                                <label for="contact">Contact: </label>
                                <input class="details"  type="text" name="contact" id="contact" maxlength="11" value="<?php echo htmlspecialchars($contact); ?>" pattern="[0]{1}[9]{1}[0-9]{9}" placeholder="09*********" required>
                            </div>
                        </span>
                    </div>
                    <div class="message" style="color: <?php if($message == "Submit success"){echo 'green';}else{
                        echo 'red';
                    } ?>"><?php echo htmlspecialchars($message); ?></div>
                    <div style="text-align: center;">
                        <button class="submit" name="submit" id="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <footer>
        <?php include "../templates/footer.php"; ?>
    </footer>
</body>
</html>