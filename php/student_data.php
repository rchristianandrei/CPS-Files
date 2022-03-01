<?php
    include '../config/connection.php';

    //  Retrieve Query
    $sql = "select * from student_data limit 10";

    //  Get Results
    $result = mysqli_query($connect, $sql);

    //  Get multiple results for showing in table
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //  Free result space
    mysqli_free_result($result);

    // Close Connection
    mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include '../templates/head.php' ?>
        
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
            <?php include '../templates/header.php' ?>
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
                        <td><?php echo htmlspecialchars($entry['student_id']); ?></td>
                        <td><?php echo htmlspecialchars($entry['first_name']); ?></td>
                        <td><?php echo htmlspecialchars($entry['last_name']); ?></td>
                        <td><a href="#">edit</a></td>
                    </tr> 
                <?php } ?>
            </table>
        </main>
        <footer>
            <?php include '../templates/footer.php' ?>
        </footer>
    </body>
</html>