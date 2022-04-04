<?php
    session_start();

    include '../config/admin.php';

    $form = $_GET['form'] ?? "student";
    $page = $_SERVER['PHP_SELF'] . "?form=" . $form;
    $time = time() + 600;
    $message = '';

    if($form == "student") StudentData();
    elseif($form == "parent") ParentData();
    elseif($form == "account") AccountData();
    else echo "<script>window.close();</script>";

    if(isset($_POST['submit'])){

        setcookie('submit', true, $time);

        if($form == "student"){

            // Primary
            setcookie('id', $_POST['id'], $time);
            setcookie('email', $_POST['email'], $time);
            setcookie('fname', $_POST['fname'], $time);
            setcookie('mname', $_POST['mname'], $time);
            setcookie('lname', $_POST['lname'], $time);
            setcookie('suffix', $_POST['suffix'], $time);
            setcookie('sex', $_POST['sex'], $time);
            setcookie('dob', $_POST['dob'], $time);

            // Career
            setcookie('course', $_POST['course'], $time);
            setcookie('yr', $_POST['yr'], $time);

            $statement = '';
            if(!empty($_POST['skills'])){

                $skills = $_POST['skills'];
        
                foreach($skills as $skill)
                    $statement .= $skill . ', ';

                $statement = substr($statement, 0, strlen($statement)-2);
            }
            else
                $statement = '';

            setcookie('statement', $statement, $time);

            // Address
            setcookie('city', $_POST['city'], $time);
            setcookie('province', $_POST['province'], $time);
            setcookie('postal', $_POST['postal'], $time);
            setcookie('country', $_POST['country'], $time);
            setcookie('contact', $_POST['contact'], $time);
        }
        elseif($form == "parent"){

            // Primary
            setcookie('id', $_POST['id'], $time);
            setcookie('pemail', $_POST['email'], $time);
            setcookie('pfname', $_POST['fname'], $time);
            setcookie('pmname', $_POST['mname'], $time);
            setcookie('plname', $_POST['lname'], $time);
            setcookie('psuffix', $_POST['suffix'], $time);
            setcookie('psex', $_POST['sex'], $time);
            setcookie('prel', $_POST['rel'], $time);

            // Address
            setcookie('city', $_POST['city'], $time);
            setcookie('province', $_POST['province'], $time);
            setcookie('postal', $_POST['postal'], $time);
            setcookie('country', $_POST['country'], $time);
            setcookie('contact', $_POST['contact'], $time);
        } 

        header("Location: ".$page);
    }
    
    if(isset($_COOKIE['submit'])){

        /*
            Still not working
        */
        setcookie('submit', false, $time);

        if($form == "student"){

            $sql = "INSERT INTO students VALUES('$id', '$email', '$sex', '$fname', '$mname', '$lname', '$suffix', '$dob', '$city', '$province', '$postal', '$country', '$contact', '$course', '$yr', '$statement', null)";
        }
        elseif($form == "parent"){

            $sql = "INSERT INTO parents VALUES(null, '$id', '$email', '$rel', '$sex', '$fname', '$mname', '$lname', '$suffix', '$city', '$province', '$postal', '$country', '$contact', null)";
        }

        try{
            mysqli_query($admin, $sql);
            $message = "Submit success";
        }catch(Exception $e){
            $message = 'Message: ' . $e->getMessage();  
        }
    }

    function StudentData(){
        global $sql, $data, $admin;
        global $male, $female, $cs, $it, $first, $second, $third, $fourth, $c, $cpp, $csharp, $java, $py, $js, $cisco;

        $id = $_GET['id'];

        $sql = "SELECT * FROM students WHERE id = '$id'";

        try{
            $result = mysqli_query($admin, $sql);
            $data = mysqli_fetch_assoc($result);
        }
        catch(Exception $e){
            $message = 'Message: ' . $e->getMessage();
        }

        if($data['sex'] == "Male") $male = 'selected="selected"';
        else $female = 'selected="selected"';

        if($data['course'] == "CS") $cs = 'selected="selected"';
        else $it = 'selected="selected"';

        if($data['year'] == "1st") $first = 'selected="selected"';
        elseif($data['year'] == "2nd") $second = 'selected="selected"';
        elseif($data['year'] == "3rd") $third = 'selected="selected"';
        else $fourth = 'selected="selected"';

        if($data['skills'] != null){
            
            $skills = explode(', ', $data['skills']);
            foreach($skills as $skill){
                if($skill == "C++")
                    $cpp = 'checked="checked"';
                elseif($skill == "C#")
                    $csharp = 'checked="checked"';
                elseif($skill == "C")
                    $c = 'checked="checked"';
                else if($skill == "Java")
                    $java = 'checked="checked"';
                elseif($skill == "Python")
                    $py = 'checked="checked"';
                elseif($skill == "JavaScript")
                    $js = 'checked="checked"';
                elseif($skill == "Cisco")
                    $cisco = 'checked="checked"';
            }
        }
    }

    function ParentData(){
        global $sql, $data, $admin;
        global $male, $female, $parent, $guardian;
        
        $student_id = $_GET['id'];

        $sql = "SELECT * FROM parents WHERE id = '$student_id'";

        try{
            $result = mysqli_query($admin, $sql);
            $data = mysqli_fetch_assoc($result);
        }
        catch(Exception $e){
            $message = 'Message: ' . $e->getMessage();
        }

        if($data['sex'] == "Male") $male = 'selected="selected"';
        else $female = 'selected="selected"';

        if($data['relationship'] == "Parent") $parent = 'selected="selected"';
        else $guardian = 'selected="selected"';
    }

    function AccountData(){
        global $sql, $sql2, $data, $data2, $admin;
        global $changepass, $running, $aadmin, $guest;

        $student_id = $_GET['id'];

        $sql = "SELECT * FROM accounts WHERE student_id = '$student_id'";
        $sql2 = "SELECT email FROM students WHERE id = '$student_id'";

        try{
            $result = mysqli_query($admin, $sql);
            $data = mysqli_fetch_assoc($result);
            $result = mysqli_query($admin, $sql2);
            $data2 = mysqli_fetch_assoc($result);
        }
        catch(Exception $e){
            $message = 'Message: ' . $e->getMessage();
        }

        if($data['authorization'] == "Admin") $aadmin = 'selected="selected"';
        else $guest = 'selected="selected"';

        if($data['status'] == "CHANGEPASS") $changepass = 'selected="selected"';
        else $running = 'selected="selected"';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../templates/head.php'; ?>
    <link rel="stylesheet" type="text/css" href="../css/add.css">
    <script src="../js/view.js"></script>
</head>
<body>
    <main>
        <section class="outer">
            <section class="buttons">
                <i class="fa-solid fa-pen-to-square" id="edit"></i>
                <i class="fa-solid fa-xmark" id="close"></i>
            </section>
            <h3 id="title">
                <?php
                  if($form == "student") echo "Student";
                  elseif($form == "parent") echo "Parent";
                  elseif($form == "event") echo "Event";
                  elseif($form == "account") echo "Account";
                ?>
                Form
            </h3>
            <section>
                <form action="<?php echo $page; ?>" method="post">
                    <section class="<?php if($form == "student" || $form == "parent") echo 'grid'; ?>">
                        <?php if($form == "student"): ?>
                            <section id="primary">
                                <h4>Primary</h4>
                                <div class="entry">
                                    <label for="">Student ID:</label>
                                    <input class="width" type="text" name="id" id="id" value="<?php echo htmlspecialchars($data['id']); ?>">
                                </div>
                                <div class="entry">
                                    <label for="">E-mail:</label>
                                    <input class="width" type="email" name="email" id="email" value="<?php echo htmlspecialchars($data['email']); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">First Name:</label>
                                    <input class="width" type="text" name="fname" id="fname" value="<?php echo htmlspecialchars($data['first_name']); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Midlle Name:</label>
                                    <input class="width" type="text" name="mname" id="mname" value="<?php echo htmlspecialchars($data['middle_name']); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Last Name:</label>
                                    <input class="width" type="text" name="lname" id="lname" value="<?php echo htmlspecialchars($data['last_name']); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Suffix:</label>
                                    <input class="width" type="text" name="suffix" id="suffix" value="<?php echo htmlspecialchars($data['suffix']); ?>">
                                </div>
                                <div class="entry">
                                    <label for="sex">Sex:</label>
                                    <select class="select" name="sex" id="sex">
                                        <option value="Male" <?php echo htmlspecialchars($male); ?>>Male</option>
                                        <option value="Female" <?php echo htmlspecialchars($female); ?>>Female</option>
                                    </select>
                                </div>
                                <div id="dobs">
                                    <div class="entry">
                                        <label for="dob">Date of Birth:</label>
                                        <input class="width" type="date" name="dob" id="dob" value="<?php echo htmlspecialchars($data['dob']); ?>" required>
                                    </div>
                                </div>

                                <br><br>

                                <div id="career">
                                    <h4>Career</h4>
                                    <div class="entry">
                                        <label for="">Course:</label>
                                        <select class="select" name="course" id="course">
                                            <option value="CS" <?php echo htmlspecialchars($cs); ?>>CS</option>
                                            <option value="IT" <?php echo htmlspecialchars($it); ?>>IT</option>
                                        </select>
                                    </div>
                                    <div class="entry">
                                        <label for="">Year:</label>
                                        <select class="select" name="yr" id="yr">
                                            <option value="1st" <?php echo htmlspecialchars($first); ?>>1st Year</option>
                                            <option value="2nd" <?php echo htmlspecialchars($second); ?>>2nd Year</option>
                                            <option value="3rd" <?php echo htmlspecialchars($third); ?>>3rd Year</option>
                                            <option value="4th" <?php echo htmlspecialchars($fourth); ?>>4th Year</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label>Skills</label>
                                    </div>
                                    <div class="skills">
                                        <div><input type="checkbox" name="skills[]" id="c" value="C" <?php echo htmlspecialchars($c); ?>><label for="c"> C</label></div>
                                        <div><input type="checkbox" name="skills[]" id="cpp" value="C++" <?php echo htmlspecialchars($cpp); ?>><label for="cpp"> C++</label></div>
                                        <div><input type="checkbox" name="skills[]" id="cs" value="C#" <?php echo htmlspecialchars($csharp); ?>><label for="cs"> C#</label></div>
                                        <div><input type="checkbox" name="skills[]" id="java" value="Java" <?php echo htmlspecialchars($java); ?>><label for="java"> Java</label></div>
                                        <div><input type="checkbox" name="skills[]" id="py" value="Python" <?php echo htmlspecialchars($py); ?>><label for="py"> Python</label></div>
                                        <div><input type="checkbox" name="skills[]" id="js" value="JavaScript" <?php echo htmlspecialchars($js); ?>><label for="js"> JavaScript</label></div>
                                        <div><input type="checkbox" name="skills[]" id="cisco" value="Cisco" <?php echo htmlspecialchars($cisco); ?>><label for="cisco"> Cisco</label></div>
                                    </div>
                                </div>
                            </section>
                            <section id="address">
                                <h4>Address</h4>
                                <div class="entry">
                                    <label for="">City:</label>
                                    <input class="width" type="text" name="city" id="city" value="<?php echo htmlspecialchars($data['city']); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Province:</label>
                                    <input class="width" type="text" name="province" id="province" value="<?php echo htmlspecialchars($data['province']); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Postal Code:</label>
                                    <input class="width" type="text" name="postal" id="postal" value="<?php echo htmlspecialchars($data['postal']); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Country:</label>
                                    <input class="width" type="text" name="country" id="country" value="<?php echo htmlspecialchars($data['country']); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Contact No:</label>
                                    <input class="width" type="text" name="contact" id="contact" value="<?php echo htmlspecialchars($data['contact']); ?>" required>
                                </div>
                                <br>
                                <div class="entry">
                                    <label for="">Date Created:</label>
                                    <span class="width"><?php echo htmlspecialchars($data['created_at']); ?></span>
                                </div>
                            </section>
                        <?php elseif($form == "parent"): ?>
                        <section id="primary">
                                <h4>Primary</h4>
                                <div class="entry">
                                    <label for="">Student ID:</label>
                                    <input class="width" type="text" name="id" id="id" value="<?php echo htmlspecialchars($data['student_id']); ?>">
                                </div>
                                <div class="entry">
                                    <label for="">E-mail:</label>
                                    <input class="width" type="email" name="email" id="email" value="<?php echo htmlspecialchars($data['email']); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">First Name:</label>
                                    <input class="width" type="text" name="fname" id="fname" value="<?php echo htmlspecialchars($data['first_name']); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Midlle Name:</label>
                                    <input class="width" type="text" name="mname" id="mname" value="<?php echo htmlspecialchars($data['middle_name']); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Last Name:</label>
                                    <input class="width" type="text" name="lname" id="lname" value="<?php echo htmlspecialchars($data['last_name']); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Suffix:</label>
                                    <input class="width" type="text" name="suffix" id="suffix" value="<?php echo htmlspecialchars($data['suffix']); ?>">
                                </div>
                                <div class="entry">
                                    <label for="sex">Sex:</label>
                                    <select class="select" name="sex" id="sex">
                                        <option value="Male" <?php echo htmlspecialchars($male); ?>>Male</option>
                                        <option value="Female" <?php echo htmlspecialchars($female); ?>>Female</option>
                                    </select>
                                </div>
                                <div id="relationship">
                                    <div class="entry">
                                        <label for="rel">Relationship:</label>
                                        <select class="select" name="rel" id="rel">
                                            <option value="Parent" <?php echo htmlspecialchars($parent); ?>>Parent</option>
                                            <option value="Guardian" <?php echo htmlspecialchars($guardian); ?>>Guardian</option>
                                        </select>
                                    </div>
                                </div>
                            </section>
                            <section id="address">
                                <h4>Address</h4>
                                <div class="entry">
                                    <label for="">City:</label>
                                    <input class="width" type="text" name="city" id="city" value="<?php echo htmlspecialchars($data['city']); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Province:</label>
                                    <input class="width" type="text" name="province" id="province" value="<?php echo htmlspecialchars($data['province']); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Postal Code:</label>
                                    <input class="width" type="text" name="postal" id="postal" value="<?php echo htmlspecialchars($data['postal']); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Country:</label>
                                    <input class="width" type="text" name="country" id="country" value="<?php echo htmlspecialchars($data['country']); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Contact No:</label>
                                    <input class="width" type="text" name="contact" id="contact" value="<?php echo htmlspecialchars($data['contact']); ?>" required>
                                </div>
                                <br>
                                <div class="entry">
                                    <label for="">Date Created:</label>
                                    <span class="width"><?php echo htmlspecialchars($data['created_at']); ?></span>
                                </div>
                            </section>
                        <?php elseif($form == "account"): ?>
                            <section>
                            <h4>Primary</h4>
                                <div class="entry single">
                                    <label for="">Student ID:</label>
                                    <input class="width" type="text" name="id" id="id" value="<?php echo htmlspecialchars($data['student_id']); ?>">
                                </div>
                                <div class="entry single">
                                    <label for="">E-mail:</label>
                                    <span class="width"><?php echo htmlspecialchars($data2['email']); ?></span>
                                </div>
                                <div id="relationship">
                                    <div class="entry single">
                                        <label for="rel">Authorization:</label>
                                        <select class="select" name="authorization" id="authorization">
                                            <option value="Admin" <?php echo $aadmin; ?>>Admin</option>
                                            <option value="Guest" <?php echo $guest; ?>>Guest</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="relationship">
                                    <div class="entry single">
                                        <label for="rel">Status:</label>
                                        <select class="select" name="status" id="status">
                                            <option value="RUNNING" <?php echo $running; ?>>RUNNING</option>
                                            <option value="CHANGEPASS" <?php echo $changepass; ?>>CHANGEPASS</option>
                                        </select>
                                    </div>
                                </div>
                            </section>
                        <?php endif; ?>
                    </section>
                    <div class="center"><?php echo $message; ?></div><br>
                    <div class="user" style="margin: 0 10%;">
                        <button class="submit" name="submit" id="submit">Update</button>
                        <button class="submit" style="background: red;" name="delete" id="delete">Delete</button>
                    </div>
                </form>
            </section>
        </section>
    </main>
</body>
</html>