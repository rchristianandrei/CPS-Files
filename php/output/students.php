<?php
    include '../config/connection.php';

    $search = '';

    //  Retrieve Query
    $sql = "SELECT id, email, sex, first_name, middle_name, last_name, suffix, created_at FROM students LIMIT 10";

    //  Get Results
    $result = mysqli_query($connect, $sql);

    //  Get multiple results for showing in table
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if(isset($_POST['submit'])){
        $search = $_POST['search'];

        $sql = "SELECT id, email, sex, first_name, middle_name, last_name, suffix, created_at FROM students WHERE id LIKE '%$search%' OR email LIKE '%$search%' OR sex LIKE '%$search%' OR first_name LIKE '%$search%' OR middle_name LIKE '%$search%' OR last_name LIKE '%$search%' OR suffix LIKE '%$search%'";

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
        
    </head>
    <body>
        <header>
            <?php include '../templates/header.php'; ?>
        </header>
        <main>
            <?php include'../templates/subheader_output.php'; ?>
            <table>
                <caption>
                    <h3>Student Primary Information Table</h3><br>
                    <form action="students.php" method="post">
                        <input size="40" type="text" placeholder="2020-99999" name="search" value="<?php echo htmlspecialchars($search); ?>"><input type="submit" name="submit" id="submit" value="Search" class="button">
                    </form>
                </caption>
                <tr>
                    <th>Student Id</th>
                    <th>E-mail</th>
                    <th>Sex</th>                    
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Suffix</th>
                    <th>Date Created</th>
                    <th>Update</th>
                </tr>
                <?php 
                    $index = 1;
                    foreach($data as $entry):
                ?>
                    <tr style="background-color: <?php if($index%2 != 0){ echo 'white'; }else{ echo 'inherit'; } ?>;">
                        <td><?php echo htmlspecialchars($entry['id']); ?></td>
                        <td><?php echo htmlspecialchars($entry['email']); ?></td>
                        <td><?php echo htmlspecialchars($entry['sex']); ?></td>
                        <td><?php echo htmlspecialchars($entry['first_name']); ?></td>
                        <td><?php echo htmlspecialchars($entry['middle_name']); ?></td>
                        <td><?php echo htmlspecialchars($entry['last_name']); ?></td>
                        <td><?php echo htmlspecialchars($entry['suffix']); ?></td>
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