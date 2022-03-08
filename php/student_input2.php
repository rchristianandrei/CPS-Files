<?php
    session_start();

    if(!isset($_SESSION['login'])){
        session_abort();
        header('Location: index.php');
    }

    include '../config/connection.php';
    $id = $mail = $firstName = $midName = $lastName = $suffix = $m = $f = $dob = '';
    $cs = $it = $first = $second = $third = $fourth =  $cpp = $csharp = $c = $java = $py = $js = $cisco = $data = '';
    $street = $city = $postal = $province = $country = $contact = '';
    $dateCreated = $message = '';

    if(isset($_POST['submit'])){
        $statement = '';

        $id = mysqli_real_escape_string($connect, $_POST['id']);
        $mail = mysqli_real_escape_string($connect, $_POST['mail']);
        $firstName = mysqli_real_escape_string($connect, $_POST['fname']);
        $midName = mysqli_real_escape_string($connect, $_POST['mname']);
        $lastName = mysqli_real_escape_string($connect, $_POST['lname']);
        $suffix = mysqli_real_escape_string($connect, $_POST['suffix']);
        $sex = mysqli_real_escape_string($connect, $_POST['sex']);
        $dob = mysqli_real_escape_string($connect, $_POST['dob']);

        $course = mysqli_real_escape_string($connect, $_POST['course']);
        $yr = mysqli_real_escape_string($connect, $_POST['yr']);

        $street = mysqli_real_escape_string($connect, $_POST['street']);
        $city = mysqli_real_escape_string($connect, $_POST['city']);
        $province = mysqli_real_escape_string($connect, $_POST['province']);
        $postal = mysqli_real_escape_string($connect, $_POST['postal']);
        $country = mysqli_real_escape_string($connect, $_POST['country']);
        $contact = mysqli_real_escape_string($connect, $_POST['contact']);

        if(!empty($_POST['skills'])){

            $skills = $_POST['skills'];
    
            foreach($skills as $skill){
                if($skill == "C++"){
                    $cpp = 'checked="checked"';
                }
                elseif($skill == "C#"){
                    $csharp = 'checked="checked"';
                }
                elseif($skill == "C"){
                    $c = 'checked="checked"';
                }
                else if($skill == "Java"){
                    $java = 'checked="checked"';
                }
                elseif($skill == "Python"){
                    $py = 'checked="checked"';
                }
                elseif($skill == "JavaScript"){
                    $js = 'checked="checked"';
                }
                elseif($skill == "Cisco"){
                    $cisco = 'checked="checked"';
                }
                $statement .= $skill . ', ';
            }
            $statement = substr($statement, 0, strlen($statement)-2);
        }else{
            $statement = '';
        }

        $sql = "INSERT INTO students VALUES('$id', '$mail', '$sex', '$firstName', '$midName', '$lastName', '$suffix', '$dob', '$street', '$city', '$province' , '$postal', '$country', '$contact', '$course', '$yr', '$statement', null)"; 

        try{
            mysqli_query($connect, $sql);
            $message = "Submit success";
        }catch(Exception $e){
            $message = 'Message: ' . $e->getMessage();
        }
        
        if($sex == "M"){
            $m = 'selected="selected"';
        }else{
            $f = 'selected="selected"';
        }

        if($course == "CS"){
            $cs = 'selected="selected"';
        }else{
            $it = 'selected="selected"';
        }

        if($yr == "2"){
            $second = 'selected="selected"';
        }elseif($yr == "3"){
            $third = 'selected="selected"';
        }elseif($yr == "4"){
            $fourth = 'selected="selected"';
        }else{
            $first = 'selected="selected"';
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
        #add, #student{
                opacity: 50%;
            }
    </style>
</head>
<body>
    <header>
        <?php include "../templates/header.php"; ?>
    </header>
    <main>
        <?php include '../templates/subheader_input.php'; ?>
        <div class="main">
            <h2>Profile</h2>
            <h3>Student Info</h3>
            <form action="student_input2.php" method="post">
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
                                <label for="dob">Date of Birth: </label>
                                <input class="details"  type="date" name="dob" id="dob" value="<?php echo htmlspecialchars($dob); ?>" required>
                            </div>

                            <hr>

                            <caption><h4>Carreer</h4></caption>
                            <div>
                                <label for="course">Course: </label>
                                <select class="details center select" name="course" id="course" required>
                                    <option value="CS" <?php echo htmlspecialchars($cs); ?>>CS</option>
                                    <option value="IT" <?php echo htmlspecialchars($it); ?>>IT</option>
                                </select>
                            </div>
                            <div>
                                <label for="yr">Year level: </label>
                                <select class="details center select" name="yr" id="yr" required>
                                    <option value="1" <?php echo htmlspecialchars($first); ?>>1st Year</option>
                                    <option value="2" <?php echo htmlspecialchars($second); ?>>2nd Year</option>
                                    <option value="3" <?php echo htmlspecialchars($third); ?>>3rd Year</option>
                                    <option value="4" <?php echo htmlspecialchars($fourth); ?>>4th Year</option>
                                </select>
                            </div>
                            <!-- Skills Checkbos -->
                            <div>
                                <label>Skills: </label>
                                <span class="center right">
                                    <input type="checkbox" name="skills[]" id="cpp" value="C++" <?php echo $cpp; ?>>
                                    <label for="cpp">C++</label>
                                </span>
                            </div>
                            <div>
                                <span>-</span>
                                <span class="center right">
                                    <input type="checkbox" name="skills[]" id="csharp" value="C#" <?php echo $csharp; ?>>
                                    <label for="csharp">C#</label>
                                </span>
                            </div>
                            <div>
                                <span>-</span>
                                <span class="center right">
                                    <input type="checkbox" name="skills[]" id="c" value="C" <?php echo $c; ?>>
                                    <label for="c">C</label>
                                </span>
                            </div>
                            <div>
                                <span>-</span>
                                <span class="center right">
                                    <input type="checkbox" name="skills[]" id="java" value="Java" <?php echo $java; ?>>
                                    <label for="java">Java</label>
                                </span>
                            </div>
                            <div>
                                <span>-</span>
                                <span class="center right">
                                    <input type="checkbox" name="skills[]" id="py" value="Python" <?php echo $py; ?>>
                                    <label for="py">Python</label>
                                </span>
                            </div>
                            <div>
                                <span>-</span>
                                <span class="center right">
                                    <input type="checkbox" name="skills[]" id="js" value="JavaScript" <?php echo $js; ?>>
                                    <label for="js">JavaScript</label>
                                </span>
                            </div>
                            <div>
                                <span>-</span>
                                <span class="center right">
                                    <input type="checkbox" name="skills[]" id="cisco" value="Cisco" <?php echo $cisco; ?>>
                                    <label for="cisco">Cisco</label>
                                </span>
                            </div>
                            <!-- End of checkbox -->
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

                            <hr>

                            <div>
                                <label for="">Date Created: </label>
                                <span class="center right"><?php echo htmlspecialchars($dateCreated); ?></span>
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