<?php

    session_start();

    if(!isset($_SESSION['login'])){
        session_abort();
        header('Location: index.php');
    }

    //  Global Variables
    include '../config/connection.php';
    $search = '';

    if(isset($_POST['submit'])){

        search();

    }else{

        initialInfo();

    }

    mysqli_free_result($result);
    mysqli_close($connect);

    function search(){

        //  Global references
        global $search, $result, $connect, $data;

        $search = $_POST['search'];

        $sql = "SELECT student_id, email, relationship, sex, first_name, middle_name, last_name, suffix, contact FROM parents WHERE 
            student_id LIKE '%$search%' OR 
            email LIKE '%$search%' OR 
            relationship LIKE '%$search%' OR 
            sex LIKE '%$search%' OR 
            first_name LIKE '%$search%' OR 
            middle_name LIKE '%$search%' OR 
            last_name LIKE '%$search%' OR 
            suffix LIKE '%$search%' OR 
            contact LIKE '%$search%'";

        $result = mysqli_query($connect, $sql);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    function initialInfo(){

        //  Global References
        global $result, $connect, $data;

        //  Retrieve Query
        $sql = "SELECT student_id, email, relationship, sex, first_name, middle_name, last_name, suffix, contact FROM parents LIMIT 10";

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
    <link rel="stylesheet" type="text/css" href="../css/smaller_subheader.css">
    <link rel="stylesheet" type="text/css" href="../css/students_output.css">
    <style>
        #retrieve, #parent, #primary{
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
            <?php include '../templates/parentsubheader_output.php'; ?>
            <table>
                <caption>
                    <h3>Parent Primary Information Table</h3><br>
                    <form action="parents.php" method="post">
                        <input size="40" type="text" placeholder="2020-99999" name="search" value="<?php echo htmlspecialchars($search); ?>"><input type="submit" name="submit" id="submit" value="Search" class="button">
                    </form>
                </caption>
                <tr>
                    <th>Student ID</th>
                    <th>Full Name</th>
                    <th>Parent E-mail</th>
                    <th>Relationship</th>
                    <th>Sex</th>
                    <th>Contact</th>
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
                        <td><?php echo htmlspecialchars($entry['student_id']); ?></td>
                        <td><?php echo htmlspecialchars($fullName); ?></td>
                        <td><?php echo htmlspecialchars($entry['email']); ?></td>
                        <td><?php echo htmlspecialchars($entry['relationship']); ?></td>
                        <td><?php echo htmlspecialchars($entry['sex']); ?></td>
                        <td><?php echo htmlspecialchars($entry['contact']); ?></td>
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