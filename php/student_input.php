<?php 
    
    session_start();

    if(!isset($_SESSION['login'])){
        session_abort();
        header('Location: index.php');
    }

    $message = $id = $mail = $sex = $firstName = $midName = $lastName = $suffix = $dob = $street = $city = $province = $postal = $country = $contact = $course = $male = $female = $cs = $it = '';

    if(isset($_POST['submit'])){
        
        include '../config/connection.php';

        // Get info from form
        $id = mysqli_real_escape_string($connect, $_POST['student_id']);
        $mail = mysqli_real_escape_string($connect, $_POST['email']);
        $sex = mysqli_real_escape_string($connect, $_POST['sex']);
        $firstName = mysqli_real_escape_string($connect, $_POST['first_name']);
        $midName = mysqli_real_escape_string($connect, $_POST['middle_name']);
        $lastName = mysqli_real_escape_string($connect, $_POST['last_name']);
        $suffix = mysqli_real_escape_string($connect, $_POST['suffix']);
        $dob = mysqli_real_escape_string($connect, $_POST['date_of_birth']);
        $street = mysqli_real_escape_string($connect, $_POST['street']);
        $city = mysqli_real_escape_string($connect, $_POST['city']);
        $province = mysqli_real_escape_string($connect, $_POST['province']);
        $postal = mysqli_real_escape_string($connect, $_POST['postal_code']);
        $country = mysqli_real_escape_string($connect, $_POST['country']);
        $contact = mysqli_real_escape_string($connect, $_POST['contact']);
        $course = mysqli_real_escape_string($connect, $_POST['course']);

        //  Retain radio info
        if($sex === "M"){
            $male = 'checked="checked"';
        }elseif($sex === "F"){
            $female = 'checked="checked"';
        }

        if($course === "CS"){
            $cs = 'checked="checked"';
        }elseif($course === "IT"){
            $it = 'checked="checked"';
        }

        // Check if student already exists
        $sql = "SELECT id FROM students WHERE id = '$id'";
        $result = mysqli_query($connect, $sql);

        if(mysqli_num_rows($result) == 1){

            $message = "Student already exist!";
            
        }else{
            // Insert info
            $sql = "INSERT INTO students VALUES ('$id', '$mail', '$sex', '$firstName', '$midName', '$lastName', '$suffix', '$dob', '$street', '$city', '$province', '$postal', '$country', '$contact', '$course', null, null)";

            // Check result
            if(mysqli_query($connect, $sql)){
                
                $message = "Success!";
                
            }else{
                $message = "error" . mysqli_error($connect);
            }
        }

        mysqli_free_result($result);
        mysqli_close($connect);
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../templates/head.php' ?>

    <link rel="stylesheet" type="text/css" href="../css/student_table_input.css">
    <link rel="stylesheet" type="text/css" href="../css/subheader.css">
    <style>
        #add, #student{
            opacity: 50%;
        }
    </style>
</head>
<body>
    <header>
        <?php include '../templates/header.php' ?>
        
    </header>
    <main>

        <?php include '../templates/subheader_input.php' ?>

        <form action="student_input.php" method="post">
            <center>
                <h2>Student</h2>
            </center>
            <div class="format">
                <span class="leftside">
                    <h3>Primary Information</h3>
                    <div>
                        <label for="student_id">Student ID: </label>
                        <input type="text" id="student_id" name="student_id" size="30" maxlength="10" placeholder="1234-12345" pattern="[1-9]{1}[0-9]{3}-[0-9]{5}" value="<?php echo htmlspecialchars($id); ?>" required>
                    </div>
                    <div>
                        <label for="email">E-mail: </label>
                        <input type="email" id="email" name="email" size="30" maxlength="30" placeholder="sonny@mail.com" value="<?php echo htmlspecialchars($mail); ?>" required>
                    </div>
                    <div>
                        <label for="sex">Sex: </label> 
                        <span>
                            <center>
                                <label for="m">Male</label>
                                <input style="float: none;" type="radio" id="m" name="sex" value="M" <?php echo htmlspecialchars($male) ?> required>
                                <label for="f">Female</label>
                                <input style="float: none;" type="radio" id="f" name="sex" value="F" <?php echo htmlspecialchars($female) ?> required>
                            </center>
                        </span>
                    </div>
                    <div>
                        <label for="first_name">First name: </label>
                        <input type="text" id="first_name" name="first_name" maxlength="30" size="30" placeholder="Sonny" value="<?php echo htmlspecialchars($firstName); ?>" required>
                    </div>
                    <div>
                        <label for="middle_name">Middle name: </label>
                        <input type="text" id="middle_name" name="middle_name" maxlength="15" placeholder="High" size="30" value="<?php echo htmlspecialchars($midName); ?>">
                    </div>
                    <div>
                        <label for="last_name">Last name: </label>
                        <input type="text" id="last_name" name="last_name" maxlength="20" size="30" placeholder="Noon" value="<?php echo htmlspecialchars($lastName); ?>" required>
                    </div>
                    <div>
                        <label for="suffix">Suffix: </label>
                        <input type="text" id="suffix" name="suffix" size="30" placeholder="IV" maxlength="4" value="<?php echo htmlspecialchars($suffix); ?>">
                    </div>
                    <div>
                        <label for="date_of_birth">Date of Birth: </label>
                        <input type="date" id="date_of_birth" name="date_of_birth" size="30" value="<?php echo htmlspecialchars($dob); ?>" required>
                    </div>
                    <div>
                        <label for="course">Course: </label> 
                        <span>
                            <center>
                                <label for="cs">CS</label>
                                <input style="float: none;" type="radio" id="cs" name="course" value="CS" <?php echo htmlspecialchars($cs) ?> required>
                                <label for="it">IT</label>
                                <input style="float: none;" type="radio" id="it" name="course" value="IT" <?php echo htmlspecialchars($it) ?> required>
                            </center>
                        </span>
                    </div>
                </span>
    
                <span class="rightside">
                    <h3>Address</h3>
                    <div>
                        <label for="street">Street: </label>
                        <input type="text" id="street" name="street" maxlength="40" size="30" placeholder="Texas St." value="<?php echo htmlspecialchars($street); ?>" required>
                    </div>
                    <div>
                        <label for="city">City: </label>
                        <input type="text" id="city" name="city" maxlength="20" size="30" placeholder="Luna City" value="<?php echo htmlspecialchars($city); ?>" required>
                    </div>
                    <div>
                        <label for="province">Province: </label>
                        <input type="text" id="province" name="province" maxlength="20" size="30" placeholder="Laguna" value="<?php echo htmlspecialchars($province); ?>" required>
                    </div>
                    <div>
                        <label for="postal_code">Postal Code: </label>
                        <input type="number" id="postal_code" name="postal_code" size="30" max="9999" placeholder="4027" value="<?php echo htmlspecialchars($postal); ?>" required>
                    </div>
                    <div>
                        <label for="country">Country: </label>
                        <input type="text" id="country" name="country" maxlength="15" size="30" placeholder="Philippines" value="<?php echo htmlspecialchars($country); ?>" required>
                    </div>
                    <div>
                        <label for="contact">Contact: </label>
                        <input type="tel" id="contact" name="contact" maxlength="11" size="30" placeholder="09*********" value="<?php echo htmlspecialchars($contact); ?>" required>
                    </div>
                </span>
            </div>
            <center>
                <div style="color: <?php if ($message === "Success!"){ echo 'green'; } else{ echo 'red'; } ?>; margin: 10px 0;"><?php echo htmlspecialchars($message); ?></div><br>
                <input type="submit" name="submit" class="button" value="Submit">
            </center>
        </form>
    </main>
    <footer>
        <?php include '../templates/footer.php' ?>
    </footer>
</body>
</html>