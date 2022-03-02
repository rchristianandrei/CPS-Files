<?php
    session_start();

    if(!isset($_SESSION['login'])){
        session_abort();
        header('Location: index.php');
    }

    include '../config/connection.php';

    $search = '';

    //  Retrieve Query
    $sql = "SELECT id, street, city, province, postal, country, contact, course, created_at FROM students LIMIT 10";

    //  Get Results
    $result = mysqli_query($connect, $sql);

    //  Get multiple results for showing in table
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if(isset($_POST['submit'])){
        $search = $_POST['search'];

        $sql = "SELECT id, street, city, province, postal, country, contact, course, created_at FROM students WHERE id LIKE '%$search%' OR street LIKE '%$search%' OR city LIKE '%$search%' OR province LIKE '%$search%' OR postal LIKE '%$search%' OR country LIKE '%$search%' OR contact LIKE '%$search%'";

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
        #retrieve, #address{
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
                    <h3>Student Address Information Table</h3><br>
                    <form action="addresses.php" method="post">
                        <input size="25" type="text" placeholder="2020-99999" name="search" value="<?php echo htmlspecialchars($search); ?>"><input type="submit" name="submit" id="submit" value="Search" class="button">
                    </form>
                </caption>
                <tr>
                    <th>Student ID</th>
                    <th>Street</th>
                    <th>City</th>                    
                    <th>Province</th>
                    <th>Postal</th>
                    <th>Country</th>
                    <th>Contact</th>
                    <th>Date Created</th>
                    <th>Update</th>
                </tr>
                <?php 
                    $index = 1;
                    foreach($data as $entry):
                ?>
                    <tr style="background-color: <?php if($index%2 != 0){ echo 'white'; }else{ echo 'inherit'; } ?>;">
                        <td><?php echo htmlspecialchars($entry['id']); ?></td>
                        <td><?php echo htmlspecialchars($entry['street']); ?></td>
                        <td><?php echo htmlspecialchars($entry['city']); ?></td>
                        <td><?php echo htmlspecialchars($entry['province']); ?></td>
                        <td><?php echo htmlspecialchars($entry['postal']); ?></td>
                        <td><?php echo htmlspecialchars($entry['country']); ?></td>
                        <td><?php echo htmlspecialchars($entry['contact']); ?></td>
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