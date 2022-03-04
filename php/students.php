<?php

    session_start();

    if(!isset($_SESSION['login'])){
        session_abort();
        header('Location: index.php');
    }

    include '../config/connection.php';

    $search = '';

    if(isset($_POST['submit'])){
        $search = $_POST['search'];

        $sql = "SELECT id, email, sex, first_name, middle_name, last_name, suffix, course, skills FROM students 
            WHERE 
                id LIKE '%$search%' OR 
                email LIKE '%$search%' OR 
                sex LIKE '%$search%' OR 
                first_name LIKE '%$search%' OR 
                middle_name LIKE '%$search%' OR 
                last_name LIKE '%$search%' OR 
                suffix LIKE '%$search%' OR
                course LIKE '%$search%' OR 
                skills LIKE '%$search%'";

        $result = mysqli_query($connect, $sql);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }else{
        //  Retrieve Query
        $sql = "SELECT id, email, sex, first_name, middle_name, last_name, suffix, course, skills FROM students LIMIT 10";

        //  Get Results
        $result = mysqli_query($connect, $sql);

        //  Get multiple results for showing in table
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    mysqli_free_result($result);
    mysqli_close($connect);
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
                    <th>Skills</th>
                </tr>
                <?php 
                    $index = 1;
                    foreach($data as $entry):
                        $fullName = $entry['first_name']." <i>".$entry['middle_name'] ."</i> ".$entry['last_name']." ".$entry['suffix'];
                ?>
                    <tr style="background-color: <?php if($index%2 != 0){ echo 'white'; }else{ echo 'inherit'; } ?>;">
                        <td><?php echo htmlspecialchars($entry['id']); ?></td>
                        <td><?php echo htmlspecialchars($entry['email']); ?></td>
                        <td><?php echo htmlspecialchars($entry['sex']); ?></td>
                        <td><?php echo $fullName; ?></td>
                        <td><?php echo htmlspecialchars($entry['course']); ?></td>

                        <?php if(empty($entry['skills'])): ?>
                            <td><a href="skills_input.php?id=<?php echo htmlspecialchars($entry['id']); ?>" target="_blank"><?php echo 'undefined'; ?></a></td>
                        <?php else: ?>
                            <td><?php echo htmlspecialchars($entry['skills']); ?></td>
                        <?php endif; ?>
                        <td><a href="#">...</a></td>
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