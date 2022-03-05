<?php
    session_start();

    if(!isset($_SESSION['login'])){
        session_abort();
        header('Location: index.php');
    }

    //  Global Variables
    include '../config/connection.php';
    $cs = $it = $cpp = $csharp = $c = $java = $py = $js = $cisco = '';

    if(isset($_GET['id'])){
        
        $id = mysqli_real_escape_string($connect, $_GET['id']);

        $sql = "SELECT * FROM students WHERE id = '$id'";
        $result = mysqli_query($connect, $sql);
        $data = mysqli_fetch_assoc($result);

        if($data['course'] === "CS"){
            $cs = 'checked="checked"';
        }elseif($data['course'] === "IT"){
            $it = 'checked="checked"';
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

    mysqli_free_result($result);
    mysqli_close($connect);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../templates/head.php' ?>

    <link rel="stylesheet" href="../css/view-info.css">
    
</head>
<body>
    <header>
        <?php include '../templates/header.php' ?>
    </header>
    <main>
        <div class="main">
            <h2>Profile</h2>
            <h3>Student Info</h3>
            <form action="student-information.php" method="post">
                <div class="sub">
                    <div class="details">
                        <span>
                            <caption><h4>Primary</h4></caption>
                            <div>
                                <label for="student_id">Student ID: </label>
                                <input type="text" id="student_id" name="student_id" size="30" value="<?php echo htmlspecialchars($data['id']); ?>" maxlength="10" pattern="[1-9]{1}[0-9]{3}-[0-9]{5}" required>
                            </div>
                            <div>
                                <label for="email">E-mail: </label>
                                <input type="email" id="email" name="email" size="30" maxlength="30" value="<?php echo htmlspecialchars($data['email']); ?>" required>
                            </div>
                            <div>
                                <label for="first_name">First name: </label>
                                <input type="text" id="first_name" name="first_name" maxlength="30" size="30" value="<?php echo htmlspecialchars($data['first_name']); ?>" required>
                            </div>
                            <div>
                                <label for="middle_name">Middle name: </label>
                                <input type="text" id="middle_name" name="middle_name" maxlength="15" size="30" value="<?php echo htmlspecialchars($data['middle_name']); ?>">
                            </div>
                            <div>
                                <label for="last_name">Last name: </label>
                                <input type="text" id="last_name" name="last_name" maxlength="20" size="30" value="<?php echo htmlspecialchars($data['last_name']); ?>" required>
                            </div>
                            <div>
                                <label for="suffix">Suffix: </label>
                                <input type="text" id="suffix" name="suffix" size="30" maxlength="4" value="<?php echo htmlspecialchars($data['suffix']); ?>">
                            </div>
                            <div>
                                <label>Sex: </label><span><?php echo htmlspecialchars($data['sex']); ?></span>
                            </div>
        
                            <hr>
        
                            <caption><h4>Career</h4></caption>
                            <div>
                                <label for="course">Course: </label> 
                                <span>
                                    <center>
                                        <label for="cs" id="csl">CS</label>
                                        <input style="float: none;" type="radio" id="cs" name="course" value="CS" <?php echo htmlspecialchars($cs) ?> required>
                                        <label for="it" id="itl">IT</label>
                                        <input style="float: none;" type="radio" id="it" name="course" value="IT" <?php echo htmlspecialchars($it) ?> required>
                                    </center>
                                </span>
                            </div>
                            <div class="skills">
                                <label>Skills: </label>
                                <ul>
                                    <li><input type="checkbox" name="skills[]" id="cpp" value="C++" <?php echo htmlspecialchars($cpp) ?>><label for="cpp" id="cppl"> C++</label></li>
                                    <li><input type="checkbox" name="skills[]" id="csharp" value="C#" <?php echo htmlspecialchars($csharp) ?>><label for="csharp" id="csharpl"> C#</label></li>
                                    <li><input type="checkbox" name="skills[]" id="c" value="C" <?php echo htmlspecialchars($c) ?>><label for="c" id="cl"> C</label></li>
                                    <li><input type="checkbox" name="skills[]" id="java" value="Java" <?php echo htmlspecialchars($java) ?>><label for="java" id="javal"> Java</label></li>
                                    <li><input type="checkbox" name="skills[]" id="py" value="Python" <?php echo htmlspecialchars($py) ?>><label for="py" id="pyl"> Python</label></li>
                                    <li><input type="checkbox" name="skills[]" id="js" value="JavaScript" <?php echo htmlspecialchars($js) ?>><label for="js" id="jsl">  JavaScript</label></li>
                                    <li><input type="checkbox" name="skills[]" id="cisco" value="Cisco" <?php echo htmlspecialchars($cisco) ?>><label for="cisco" id="ciscol"> Cisco</label></li>
                                </ul>
                            </div>
                        </span>
                        <span>
                            <caption><h4>Address</h4></caption>
                            <div>
                                <label for="street">Street: </label>
                                <input type="text" id="street" name="street" maxlength="40" size="30" value="<?php echo htmlspecialchars($data['street']); ?>" required>
                            </div>
                            <div>
                                <label for="city">City: </label>
                                <input type="text" id="city" name="city" maxlength="20" size="30" value="<?php echo htmlspecialchars($data['city']); ?>" required>
                            </div>
                            <div>
                                <label for="province">Province: </label>
                                <input type="text" id="province" name="province" maxlength="20" size="30" value="<?php echo htmlspecialchars($data['province']); ?>" required>
                            </div>
                            <div>
                                <label for="postal_code">Postal Code: </label>
                                <input type="number" id="postal_code" name="postal_code" size="30" max="9999" value="<?php echo htmlspecialchars($data['postal']); ?>" required>
                            </div>
                            <div>
                                <label for="country">Country: </label>
                                <input type="text" id="country" name="country" maxlength="15" size="30" value="<?php echo htmlspecialchars($data['country']); ?>" required>
                            </div>
                            <div>
                                <label for="contact">Contact: </label>
                                <input type="tel" id="contact" name="contact" maxlength="11" size="30" value="<?php echo htmlspecialchars($data['contact']); ?>" required>
                            </div>
        
                            <hr>
        
                            <div>
                                <label>Date Created: </label><span><?php echo htmlspecialchars($data['created_at']); ?></span>
                            </div>
                            <div>
                                <label>Edit: </label><input type="checkbox" id="edit">
                            </div>
                        </span>
                    </div>
                    <center>
                        <button class="submit" id="submit">Save Changes</button>
                    </center>
                </div>
            </form>
            <script src = "../js/edit_student.js"></script>
        </div>
    </main>
    <footer>
        <?php include '../templates/footer.php' ?>
    </footer>
</body>
</html>