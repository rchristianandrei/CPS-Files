<?php

    session_start();
    
    //  Check if logged in
    if(!isset($_SESSION['login'])){
        session_abort();
        header('Location: index.php');
    }

    //  Check if allowed on this page
    if(!$_SESSION['login']['authorization'] === "admin"){
        header('Location: homepage.php');
    }

    // Global Variables
    $_SESSION['page'] = "Search";
    $connect = $_SESSION['conn'];
    $search = '';

    //  Check if form is submitted
    if(isset($_POST['submit'])){
        
        search();

    }else{

        initialInfo();
    }

    //  Close connection and free memory
    mysqli_free_result($result);
    mysqli_close($connect);

    function search(){

        //  Global References
        global $result, $search, $connect, $data;

        $search = $_POST['search'];

        $sql = "SELECT id, email, sex, first_name, middle_name, last_name, suffix, course, year, skills FROM students 
            WHERE 
                id LIKE '%$search%' OR 
                email LIKE '%$search%' OR 
                sex LIKE '%$search%' OR 
                first_name LIKE '%$search%' OR 
                middle_name LIKE '%$search%' OR 
                last_name LIKE '%$search%' OR 
                suffix LIKE '%$search%' OR
                course LIKE '%$search%' OR
                year LIKE '%$search%' OR 
                skills LIKE '%$search%'";

        $result = mysqli_query($connect, $sql);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    function initialInfo(){

        //  Global References
        global $result, $data, $connect;

        //  Retrieve Query
        $sql = "SELECT id, email, sex, first_name, middle_name, last_name, suffix, course, year, skills FROM students ORDER BY created_at LIMIT 10";

        //  Get Results
        $result = mysqli_query($connect, $sql);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
?>
<!DOCTYPE html>
<html lang="en">
    <?php include '../templates/head.php'; ?>

    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/subheader.css">
    <link rel="stylesheet" type="text/css" href="../css/students_output.css">
    <style>
        #retrieve, #student{
            opacity: 50%;
        }
    </style>
        
    </head>
    <body>
        <header>
            <?php include '../templates/header.php'; ?>
        </header>
        <main>
            <?php include '../templates/subheader_output.php'; ?>
            <table>
                <caption>
                    <h3>Student Primary Information Table</h3><br>
                    <form action="students.php" method="post">
                        <input size="40" type="text" placeholder="2020-99999" name="search" value="<?php echo htmlspecialchars($search); ?>"><input type="submit" name="submit" id="submit" value="Search" class="button">
                    </form>
                </caption>
                <tr>
                    <th>Student ID</th>
                    <th>E-mail</th>
                    <th>Sex</th>                    
                    <th>Full Name</th>
                    <th>Course</th>
                    <th>Year</th>
                    <th>Skills</th>
                </tr>
                <?php 
                    $index = 1;
                    foreach($data as $entry):

                        if(empty($entry['middle_name'])){

                            $fullName = $entry['first_name']." ".$entry['last_name']." ".$entry['suffix'];
                        }else{
                            $fullName = $entry['first_name']." ".substr($entry['middle_name'], 0, 1).". ".$entry['last_name']." ".$entry['suffix'];
                        }
                ?>
                    <tr style="background-color: <?php if($index%2 != 0){ echo 'white'; }else{ echo 'inherit'; } ?>;">
                        <td><?php echo htmlspecialchars($entry['id']); ?></td>
                        <td><?php echo htmlspecialchars($entry['email']); ?></td>
                        <td><?php echo htmlspecialchars($entry['sex']); ?></td>
                        <td><?php echo htmlspecialchars($fullName); ?></td>
                        <td><?php echo htmlspecialchars($entry['course']); ?></td>
                        <td><?php echo htmlspecialchars($entry['year']); ?></td>

                        <?php if(empty($entry['skills'])): ?>
                            <td><a href="student-information2.php?id=<?php echo htmlspecialchars($entry['id']); ?>" target="_blank"><?php echo 'undefined'; ?></a></td>
                        <?php else: ?>
                            <td><?php echo htmlspecialchars($entry['skills']); ?></td>
                        <?php endif; ?>
                        <td><a href="student-information2.php?id=<?php echo htmlspecialchars($entry['id']); ?>" target="_blank"><i class="fa-solid fa-ellipsis"></i></a></td>
                    </tr>
                <?php 
                    $index++;
                    endforeach;
                ?>
            </table>
        </main>
        <footer>
            <?php include '../templates/footer.php' ?>
        </footer>
    </body>
</html>