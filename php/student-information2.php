<?php
    session_start();

    if(!isset($_SESSION['login'])){
        session_abort();
        header('Location: index.php');
    }

    include '../config/connection.php';
    $message = $cs = $it = $cs = $it = $cpp = $csharp = $c = $java = $py = $js = $cisco = "";


    if(isset($_GET['id'])){
        initialInfo();
    }elseif(isset($_POST['submit'])){
        update();
    }elseif(isset($_POST['delete'])){
        delete();
    }

    mysqli_free_result($result);
    mysqli_close($connect);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "../templates/head.php"; ?>

    <link rel="stylesheet" href="../css/index.css">
        
</head>
<body>
    <header>
        <?php include "../templates/header.php"; ?>
    </header>
    <main>
        <div class="main">
            <h2>Profile</h2>
            <h3>Student Info</h3>
            <form action="student-information2.php" method="post">
                <div class="sub">
                    <div class="grid">
                        <span class="padding">
                            <caption><h4>Primary</h4></caption>
                            <div>
                                <label for="">Student ID: </label>
                                <span class="center right"><?php echo htmlspecialchars($data['id']); ?></span>
                            </div>
                            <div>
                                <label for="mail">E-mail: </label>
                                <input class="details"  type="text" name="mail" id="mail" value="<?php echo htmlspecialchars($data['email']); ?>">
                            </div>
                            <div>
                                <label for="fname">First Name: </label>
                                <input class="details"  type="text" name="fname" id="fname" value="<?php echo htmlspecialchars($data['first_name']); ?>">
                            </div>
                            <div>
                                <label for="mname">Middle Name: </label>
                                <input class="details"  type="text" name="mname" id="mname" value="<?php echo htmlspecialchars($data['middle_name']); ?>">
                            </div>
                            <div>
                                <label for="lname">Last Name: </label>
                                <input class="details"  type="text" name="lname" id="lname" value="<?php echo htmlspecialchars($data['last_name']); ?>">
                            </div>
                            <div>
                                <label for="suffix">Suffix: </label>
                                <input class="details"  type="text" name="suffix" id="suffix" value="<?php echo htmlspecialchars($data['suffix']); ?>">
                            </div>
                            <div>
                                <label for="">Sex: </label>
                                <span class="center right"><?php echo htmlspecialchars($data['sex']); ?></span>
                            </div>
                            <div>
                                <label for="">Date of Birth: </label>
                                <span class="center right"><?php echo htmlspecialchars($data['dob']); ?></span>
                            </div>

                            <hr>

                            <caption><h4>Carreer</h4></caption>
                            <div>
                                <label for="course">Course: </label>
                                <select class="details center select" name="course" id="course">
                                    <option value="CS" <?php echo htmlspecialchars($cs); ?>>CS</option>
                                    <option value="IT" <?php echo $it; ?>>IT</option>
                                </select>
                            </div>
                            <div>
                                <label for="yr">Year level: </label>
                                <input class="details"  type="text" name="yr" id="yr" value="<?php echo htmlspecialchars($data['year']); ?>">
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
                                <input class="details"  type="text" name="street" id="street" value="<?php echo htmlspecialchars($data['street']); ?>">
                            </div>
                            <div>
                                <label for="city">City: </label>
                                <input class="details"  type="text" name="city" id="city" value="<?php echo htmlspecialchars($data['city']); ?>">
                            </div>
                            <div>
                                <label for="postal">Postal Code: </label>
                                <input class="details"  type="text" name="postal" id="postal" value="<?php echo htmlspecialchars($data['postal']); ?>">
                            </div>
                            <div>
                                <label for="province">Province: </label>
                                <input class="details"  type="text" name="province" id="province" value="<?php echo htmlspecialchars($data['province']); ?>">
                            </div>
                            <div>
                                <label for="country">Country: </label>
                                <input class="details"  type="text" name="country" id="country" value="<?php echo htmlspecialchars($data['country']); ?>">
                            </div>
                            <div>
                                <label for="contact">Contact: </label>
                                <input class="details"  type="text" name="contact" id="contact" value="<?php echo htmlspecialchars($data['contact']); ?>">
                            </div>

                            <hr>

                            <div>
                                <label for="">Date Created: </label>
                                <span class="center right"><?php echo htmlspecialchars($data['created_at']); ?></span>
                            </div>
                            <div class="right">
                                <input type="checkbox" name="edit" id="edit">
                                <label for="edit">EDIT</label>
                            </div>
                            <div>
                                <input class="details"  type="hidden" name="student_id" id="id" value="<?php echo htmlspecialchars($data['id']); ?>">
                            </div>
                        </span>
                    </div>
                    <div class="message" style="color: <?php if($message == "Update success"){echo 'green';}else{
                        echo 'red';
                    } ?>"><?php echo htmlspecialchars($message); ?></div>
                    <div class="buttons">
                        <button class="submit" name="submit" id="submit">Update</button>
                        <button class="delete" name="delete" id="delete">Delete</button>
                    </div>
                    <script src="../js/view_student.js"></script>
                </div>
            </form>
        </div>
    </main>
    <footer>
        <?php include "../templates/footer.php"; ?>
    </footer>
</body>
</html>
<?php
    function initialInfo(){
        global $result, $message , $connect, $data, $cs, $it, $cpp, $csharp, $c, $java, $py, $js, $cisco;

        $id = mysqli_real_escape_string($connect, $_GET['id']);
        $sql = "SELECT * FROM students WHERE id = '$id'";
        $result = mysqli_query($connect, $sql);

        if(mysqli_num_rows($result) == 1){

            $data = mysqli_fetch_assoc($result);

            if($data['course'] == "CS"){
                $cs = 'selected="selected"';
            }else{
                $it = 'selected="selected"';
            }

            $skills = explode(', ', $data['skills']);
    
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
            }
        }else{
            $message = "student not found";
        }

        
    }
    function update(){
        global $result, $data, $connect, $cs, $it, $cpp, $csharp, $c, $java, $py, $js, $cisco, $message;

        $statement = '';

        $id = mysqli_real_escape_string($connect, $_POST['student_id']);
        $mail = mysqli_real_escape_string($connect, $_POST['mail']);
        $firstName = mysqli_real_escape_string($connect, $_POST['fname']);
        $midName = mysqli_real_escape_string($connect, $_POST['mname']);
        $lastName = mysqli_real_escape_string($connect, $_POST['lname']);
        $suffix = mysqli_real_escape_string($connect, $_POST['suffix']);
        $street = mysqli_real_escape_string($connect, $_POST['street']);
        $city = mysqli_real_escape_string($connect, $_POST['city']);
        $province = mysqli_real_escape_string($connect, $_POST['province']);
        $postal = mysqli_real_escape_string($connect, $_POST['postal']);
        $country = mysqli_real_escape_string($connect, $_POST['country']);
        $contact = mysqli_real_escape_string($connect, $_POST['contact']);
        $course = mysqli_real_escape_string($connect, $_POST['course']);
        $yr = mysqli_real_escape_string($connect, $_POST['yr']);
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

        $sql = "UPDATE students SET 
            email = '$mail',
            first_name = '$firstName',
            middle_name = '$midName',
            last_name = '$lastName',
            suffix = '$suffix',
            street = '$street',
            city = '$city',
            province = '$province',
            postal = '$postal',
            country = '$country',
            contact = '$contact',
            course = '$course',
            year = '$yr',
            skills = '$statement'
            WHERE id = '$id'";

        if(mysqli_query($connect, $sql)){
            $message = "Update success";
        }else{
            $message = "Error " . mysqli_error($connect);
        }

        $sql = "SELECT * FROM students WHERE id = '$id'";
        $result = mysqli_query($connect, $sql);
        $data = mysqli_fetch_assoc($result);
    }
    function delete(){
        global $result, $data, $connect, $cs, $it, $cpp, $csharp, $c, $java, $py, $js, $cisco, $message;

        $id = mysqli_real_escape_string($connect, $_POST['student_id']);

        $sql = "DELETE FROM students WHERE id='$id'";

        try{
            mysqli_query($connect, $sql);
            echo "<script type=\"text/javascript\">window.close();</script>";
        }catch(Exception $e){
            $message = 'Message: ' . $e->getMessage();
        }

        $sql = "SELECT * FROM students WHERE id = '$id'";
        $result = mysqli_query($connect, $sql);
        $data = mysqli_fetch_assoc($result);

        if($data['course'] == "CS"){
            $cs = 'selected="selected"';
        }else{
            $it = 'selected="selected"';
        }

        $skills = explode(', ', $data['skills']);

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
        }
    }
?>