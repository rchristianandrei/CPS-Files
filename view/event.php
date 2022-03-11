<?php
    session_start();
    $_SESSION['page'] = "Edit";

    //  Check if logged in
    include '../templates/logged.php';

    include '../config/connection.php';
    $event = $status = $upcoming = $ongoing = $done = $tba = $details = $date = $time = $location = '';
    $student = '';
    $message = '';

    if(isset($_POST['update'])){

        $event = mysqli_real_escape_string($connect, $_POST['event']);
        $status = mysqli_real_escape_string($connect, $_POST['status']);
        $details = mysqli_real_escape_string($connect, $_POST['details']);
        $date = mysqli_real_escape_string($connect, $_POST['date']);
        $time = mysqli_real_escape_string($connect, $_POST['time']);
        $location = mysqli_real_escape_string($connect, $_POST['location']);
        
        //  Check id empty
        if(empty($details)){
            $details = "TBA";
        }
        if(empty($location)){
            $location = "TBA";
        }

        
        //  Keep data on form
        if($status == "UPCOMING"){
            $upcoming = 'selected="selected"';
        }elseif($status == "ONGOING"){
            $ongoing = 'selected="selected"';
        }elseif($status == "DONE"){
            $done = 'selected="selected"';
        }else{
            $tba = 'selected="selected"';
        }
        
        $sql = "INSERT INTO events VALUES(null, '$date', '$status', '$event', '$details', '$time', '$location')";

        mysqli_close($connect);
    }elseif(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT * FROM events WHERE id = '$id'";
        $result = mysqli_query($connect, $sql);
        $data = mysqli_fetch_assoc($result);

        $event = $data['event'];

        if($data['status'] == "UPCOMING"){
            $upcoming = 'selected="selected"';
        }elseif($data['status'] == "ONGOING"){
            $ongoing = 'selected="selected"';
        }elseif($data['status'] == "DONE"){
            $done = 'selected="selected"';
        }else{
            $tba = 'selected="selected"';
        }

        $details = $data['details'];
        $date = $data['date'];
        $time = $data['time'];
        $location = $data['location'];
    }

    mysqli_free_result($result);
    mysqli_close($connect);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "../templates/head.php"; ?>

    <link rel="stylesheet" href="../css/index.css">
</head>
<body>
    <main>
        <div class="main">
            <h3 id="x"><i class="fa-solid fa-x xBtn"></i></h3>
            <h2>Input</h2>
            <h3>Parent / Guardian Info</h3>
            <form action="event.php" method="post">
                <div class="sub">
                    <div>
                        <span class="padding">
                            <caption><h4>Primary</h4></caption>
                            <div>
                                <label for="event">Event: </label>
                                <input class="details"  type="text" name="event" id="event" maxlength="50" value="<?php echo htmlspecialchars($event); ?>" placeholder="Competition" required>
                            </div>
                            <div>
                                <label for="status">Status: </label>
                                <select class="details center select" name="status" id="status" required>
                                    <option value="TBA" <?php echo htmlspecialchars($tba); ?>>TBA</option>
                                    <option value="UPCOMING" <?php echo htmlspecialchars($upcoming); ?>>UPCOMING</option>
                                    <option value="ONGOING" <?php echo htmlspecialchars($ongoing); ?>>ONGOING</option>
                                    <option value="DONE" <?php echo htmlspecialchars($done); ?>>DONE</option>
                                </select>
                            </div>
                            <div>
                                <label for="details">Details: </label>
                                <textarea class="details textarea" name="details" id="details" placeholder="TBA" rows="1"><?php echo htmlspecialchars($details); ?></textarea>
                            </div>
                            <div>
                                <label for="date">Date: </label>
                                <input class="details"  type="date" name="date" id="date" value="<?php echo htmlspecialchars($date); ?>">
                            </div>
                            <div>
                                <label for="time">Time: </label>
                                <input class="details"  type="time" name="time" id="time" value="<?php echo htmlspecialchars($time); ?>">
                            </div>
                            <div>
                                <label for="place">Location: </label>
                                <textarea class="details textarea" name="location" id="place" placeholder="TBA" rows="1"><?php echo htmlspecialchars($location); ?></textarea>
                            </div>
                        </span>
                    </div>
                    <div class="message" style="color: <?php if($message == "Submit success"){echo 'green';}else{
                        echo 'red';
                    } ?>"><?php echo htmlspecialchars($message); ?></div>
                    <div class="buttons">
                        <button class="submit" name="update" id="update">Update</button>
                        <button class="delete" name="delete" id="delete">Delete</button>
                    </div>
                    <script src="../js/view_event.js"></script>
                </div>
            </form>
        </div>
    </main>
</body>
</html>