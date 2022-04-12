<?php
    session_start();

    include '../config/admin.php';

    if(!isset($_SESSION['authorization']) || $_SESSION['authorization'] != 'Admin'){

        if($_GET['form'] != "parent" && ($_GET['id'] != $_SESSION['id']))
            header("Location: home.php");
    }

    if(!isset($_GET['form']) || !isset($_GET['id'])){

        header("Location: search.php");
    }

    $time = time() + 600;
    $student = "student";
    $pparent = "parent";
    $account = "account";
    $message = $_COOKIE['vmessage'] ?? '';
    setcookie('vmessage', '');

    $form = $_GET['form'] ?? $student;
    $page = $_SERVER['PHP_SELF'] . "?form=" . $form;

    if(isset($_GET['id'])){

        if($form == $student){
    
            $id = $_GET['id'];
            $male = $female = '';
            $cs = $it = '';
            $first = $second = $third = $fourth = '';
            $c = $cpp = $csharp = $java = $py = $js = $cisco = '';
    
            $sql = "SELECT * FROM students WHERE id = '$id'";
    
            try{
                $result = mysqli_query($admin, $sql);
                $data = mysqli_fetch_assoc($result);
            }
            catch(Exception $e){
                $message = 'Message: ' . $e->getMessage();
            }
    
            if(mysqli_num_rows($result) == 0)  
                echo "<script>window.close();</script>";
    
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
        elseif($form == $pparent){
            
            $male = $female = '';
            $parent = $guardian = '';

            $student_id = $_GET['id'];

            $sql = "SELECT * FROM parents WHERE id = '$student_id'";

            try{
                $result = mysqli_query($admin, $sql);
                $data = mysqli_fetch_assoc($result);
            }
            catch(Exception $e){
                $message = 'Message: ' . $e->getMessage();
            }

            if(mysqli_num_rows($result) == 0)  
                echo "<script>window.close();</script>";

            if($data['sex'] == "Male") $male = 'selected="selected"';
            else $female = 'selected="selected"';

            if($data['relationship'] == "Parent") $parent = 'selected="selected"';
            else $guardian = 'selected="selected"';

            if($_SESSION['id'] != $data['student_id'] && $_SESSION['authorization'] != "Admin"){
                echo "<script>window.close();</script>";
            }
        }
        elseif($form == $account){
            
            $aadmin = $guest = '';
            $running = $changepass = '';

            $student_id = $_GET['id'];

            $sql = "SELECT * FROM accounts WHERE student_id = '$student_id'";
            $sql2 = "SELECT email FROM students WHERE id = '$student_id'";

            try{
                $result = mysqli_query($admin, $sql);
                $data = mysqli_fetch_assoc($result);
                $result2 = mysqli_query($admin, $sql2);
                $data2 = mysqli_fetch_assoc($result2);
            }
            catch(Exception $e){
                $message = 'Message: ' . $e->getMessage();
            }

            if(mysqli_num_rows($result) == 0)  
                echo "<script>window.close();</script>";

            if($data['authorization'] == "Admin") $aadmin = 'selected="selected"';
            else $guest = 'selected="selected"';

            if($data['status'] == "CHANGEPASS") $changepass = 'selected="selected"';
            else $running = 'selected="selected"';
        }
        else echo "<script>window.close();</script>";
    }          

    if(isset($_POST['submit'])){

        setcookie('submit', true, $time);

        if($form == $student){

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
        elseif($form == $pparent){

            // Primary
            setcookie('parent_id', $_POST['parent_id'], $time);
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
        elseif($form == $account){
            
            setcookie('id', $_POST['id'], $time);
            setcookie('authorization', $_POST['authorization'], $time);
            setcookie('status', $_POST['status'], $time);

            if(isset($_POST['password'])){
                setcookie('password', $_POST['password'], $time);
            }
        }

        header("Location: ".$page);
    }elseif(isset($_POST['delete'])){

        setcookie('delete', true, $time);

        if($form == $student)
            setcookie('id', $_POST['id'], $time);
        elseif($form == $pparent)
            setcookie('parent_id', $_POST['parent_id'], $time);
        elseif($form == $account)
            setcookie('id', $_POST['id'], $time);

        header("Location: ".$page);
    }
    
    if(isset($_COOKIE['submit'])){

        setcookie('submit', false, $time);

        if($form == $student){

            $id = $_COOKIE['id'];
            $email = $_COOKIE['email'];
            $sex = $_COOKIE['sex'];
            $fname = $_COOKIE['fname'];
            $mname = $_COOKIE['mname'];
            $lname = $_COOKIE['lname'];
            $suffix = $_COOKIE['suffix'];
            $dob = $_COOKIE['dob'];
            $city = $_COOKIE['city'];
            $province = $_COOKIE['province'];
            $postal = $_COOKIE['postal'];
            $country = $_COOKIE['country'];
            $contact = $_COOKIE['contact'];
            $course = $_COOKIE['course'];
            $skills = $_COOKIE['statement'];
            $yr = $_COOKIE['yr'];



            $sql = "UPDATE students SET email = '$email', sex = '$sex', first_name = '$fname', middle_name = '$mname', last_name = '$lname', suffix = '$suffix', dob = '$dob', city = '$city', province = '$province', postal = '$postal', country = '$country', contact = '$contact', course = '$course', year = '$yr', skills = '$skills' WHERE id = '$id'";

        }
        elseif($form == $pparent){

            $id = $_COOKIE['parent_id'];
            $parent = $_COOKIE['id'];
            $email = $_COOKIE['pemail'];
            $sex = $_COOKIE['psex'];
            $fname = $_COOKIE['pfname'];
            $mname = $_COOKIE['pmname'];
            $lname = $_COOKIE['plname'];
            $suffix = $_COOKIE['psuffix'];
            $rel = $_COOKIE['prel'];
            $city = $_COOKIE['city'];
            $province = $_COOKIE['province'];
            $postal = $_COOKIE['postal'];
            $country = $_COOKIE['country'];
            $contact = $_COOKIE['contact'];

            $sql = "UPDATE parents SET student_id = '$parent', email = '$email', relationship = '$rel', sex = '$sex', first_name = '$fname', middle_name = '$mname', last_name = '$lname', suffix = '$suffix', city = '$city', province = '$province', postal = '$postal', country = '$country', contact = '$contact' WHERE id = '$id'";
        }
        elseif($form == $account){

            $id = $_COOKIE['id'];
            $authorization = $_COOKIE['authorization'];
            $status = $_COOKIE['status'];
            $password = $_COOKIE['password'] ?? '';


            if($status == "CHANGEPASS"){
                $code = rand(1000, 9999);
            }
            else{
                $code = 0;
            }

            if($password != ''){
                $sql = "UPDATE accounts SET student_id = '$id',password = '$password', authorization = '$authorization', code = '$code', status = '$status' WHERE student_id = '$id'";
            }
            else{
                $sql = "UPDATE accounts SET student_id = '$id', authorization = '$authorization', code = '$code', status = '$status' WHERE student_id = '$id'";
            }
        }

        try{
            mysqli_query($admin, $sql);
            $message = "Update success";
        }catch(Exception $e){
            $message = 'Message: ' . $e->getMessage();  
        }
        
        setcookie('vmessage', $message, $time);

        header("Location: ".$page."&id=".$id);
    }
    elseif(isset($_COOKIE['delete'])){

        setcookie('delete', false, $time);

        $student_id = $_SESSION['id'];

        if($form == $student){

            $id = $_COOKIE['id'];

            $sql = "DELETE FROM students WHERE id='$id'";

        }
        elseif($form == $pparent){

            $id = $_COOKIE['parent_id'];

            $sql = "DELETE FROM parents WHERE id='$id'";
        }
        elseif($form == $account){

            $id = $_COOKIE['id'];

            $sql = "DELETE FROM accounts WHERE student_id='$id'";
        }

        if($id != $student_id)
            try{
                mysqli_query($admin, $sql);
                $message = "Submit success";
            }catch(Exception $e){
                $message = 'Message: ' . $e->getMessage();  
            }
        else
            $message = "Can't delete your own account";
    
        setcookie('vmessage', $message, $time);

        header("Location: ".$page."&id=".$id);
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
                  if($form == $student) echo "Student";
                  elseif($form == $pparent) echo "Parent";
                  elseif($form == "event") echo "Event";
                  elseif($form == $account) echo "Account";
                ?>
                Form
            </h3>
            <section>
                <form action="<?php echo $page; ?>" method="post">
                    <section class="<?php if($form == $student || $form == $pparent) echo 'grid'; ?>">
                        <?php if($form == $student): ?>
                            <section id="primary">
                                <h4>Primary</h4>
                                <div class="entry">
                                    <label for="">Student ID:</label>
                                    <?php if($_SESSION['authorization'] != 'Admin'): ?>
                                    <span class="width"><?php echo htmlspecialchars($data['id']); ?></span>
                                    <?php endif; ?>
                                    <input class="p width hide" type="text" name="id" id="id" value="<?php echo htmlspecialchars($data['id']); ?>" <?php if($_SESSION['authorization'] != 'Admin'){echo 'hidden';} ?>>
                                    
                                </div>
                                <div class="entry">
                                    <label for="">E-mail:</label>
                                    <input class="p width hide" type="email" name="email" id="email" value="<?php echo htmlspecialchars($data['email']); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">First Name:</label>
                                    <input class="p width hide" type="text" name="fname" id="fname" value="<?php echo htmlspecialchars($data['first_name']); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Midlle Name:</label>
                                    <input class="p width hide" type="text" name="mname" id="mname" value="<?php echo htmlspecialchars($data['middle_name']); ?>">
                                </div>
                                <div class="entry">
                                    <label for="">Last Name:</label>
                                    <input class="p width hide" type="text" name="lname" id="lname" value="<?php echo htmlspecialchars($data['last_name']); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Suffix:</label>
                                    <input class="p width hide" type="text" name="suffix" id="suffix" value="<?php echo htmlspecialchars($data['suffix']); ?>">
                                </div>
                                <div class="entry">
                                    <label for="sex">Sex:</label>
                                    <select class="p select" name="sex" id="sex">
                                        <option value="Male" <?php echo htmlspecialchars($male); ?>>Male</option>
                                        <option value="Female" <?php echo htmlspecialchars($female); ?>>Female</option>
                                    </select>
                                </div>
                                <div id="dobs">
                                    <div class="entry">
                                        <label for="dob">Date of Birth:</label>
                                        <input class="p width hide" type="date" name="dob" id="dob" value="<?php echo htmlspecialchars($data['dob']); ?>" required>
                                    </div>
                                </div>

                                <br><br>

                                <div id="career">
                                    <h4>Career</h4>
                                    <div class="entry">
                                        <label for="">Course:</label>
                                        <select class="p select" name="course" id="course">
                                            <option value="CS" <?php echo htmlspecialchars($cs); ?>>CS</option>
                                            <option value="IT" <?php echo htmlspecialchars($it); ?>>IT</option>
                                        </select>
                                    </div>
                                    <div class="entry">
                                        <label for="">Year:</label>
                                        <select class="p select" name="yr" id="yr">
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
                                        <div><input type="checkbox" name="skills[]" class="p" value="C" id="c" <?php echo htmlspecialchars($c); ?>><label for="c"> C</label></div>
                                        <div><input type="checkbox" name="skills[]" class="p" value="C++" id="cpp" <?php echo htmlspecialchars($cpp); ?>><label for="cpp"> C++</label></div>
                                        <div><input type="checkbox" name="skills[]" class="p" value="C#" id="cs" <?php echo htmlspecialchars($csharp); ?>><label for="cs"> C#</label></div>
                                        <div><input type="checkbox" name="skills[]" class="p" value="Java" id="java" <?php echo htmlspecialchars($java); ?>><label for="java"> Java</label></div>
                                        <div><input type="checkbox" name="skills[]" class="p" value="Python" id="py" <?php echo htmlspecialchars($py); ?>><label for="py"> Python</label></div>
                                        <div><input type="checkbox" name="skills[]" class="p" value="JavaScript" id="js" <?php echo htmlspecialchars($js); ?>><label for="js"> JavaScript</label></div>
                                        <div><input type="checkbox" name="skills[]" class="p" value="Cisco" id="cisco" <?php echo htmlspecialchars($cisco); ?>><label for="cisco"> Cisco</label></div>
                                    </div>
                                </div>
                            </section>
                            <section id="address">
                                <h4>Address</h4>
                                <div class="entry">
                                    <label for="">City:</label>
                                    <input class="p width hide" type="text" name="city" id="city" value="<?php echo htmlspecialchars($data['city']); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Province:</label>
                                    <input class="p width hide" type="text" name="province" id="province" value="<?php echo htmlspecialchars($data['province']); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Postal Code:</label>
                                    <input class="p width hide" type="text" name="postal" id="postal" value="<?php echo htmlspecialchars($data['postal']); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Country:</label>
                                    <input class="p width hide" type="text" name="country" id="country" value="<?php echo htmlspecialchars($data['country']); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Contact No:</label>
                                    <input class="p width hide" type="text" name="contact" id="contact" value="<?php echo htmlspecialchars($data['contact']); ?>" required>
                                </div>
                                <br>
                                <div class="entry">
                                    <label for="">Date Created:</label>
                                    <span class="width"><?php echo htmlspecialchars($data['created_at']); ?></span>
                                </div>
                            </section>
                        <?php elseif($form == $pparent): ?>
                            <section id="primary">
                                <h4>Primary</h4>
                                <div class="entry">
                                    <label for="">Student ID:</label>
                                    <?php if($_SESSION['authorization'] == "Admin"): ?>
                                    <input class="p width hide" type="text" name="id" id="id" value="<?php echo htmlspecialchars($data['student_id']); ?>">
                                    <?php else: ?>
                                    <span class="width"><?php echo htmlspecialchars($data['student_id']); ?></span>
                                    <input class="p width hide" type="text" name="id" value="<?php echo htmlspecialchars($data['student_id']); ?>" hidden>
                                    <?php endif; ?>
                                </div>
                                <div class="entry">
                                    <label for="">E-mail:</label>
                                    <input class="p width hide" type="email" name="email" id="email" value="<?php echo htmlspecialchars($data['email']); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">First Name:</label>
                                    <input class="p width hide" type="text" name="fname" id="fname" value="<?php echo htmlspecialchars($data['first_name']); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Midlle Name:</label>
                                    <input class="p width hide" type="text" name="mname" id="mname" value="<?php echo htmlspecialchars($data['middle_name']); ?>">
                                </div>
                                <div class="entry">
                                    <label for="">Last Name:</label>
                                    <input class="p width hide" type="text" name="lname" id="lname" value="<?php echo htmlspecialchars($data['last_name']); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Suffix:</label>
                                    <input class="p width hide" type="text" name="suffix" id="suffix" value="<?php echo htmlspecialchars($data['suffix']); ?>">
                                </div>
                                <div class="entry">
                                    <label for="sex">Sex:</label>
                                    <select class="p select" name="sex" id="sex">
                                        <option value="Male" <?php echo htmlspecialchars($male); ?>>Male</option>
                                        <option value="Female" <?php echo htmlspecialchars($female); ?>>Female</option>
                                    </select>
                                </div>
                                <div id="relationship">
                                    <div class="entry">
                                        <label for="rel">Relationship:</label>
                                        <select class="p select" name="rel" id="rel">
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
                                    <input class="p width hide" type="text" name="city" id="city" value="<?php echo htmlspecialchars($data['city']); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Province:</label>
                                    <input class="p width hide" type="text" name="province" id="province" value="<?php echo htmlspecialchars($data['province']); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Postal Code:</label>
                                    <input class="p width hide" type="text" name="postal" id="postal" value="<?php echo htmlspecialchars($data['postal']); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Country:</label>
                                    <input class="p width hide" type="text" name="country" id="country" value="<?php echo htmlspecialchars($data['country']); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Contact No:</label>
                                    <input class="p width hide" type="text" name="contact" id="contact" value="<?php echo htmlspecialchars($data['contact']); ?>" required>
                                </div>
                                <br>
                                <div class="entry">
                                    <label for="">Date Created:</label>
                                    <span class="width"><?php echo htmlspecialchars($data['created_at']); ?></span>
                                </div>
                                <div class="entry">
                                    <input class="width" type="text" name="parent_id" id="parent_id" value="<?php echo htmlspecialchars($data['id']); ?>" hidden>
                                </div>
                            </section>
                        <?php elseif($form == $account): ?>
                            <section>
                                <h4>Primary</h4>
                                <div class="entry single">
                                    <label for="">Student ID:</label>
                                    <?php if($_SESSION['authorization'] != "Admin"): ?>
                                    <span class="width"><?php echo htmlspecialchars($data['student_id']); ?></span>
                                    <input class="p width" type="text" name="id"value="<?php echo htmlspecialchars($data['student_id']); ?>" hidden>
                                    <?php else: ?>
                                    <input class="p width hide" type="text" name="id"value="<?php echo htmlspecialchars($data['student_id']); ?>">
                                    <?php endif; ?>
                                        </div>
                                <?php if($_SESSION['id'] == $data['student_id']): ?>
                                <div class="entry single">
                                    <label for="">Password:</label>
                                    <input class="p width hide" type="password" name="password" value="<?php echo htmlspecialchars($data['password']); ?>">
                                </div>
                                <?php endif; ?>
                                <div class="entry single">
                                    <label for="">E-mail:</label>
                                    <span class="p width"><?php echo htmlspecialchars($data2['email']); ?></span>
                                </div>
                                <div class="entry single">
                                    <label for="sex">Authorization:</label>
                                    <?php if($_SESSION['authorization'] == "Admin"): ?>
                                    <select class="p select" name="authorization">
                                        <option value="Admin" <?php echo htmlspecialchars($aadmin); ?>>Admin</option>
                                        <option value="Guest" <?php echo htmlspecialchars($guest); ?>>Guest</option>
                                    </select>
                                    <?php else: ?>
                                    <span class="width"><?php echo htmlspecialchars($data['authorization']); ?></span>
                                    <select class="p select" name="authorization" hidden>
                                        <option value="Admin" <?php echo htmlspecialchars($aadmin); ?>>Admin</option>
                                        <option value="Guest" <?php echo htmlspecialchars($guest); ?>>Guest</option>
                                    </select>
                                    <?php endif; ?>
                                </div>
                                <?php if($_SESSION['authorization'] == "Admin"): ?>
                                <div class="entry single">
                                    <label for="">Code:</label>
                                    <span class="p width"><?php echo htmlspecialchars($data['code']); ?></span>
                                </div>
                                <?php endif; ?>
                                <div class="entry single">
                                    <label for="rel">Status:</label>
                                    <?php if($_SESSION['authorization'] == "Admin"): ?>
                                    <select class="p select" name="status" id="status">
                                        <option value="RUNNING" <?php echo $running; ?>>RUNNING</option>
                                        <option value="CHANGEPASS" <?php echo $changepass; ?>>CHANGEPASS</option>
                                    </select>
                                    <?php else: ?>
                                    <span class="width"><?php echo htmlspecialchars($data['status']); ?></span>
                                    <select class="p select" name="status" id="status" hidden>
                                        <option value="RUNNING" <?php echo $running; ?>>RUNNING</option>
                                        <option value="CHANGEPASS" <?php echo $changepass; ?>>CHANGEPASS</option>
                                    </select>
                                    <?php endif; ?>
                                </div>
                                <div class="entry single">
                                    <label for="">Date Created:</label>
                                    <span class="width"><?php echo htmlspecialchars($data['created_at']); ?></span>
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