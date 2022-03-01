<?php 

    if(isset($_POST['submit'])){
        include '../templates/connection.php';

        // Get info from form
        $id = $_POST['student_id'];
        $mail = $_POST['email'];
        $sex = $_POST['sex'];
        $firstName = $_POST['first_name'];
        $midName = $_POST['middle_name'];
        $lastName = $_POST['last_name'];
        $suffix = $_POST['suffix'];
        $dob = $_POST['date_of_birth'];
        $street = $_POST['street'];
        $city = $_POST['city'];
        $province = $_POST['province'];
        $postal = $_POST['postal_code'];
        $country = $_POST['country'];
        $contact = $_POST['contact'];
        $course = $_POST['course'];

        echo $id . '<br>';
        echo $mail . '<br>';
        echo $sex . '<br>';
        echo $firstName . '<br>';
        echo $midName . '<br>';
        echo $lastName . '<br>';
        echo $suffix . '<br>';
        echo $dob . '<br>';
        echo $street . '<br>';
        echo $city . '<br>';
        echo $province . '<br>';
        echo $postal . '<br>';
        echo $country . '<br>';
        echo $contact . '<br>';
        echo $course . '<br>';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../templates/head.php' ?>

    <link rel="stylesheet" type="text/css" href="../css/student_table_input.css">
    <link rel="stylesheet" type="text/css" href="../css/subheader.css">
</head>
<body>
    <header>
        <?php include '../templates/header.php' ?>
    </header>
    <main>
        <?php include '../templates/subheader.php' ?>

        <form action="input.php" method="post">
            <div class="format">
                <span class="leftside">
                    <h3>Primary Information</h3>
                    <div>
                        <label for="student_id">Student ID: </label>
                        <input type="text" id="student_id" name="student_id" size="30" maxlength="10" placeholder="1234-1234" pattern="[1-9]{1}[0-9]{3}-[0-9]{5}" required>
                    </div>
                    <div>
                        <label for="email">E-mail: </label>
                        <input type="email" id="email" name="email" size="30" maxlength="30" placeholder="sonny@mail.com" required>
                    </div>
                    <div>
                        <label>Sex: </label> 
                        <span class="radio">
                            <label for="m">M</label>
                            <input style="float: none;" type="radio" id="m" name="sex" value="M" required>
                            <label for="f">F</label>
                            <input style="float: none;" type="radio" id="f" name="sex" value="F" required>
                        </span>
                    </div>
                    
                    <div>
                        <label for="first_name">First name: </label>
                        <input type="text" id="first_name" name="first_name" maxlength="20" size="30" placeholder="Sonny" required>
                    </div>
                    <div>
                        <label for="middle_name">Middle name: </label>
                        <input type="text" id="middle_name" name="middle_name" maxlength="15" placeholder="High" size="30">
                    </div>
                    <div>
                        <label for="last_name">Last name: </label>
                        <input type="text" id="last_name" name="last_name" maxlength="20" size="30" placeholder="Noon" required>
                    </div>
                    <div>
                        <label for="suffix">Suffix: </label>
                        <input type="text" id="suffix" name="suffix" size="30" placeholder="IV" maxlength="4">
                    </div>
                    <div>
                        <label for="date_of_birth">Date of Birth: </label>
                        <input type="date" id="date_of_birth" name="date_of_birth" size="30" required>
                    </div>
                </span>
    
                <span class="rightside">
                    <h3>Address</h3>
                    <div>
                        <label for="street">Street: </label>
                        <input type="text" id="street" name="street" maxlength="40" size="30" placeholder="Texas St." required>
                    </div>
                    <div>
                        <label for="city">City: </label>
                        <input type="text" id="city" name="city" maxlength="20" size="30" placeholder="Luna City" required>
                    </div>
                    <div>
                        <label for="province">Province: </label>
                        <input type="text" id="province" name="province" maxlength="20" size="30" placeholder="Laguna" required>
                    </div>
                    <div>
                        <label for="postal_code">Postal Code: </label>
                        <input type="number" id="postal_code" name="postal_code" size="30" placeholder="4027" required>
                    </div>
                    <div>
                        <label for="country">Country: </label>
                        <input type="text" id="country" name="country" maxlength="15" size="30" placeholder="Philippines" required>
                    </div>
                    <div>
                        <label for="contact">Contact: </label>
                        <input type="tel" id="contact" name="contact" maxlength="11" size="30" placeholder="09*********" required>
                    </div>
                    <div>
                        <label for="cs"><i>Computer Science: </i></label>
                        <input type="radio" name="course" id="cs" value="CS" required>
                    </div>
                    <div>
                        <label for="it"><i>Information Technology: </i></label>
                        <input type="radio" name="course" id="it" value="IT" required>
                    </div>
                </span>
            </div>
            <center>
                <input type="submit" name="submit" class="loginbutton" value="Submit">
            </center>
        </form>
    </main>
    <footer>
        <?php include '../templates/footer.php' ?>
    </footer>
</body>
</html>