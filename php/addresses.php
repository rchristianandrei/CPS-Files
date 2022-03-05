<?php
    session_start();

    if(!isset($_SESSION['login'])){
        session_abort();
        header('Location: index.php');
    }

    //  Global Variables
    include '../config/connection.php';
    $search = $result =  $data = '';

    if(isset($_POST['submit'])){
        
        search();

    }else{

        initialInfo();
        
    }

    mysqli_free_result($result);
    mysqli_close($connect);

    function search(){

        //  Global references
        global $connect, $result, $search, $data;

        $search = $_POST['search'];

        $sql = "SELECT id, first_name, middle_name, last_name, suffix, street, city, province, postal, country, contact, course FROM students 
            WHERE 
                id LIKE '%$search%' OR 
                street LIKE '%$search%' OR 
                city LIKE '%$search%' OR 
                province LIKE '%$search%' OR 
                postal LIKE '%$search%' OR 
                country LIKE '%$search%' OR 
                contact LIKE '%$search%'";

        $result = mysqli_query($connect, $sql);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    function initialInfo(){

        //  Global References
        global $result, $connect, $data;

        //  Retrieve Query
        $sql = "SELECT id, first_name, middle_name, last_name, suffix, street, city, province, postal, country, contact, course FROM students LIMIT 10";

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
                    <th>Full Name</th>
                    <th>Address</th>
                    <th>Country</th>
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

                        $address = $entry['street'].", ".$entry['city'].", ".$entry['province'].", ".$entry['province']." ".$entry['postal'];
                ?>
                    <tr style="background-color: <?php if($index%2 != 0){ echo 'white'; }else{ echo 'inherit'; } ?>;">
                        <td><?php echo htmlspecialchars($entry['id']); ?></td>
                        <td><?php echo htmlspecialchars($fullName); ?></td>
                        <td><?php echo htmlspecialchars($address); ?></td>
                        <td><?php echo htmlspecialchars($entry['country']); ?></td>
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