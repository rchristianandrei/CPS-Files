<?php
    session_start();

    //  Check if logged in
    if(!isset($_SESSION['login'])){
        session_abort();
        header('Location: index.php');
    }

    //  Check if allowed on this page
    if($_SESSION['login']['authorization'] === "guest"){
        header('Location: homepage.php');
    }else{
        include '../config/admin.php';
        $connect = $admin;
    }

    //  Global Variables
    $_SESSION['page'] = "Input";
    $event = $status = $upcoming = $ongoing = $done = $tba = $details = $date = $time = $location = '';
    $students[0] = '';
    $message = $participantMessage = '';

    if(isset($_POST['submit'])){

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

        try{
            mysqli_query($connect, $sql);
            $message = "Submit success";
        }catch(Exception $e){
            $message = 'Message: ' . $e->getMessage() . " or student does not exist";
        }

        mysqli_close($connect);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "../templates/head.php"; ?>

    <link rel="stylesheet" href="../css/index.css">
    <style>
        #add, #event-in{
            opacity: 50%;
        }
    </style>
</head>
<body>
    <header class="header">
        <?php include "../templates/header.php"; ?>
    </header>
    <main>
        <?php include '../templates/subheader_input.php'; ?>
        <div class="main">
            <h2>Input</h2>
            <h3>Event Info</h3>
            <form action="event_input.php" method="post">
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
                                <label for="location">Location: </label>
                                <textarea class="details textarea" name="location" id="location" placeholder="TBA" rows="1"><?php echo htmlspecialchars($location); ?></textarea>
                            </div>
                        </span>
                    </div>
                    <div class="message" style="color: <?php if($message == "Submit success"){echo 'green';}else{
                        echo 'red';
                    } ?>"><?php echo htmlspecialchars($message); ?></div>
                    <div style="text-align: center;">
                        <button class="submit" name="submit" id="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <footer>
        <?php include "../templates/footer.php"; ?>
    </footer>
</body>
</html>