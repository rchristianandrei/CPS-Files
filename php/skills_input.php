<?php 

    $student_id = $skills = $cpp = $cs = $c = $java = $py = $js = $cisco = $statement = $message = '';

    if(isset($_POST['submit'])){

        include '../config/connection.php';

        // Get info
        if(!empty($_POST['student_id'])){
            $student_id = mysqli_real_escape_string($connect, $_POST['student_id']);
        }
        
        $skills = $_POST['skills'];

        foreach($skills as $skill){
            if($skill == "C++"){
                $cpp = 'checked="checked"';
            }
            if($skill == "C#"){
                $cs = 'checked="checked"';
            }
            if($skill == "C"){
                $c = 'checked="checked"';
            }
            if($skill == "Java"){
                $java = 'checked="checked"';
            }
            if($skill == "Python"){
                $py = 'checked="checked"';
            }
            if($skill == "JavaScript"){
                $js = 'checked="checked"';
            }
            if($skill == "Cisco"){
                $cisco = 'checked="checked"';
            }
            $statement .= $skill . ', ';
        }
        $statement = substr($statement, 0, strlen($statement)-2);
        echo strlen($statement);

        // Check if student exist
        $sql = "SELECT id FROM students WHERE id = '$student_id'";
        $result = mysqli_query($connect, $sql);

        if(mysqli_num_rows($result) == 0){
            $message = "Student doesn't exist";
        }else{

            // Check if data entry already exist
            $sql = "SELECT student_id FROM skills WHERE student_id = '$student_id'";
            $result = mysqli_query($connect, $sql);
    
            if(mysqli_num_rows($result) == 1){
                $message = 'Data entry already exist';
            }else{
                $sql = "INSERT INTO skills VALUES('$student_id', '$statement')";
                if(mysqli_query($connect, $sql)){
                    $message = 'Success!';
                }else{
                    $message = 'Query Error';
                } 
            }
        }

        mysqli_free_result($result);
        mysqli_close($connect);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../templates/head.php'; ?>

    <link rel="stylesheet" type="text/css" href="../css/skills.css">
    <link rel="stylesheet" type="text/css" href="../css/subheader.css">
</head>
<body>
    <header>
        <?php include '../templates/header.php'; ?>
    </header>   
    <main>

        <?php include '../templates/subheader.php' ?>

        <form action="skills_input.php" method="post" id="form">
            <center>
                <h2>Skills</h2>
            </center>
            <div class="form">
                <div class="id">
                    <label for="student_id">Student ID: </label>
                    <input type="text" id="student_id" name="student_id" maxlength="10" placeholder="1234-12345" pattern="[1-9]{1}[0-9]{3}-[0-9]{5}" value="<?php echo $student_id; ?>" required>
                </div>
                <div class="skills">
                    <span class="big"><label>Skills: </label></span>
                    <span>
                        <ul>
                            <li><input type="checkbox" name="skills[]" id="cpp" value="C++" <?php echo htmlspecialchars($cpp) ?>><label for="cpp"> C++</label></li>
                            <li><input type="checkbox" name="skills[]" id="cs" value="C#" <?php echo htmlspecialchars($cs) ?>><label for="cs"> C#</label></li>
                            <li><input type="checkbox" name="skills[]" id="c" value="C" <?php echo htmlspecialchars($c) ?>><label for="c"> C</label></li>
                            <li><input type="checkbox" name="skills[]" id="java" value="Java" <?php echo htmlspecialchars($java) ?>><label for="java"> Java</label></li>
                            <li><input type="checkbox" name="skills[]" id="py" value="Python" <?php echo htmlspecialchars($py) ?>><label for="py"> Python</label></li>
                            <li><input type="checkbox" name="skills[]" id="js" value="JavaScript" <?php echo htmlspecialchars($js) ?>><label for="js">  JavaScript</label></li>
                            <li><input type="checkbox" name="skills[]" id="cisco" value="Cisco" <?php echo htmlspecialchars($cisco) ?>><label for="cisco"> Cisco</label></li>
                        </ul>  
                    </span>
                </div>
            </div>
            <center>
                <div style="color: <?php if ($message === "Success!"){ echo 'green'; } else{ echo 'red'; } ?>; margin: 10px 0;"><?php echo htmlspecialchars($message); ?></div><br>
                <input type="submit" name="submit" class="button" value="Submit">
            </center>
        </form>
        <script src="../js/checkbox.js"></script>
    </main>
    <footer>
        <?php 
            include '../templates/footer.php';
        ?>
    </footer>
</body>
</html>