<?php 

    $message = $id = $mail = $relate = $firstName = $midName = $lastName = $suffix = $street = $city = $province = $postal = $country = $contact = $parent = $guardian = $sex = $female = $male = '';

    if(isset($_POST['submit'])){
        
        include '../config/connection.php';

        // Get info from form
        $id = mysqli_real_escape_string($connect, $_POST['student_id']);
        $mail = mysqli_real_escape_string($connect, $_POST['email']);
        $relate = mysqli_real_escape_string($connect, $_POST['relationship']);
        $sex = mysqli_real_escape_string($connect, $_POST['sex']);
        $firstName = mysqli_real_escape_string($connect, $_POST['first_name']);
        $midName = mysqli_real_escape_string($connect, $_POST['middle_name']);
        $lastName = mysqli_real_escape_string($connect, $_POST['last_name']);
        $suffix = mysqli_real_escape_string($connect, $_POST['suffix']);
        $street = mysqli_real_escape_string($connect, $_POST['street']);
        $city = mysqli_real_escape_string($connect, $_POST['city']);
        $province = mysqli_real_escape_string($connect, $_POST['province']);
        $postal = mysqli_real_escape_string($connect, $_POST['postal_code']);
        $country = mysqli_real_escape_string($connect, $_POST['country']);
        $contact = mysqli_real_escape_string($connect, $_POST['contact']);

        //  Check radio input
        if($relate === "Parent"){
            $parent = 'checked="checked"';
        }elseif($relate === "Guardian"){
            $guardian = 'checked="checked"';
        }
        if($sex === "M"){
            $male = 'checked="checked"';
        }elseif($sex === "F"){
            $female = 'checked="checked"';
        }

        // Check if student exist
        $sql = "SELECT id FROM students WHERE id = '$id'";
        $result = mysqli_query($connect, $sql);

        // Set message for user
        if(mysqli_num_rows($result) == 1){
            
            $sql = "INSERT INTO parents VALUES (null, '$id', '$mail', '$relate', '$sex', '$firstName', '$midName', '$lastName', '$suffix', '$street', '$city', '$province', '$postal', '$country', '$contact', null)";

            if(mysqli_query($connect, $sql)){
                
                $message = "Success!";
                
            }else{
                $message = "error" . mysqli_error($connect);
            }
            
        }else{
            $message = "Student does not exist";
        }

        //  Free up space
        mysqli_free_result($result);

        // Close Connection
        mysqli_close($connect);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        include '../templates/head.php';
    ?>

    <link rel="stylesheet" type="text/css" href="../css/student_table_input.css">
    <link rel="stylesheet" type="text/css" href="../css/subheader.css">
    <style>
        #add, #parent{
            opacity: 50%;
        }
    </style>
</head>
<body>
    <header>
        <?php include '../templates/header.php'; ?>
    </header>
    <main>

        <?php include '../templates/subheader_input.php' ?>

        <form action="parent_input.php" method="post">
            <center>
                <h2>Parent / Guardian</h2>
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
                        <label>Relationship: </label> 
                        <span>
                            <center>
                                <label for="parent">Parent</label>
                                <input style="float: none;" type="radio" id="parent" name="relationship" value="Parent" <?php echo $parent;?> required>
                                <label for="guardian">Guardian</label>
                                <input style="float: none;" type="radio" id="guardian" name="relationship" value="Guardian" <?php echo $guardian; ?> required>
                            </center>
                        </span>
                    </div>
                    <div>
                        <label>Sex: </label> 
                        <span>
                            <center>
                                <label for="male">Male</label>
                                <input style="float: none;" type="radio" id="male" name="sex" value="M" <?php echo $male;?> required>
                                <label for="female">Female</label>
                                <input style="float: none;" type="radio" id="female" name="sex" value="F" <?php echo $female; ?> required>
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
        <?php 
            include '../templates/footer.php';
        ?>
    </footer>
</body>
</html>