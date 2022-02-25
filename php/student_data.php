<?php
    include 'templates/connection.php';

    $sql = "select * from student_data limit 10";

    $result = mysqli_query($connect, $sql);

    //  Get multiple results for showing in table
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'templates/head.php' ?>
        
        <style> /* CSS for table */
            table {
                width: 80%;
                margin: auto;
                font-size: 30px;
                text-align: center;
                border-collapse: collapse;
            }
            td, th {
                padding: 5px;
                border: 2px solid white;
            }
            #firstName {
                width: 50%;
            }
        </style>
    </head>
    <body>
        <header>
            <?php include 'templates/header.php' ?>
        </header>
        <main>
            <table>
                <caption>Student Primary Information Table</caption>
                <tr>
                    <th>Student Id</th>
                    <th>Last Name</th>
                    <th id="firstName">First Name</th>
                    <th>Update</th>
                </tr>
                <?php foreach($data as $entry){ ?>
                    <tr>
                        <td><?php echo $entry['student_id']; ?></td>
                        <td><?php echo $entry['first_name']; ?></td>
                        <td><?php echo $entry['last_name']; ?></td>
                        <td><a href="#">edit</a></td>
                    </tr> 
                <?php } ?>
            </table>
        </main>
        <footer>
            <?php include 'templates/footer.php' ?>
        </footer>
    </body>
</html>