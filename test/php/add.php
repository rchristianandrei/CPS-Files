<?php
    session_start();

    include '../config/admin.php';

    if(isset($_SESSION['authorization']) || $_SESSION['authorization'] != "Admin"){
        if($_GET['form'] != "parent"){
            header("Location: home.php");
        }
    }

    $form = $_GET['form'] ?? "student";
    $page = $_SERVER['PHP_SELF'] . "?form=" . $form;
    $time = time() + 600;
    $message = $student = $parent = $event = $account = '';

    if($form == "student"){
        StudentData();
        $student = 'background: rgb(74, 116, 223);';
    }
    elseif($form == "parent"){
        ParentData();
        $parent = 'background: rgb(74, 116, 223);';
    }
    elseif($form == "event"){
        EventData();
        $event = 'background: rgb(74, 116, 223);';
    }
    elseif($form == "account"){
        AccountData();
        $account = 'background: rgb(74, 116, 223);';
    }
    else header("Location: ".$_SERVER['PHP_SELF']);

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
        elseif($form == "event"){

        }
        elseif($form == "account"){

            setcookie('aid', $_POST['aid'], $time);
            setcookie('password', $_POST['password'], $time);
            setcookie('authorization', $_POST['authorization'], $time);
        }

        header("Location: ".$page);
    }
    
    if(isset($_COOKIE['submit'])){

        setcookie('submit', false, $time);

        if($form == "student"){

            $sql = "INSERT INTO students VALUES('$id', '$email', '$sex', '$fname', '$mname', '$lname', '$suffix', '$dob', '$city', '$province', '$postal', '$country', '$contact', '$course', '$yr', '$statement', null)";
        }
        elseif($form == "parent"){

            $sql = "INSERT INTO parents VALUES(null, '$id', '$email', '$rel', '$sex', '$fname', '$mname', '$lname', '$suffix', '$city', '$province', '$postal', '$country', '$contact', null)";
        }
        elseif($form == "account"){
            $sql = "INSERT INTO accounts VALUES('$aid', '$pass', '$authorization', '0', 'RUNNING', null)";
        }

        try{
            mysqli_query($admin, $sql);
            $message = "Submit success";
        }catch(Exception $e){
            $message = 'Message: ' . $e->getMessage();  
        }
    }

    function StudentData(){
        global $id, $email, $fname, $mname, $lname, $suffix, $sex, $male, $female, $dob;
        global $course, $cs, $it, $yr, $first, $second, $third, $fourth, $statement, $skills, $c, $cpp, $csharp, $java, $py, $js, $cisco;
        global $city, $province, $postal, $country, $contact;

        $id = $_COOKIE['id'] ?? '';
        $email = $_COOKIE['email'] ?? '';
        $fname = $_COOKIE['fname'] ?? '';
        $mname = $_COOKIE['mname'] ?? '';
        $lname = $_COOKIE['lname'] ?? '';
        $suffix = $_COOKIE['suffix'] ?? '';
        $sex = $_COOKIE['sex'] ?? '';
        $dob = $_COOKIE['dob'] ?? '';

        $course = $_COOKIE['course'] ?? '';
        $yr = $_COOKIE['yr'] ?? '';
        $statement = $_COOKIE['statement'] ?? '';

        $city = $_COOKIE['city'] ?? '';
        $province = $_COOKIE['province'] ?? '';
        $postal = $_COOKIE['postal'] ?? '';
        $country = $_COOKIE['country'] ?? '';
        $contact = $_COOKIE['contact'] ?? '';

        if($sex == "Male") $male = 'selected="selected"';
        else $female = 'selected="selected"';

        if($course == "CS") $cs = 'selected="selected"';
        else $it = 'selected="selected"';

        if($yr == "1") $first = 'selected="selected"';
        elseif($yr == "2") $second = 'selected="selected"';
        elseif($yr == "3") $third = 'selected="selected"';
        else $fourth = 'selected="selected"';

        if(isset($_COOKIE['statement'])){
            
            $skills = explode(', ', $statement);
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
        global $id, $email, $fname, $mname, $lname, $suffix, $sex, $male, $female, $rel, $parent, $guardian;
        global $city, $province, $postal, $country, $contact;
        
        $id = $_COOKIE['id'] ?? '';
        $email = $_COOKIE['pemail'] ?? '';
        $fname = $_COOKIE['pfname'] ?? '';
        $mname = $_COOKIE['pmname'] ?? '';
        $lname = $_COOKIE['plname'] ?? '';
        $suffix = $_COOKIE['psuffix'] ?? '';
        $sex = $_COOKIE['psex'] ?? '';
        $rel = $_COOKIE['prel'] ?? '';

        $city = $_COOKIE['city'] ?? '';
        $province = $_COOKIE['province'] ?? '';
        $postal = $_COOKIE['postal'] ?? '';
        $country = $_COOKIE['country'] ?? '';
        $contact = $_COOKIE['contact'] ?? '';

        if($sex == "Male") $male = 'selected="selected"';
        else $female = 'selected="selected"';

        if($rel == "Parent") $parent = 'selected="selected"';
        else $guardian = 'selected="selected"';
    }

    function EventData(){

    }

    function AccountData(){

        global $aid, $pass, $authorization, $aadmin, $guest;

        $aid = $_COOKIE['aid'] ?? '';
        $pass = $_COOKIE['password'] ?? '';
        $authorization = $_COOKIE['authorization'] ?? '';

        if($authorization == "Admin") $aadmin = 'selected="selected"';
        else $guest = 'selected="selected"';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../templates/head.php'; ?>
    <link rel="stylesheet" type="text/css" href="../css/add.css">
    <script src="../js/add.js"></script>
</head>
<body>
    <header>
        <?php
            if($_SESSION['authorization'] == "Admin"){
                include '../templates/header.php'; 
            }
        ?>
    </header>
    <main>
        <section class="title">
            <h2>Add</h2>
        </section>
        <section class="outer">
            <nav>
                <ul class="sub-nav">
                    <?php if($_SESSION['authorization'] == "Admin"): ?>
                    <li style="<?php echo $account; ?>"><a href="?form=account" id="account">Accounts</a></li>
                    <li style="<?php echo $student; ?>"><a href="?form=student" id="students">Students</a></li>
                    <li style="<?php echo $parent; ?>"><a href="?form=parent" id="parents">Parents</a></li>
                    <li style="<?php echo $event; ?>"><a href="?form=event" id="events">Events</a></li>
                    <!-- <li><a href="?form=achievement" id="achievements">Achievements</a></li> -->
                    <?php else: ?>
                    <section class="buttons">
                    <i class="fa-solid fa-xmark" id="close"></i>
                    </section>
                    <?php endif; ?>
                </ul>
            </nav>
            <h3 id="title">
                <?php
                  if($form == "student")
                    echo "Student";
                  elseif($form == "parent")
                    echo "Parent";
                  elseif($form == "event")
                    echo "Event";
                  elseif($form == "account")
                    echo "Account";
                ?>
                Form
            </h3>
            <section>
                <form action="<?php echo $page; ?>" method="post">
                    <section class="<?php if($form == 'student' || $form == 'parent'){echo 'grid';} ?>">
                        <?php if($form == "student"): ?>
                            <section id="primary">
                                <h4>Primary</h4>
                                <div class="entry">
                                    <label for="">Student ID:</label>
                                    <input class="width" type="text" name="id" id="id" value="<?php echo htmlspecialchars($id); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">E-mail:</label>
                                    <input class="width" type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">First Name:</label>
                                    <input class="width" type="text" name="fname" id="fname" value="<?php echo htmlspecialchars($fname); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Midlle Name:</label>
                                    <input class="width" type="text" name="mname" id="mname" value="<?php echo htmlspecialchars($mname); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Last Name:</label>
                                    <input class="width" type="text" name="lname" id="lname" value="<?php echo htmlspecialchars($lname); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Suffix:</label>
                                    <input class="width" type="text" name="suffix" id="suffix" value="<?php echo htmlspecialchars($suffix); ?>">
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
                                        <input class="width" type="date" name="dob" value="<?php echo htmlspecialchars($dob); ?>" required>
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
                                    <input class="width" type="text" name="city" id="city" value="<?php echo htmlspecialchars($city); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Province:</label>
                                    <input class="width" type="text" name="province" id="province" value="<?php echo htmlspecialchars($province); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Postal Code:</label>
                                    <input class="width" type="text" name="postal" id="postal" value="<?php echo htmlspecialchars($postal); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Country:</label>
                                    <input class="width" type="text" name="country" id="country" value="<?php echo htmlspecialchars($country); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Contact No:</label>
                                    <input class="width" type="text" name="contact" id="contact" value="<?php echo htmlspecialchars($contact); ?>" required>
                                </div>
                            </section>
                        <?php elseif($form == "parent"): ?>
                        <section id="primary">
                                <h4>Primary</h4>
                                <div class="entry">
                                 <label for="">Student ID:</label>
                                    <?php if($_SESSION['authorization'] != "Admin"): ?>
                                    <span class="width"><?php echo $_SESSION['id']; ?></span>
                                    <input class="width" type="text" name="id" id="id" value="<?php echo $_SESSION['id']; ?>" hidden>
                                    <?php else: ?>
                                    <input class="width" type="text" name="id" id="id" value="<?php echo htmlspecialchars($id); ?>" required>
                                    <?php endif; ?>
                                </div>
                                <div class="entry">
                                    <label for="">E-mail:</label>
                                    <input class="width" type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">First Name:</label>
                                    <input class="width" type="text" name="fname" id="fname" value="<?php echo htmlspecialchars($fname); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Midlle Name:</label>
                                    <input class="width" type="text" name="mname" id="mname" value="<?php echo htmlspecialchars($mname); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Last Name:</label>
                                    <input class="width" type="text" name="lname" id="lname" value="<?php echo htmlspecialchars($lname); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Suffix:</label>
                                    <input class="width" type="text" name="suffix" id="suffix" value="<?php echo htmlspecialchars($suffix); ?>">
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
                                    <input class="width" type="text" name="city" id="city" value="<?php echo htmlspecialchars($city); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Province:</label>
                                    <input class="width" type="text" name="province" id="province" value="<?php echo htmlspecialchars($province); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Postal Code:</label>
                                    <input class="width" type="text" name="postal" id="postal" value="<?php echo htmlspecialchars($postal); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Country:</label>
                                    <input class="width" type="text" name="country" id="country" value="<?php echo htmlspecialchars($country); ?>" required>
                                </div>
                                <div class="entry">
                                    <label for="">Contact No:</label>
                                    <input class="width" type="text" name="contact" id="contact" value="<?php echo htmlspecialchars($contact); ?>" required>
                                </div>
                            </section>
                        <?php elseif($form == "event"): ?>
                            <div class="entry single">
                                <label for="">Event Name:</label>
                                <input class="width" type="text" name="name" id="name" required>
                            </div>
                            <div class="entry single">
                                <label for="">Date:</label>
                                <input class="width" type="date" name="date" id="date" required>
                            </div>
                            <div class="entry single">
                                <label for="">Time:</label>
                                <input class="width" type="time" name="date" id="date" required>
                            </div>
                            <div class="file">
                                <label for="img">Add Image <i class="fa-solid fa-image"></i></label>
                                <div id="filename"></div>
                                <input class="width" type="file" name="img" id="img" accept="image/*">
                            </div>
                        <?php elseif($form == "account"): ?>
                            <div class="entry single">
                                <label for="aid">Student ID:</label>
                                <input class="width" type="text" name="aid" id="aid" maxlength="10" required>
                            </div>
                            <div class="entry single">
                                <label for="password">Password:</label>
                                <input class="width" type="text" name="password" id="password" maxlength="20" required>
                            </div>
                            <div class="entry single">
                                <label for="authorization">Authorization:</label>
                                <select class="select" name="authorization" id="authorization">
                                    <option value="Admin" <?php echo htmlspecialchars($aadmin); ?>>Admin</option>
                                    <option value="Guest" <?php echo htmlspecialchars($guest); ?>>Guest</option>
                                </select>
                            </div>
                        <?php endif; ?>
                    </section>
                    <div class="center"><?php echo $message; ?></div><br>
                    <button class="submit" name="submit">Submit</button>
                </form>
            </section>
        </section>
    </main>
    <footer>
    <?php
            if($_SESSION['authorization'] == "Admin"){
                include '../templates/footer.php'; 
            }
        ?>
    </footer>
</body>
</html>