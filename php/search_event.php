<?php
    session_start();
    $_SESSION['page'] = "Search";

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
        global $connect, $result, $search, $data;

        $search = $_POST['search'];

        $sql = "SELECT * FROM events 
            WHERE  
                event LIKE '%$search%' OR
                date LIKE '%$search%' OR
                time LIKE '%$search%' OR
                status LIKE '%$search%' OR
                location LIKE '%$search%'";

        $result = mysqli_query($connect, $sql);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    function initialInfo(){

        //  Global References
        global $result, $connect, $data;

        //  Retrieve Query
        $sql = "SELECT * FROM events ORDER BY date LIMIT 10";

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
        #retrieve, #search-events{
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
                    <h3>Event Information Table</h3><br>
                    <form action="search_event.php" method="post">
                        <input size="25" type="text" placeholder="2020-99999" name="search" value="<?php echo htmlspecialchars($search); ?>"><input type="submit" name="submit" id="submit" value="Search" class="button">
                    </form>
                </caption>
                <tr>
                    <th>Event</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Location</th>
                </tr>
                <?php 
                    $index = 1;
                    foreach($data as $entry):?>
                    <tr style="background-color: <?php if($index%2 != 0){ echo 'white'; }else{ echo 'inherit'; } ?>;">
                        <td><?php echo htmlspecialchars($entry['event']); ?></td>
                        <td><?php echo htmlspecialchars($entry['status']); ?></td>
                        <td><?php echo htmlspecialchars($entry['date']); ?></td>
                        <td><?php echo htmlspecialchars($entry['time']); ?></td>
                        <td><?php echo htmlspecialchars($entry['location']); ?></td>
                        
                        <td><a href="event-information.php?id=<?php echo htmlspecialchars($entry['id']); ?>" target="_blank"><i class="fa-solid fa-ellipsis"></i></a></td>
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