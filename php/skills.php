<?php

    session_start();

    if(!isset($_SESSION['login'])){
        session_abort();
        header('Location: index.php');
    }

    include '../config/connection.php';

    $search = '';

    //  Retrieve Query
    $sql = "SELECT * FROM skills LIMIT 10";

    //  Get Results
    $result = mysqli_query($connect, $sql);

    //  Get multiple results for showing in table
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if(isset($_POST['submit'])){
        $search = $_POST['search'];

        $sql = "SELECT * FROM skills WHERE student_id LIKE '%$search%' OR student_skills LIKE '%$search%'";

        $result = mysqli_query($connect, $sql);
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
        #retrieve, #skill{
            opacity: 50%;
        }
        form{
            display: flex;
  align-items: center;
  justify-content: center;
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
                    <h3>Student Skills Information Table</h3><br>
                    <form action="skills.php" method="post">
                        <input size="18" type="text" placeholder="2020-99999" name="search" value="<?php echo htmlspecialchars($search); ?>"><input type="submit" name="submit" id="submit" value="Search" class="button">
                    </form>
                </caption>
                <tr>
                    <th>Student ID</th>
                    <th>Skills</th>
                    <th>Date Created</th>
                    <th>Update</th>
                </tr>
                <?php 
                    $index = 1;
                    foreach($data as $entry):
                ?>
                    <tr style="background-color: <?php if($index%2 != 0){ echo 'white'; }else{ echo 'inherit'; } ?>;">
                        <td><?php echo htmlspecialchars($entry['student_id']); ?></td>
                        <td><?php echo htmlspecialchars($entry['student_skills']); ?></td>
                        <td><?php echo htmlspecialchars($entry['created_at']); ?></td>
                        <td><a href="#">edit</a></td>
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