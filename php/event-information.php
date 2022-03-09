<?php
    session_start();
    $_SESSION['page'] = "Edit";

    if(!isset($_SESSION['login'])){
        session_abort();
        header('Location: index.php');
    }

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

        $sql = "SELECT student_id FROM participants WHERE event_id = '$id'";
        $result = mysqli_query($connect, $sql);
        $data2 = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }elseif(isset($_POST['add'])){
        $id = $_POST['id'];
        $student = $_POST['student'];

        //  check for duplicates
        $sql = "SELECT * FROM participants WHERE student_id='$student' AND event_id='$id'";
        $result = mysqli_query($connect, $sql);
        if(mysqli_num_rows($result) <= 0){

            $sql = "INSERT INTO participants VALUES (null, '$student', '$id')";
    
            try{
                mysqli_query($connect, $sql);
                $message = "Submit success";
            }catch(Exception $e){
                $message = 'Message: ' . $e->getMessage() . " or student does not exist";
            }
        }else{
            $message = "Student already participating";
        }

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

        $sql = "SELECT student_id FROM participants WHERE event_id = '$id'";
        $result = mysqli_query($connect, $sql);
        $data2 = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
            <form action="event-information.php" method="post">
                <div class="sub">
                    <div class="grid">
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
                        <span class="padding">
                            <caption><h4>Participants</h4></caption>
                            <div>
                                <label for="student">Student ID: </label>
                                <input class="details"  type="text" name="student" id="student" maxlength="10" value="<?php echo htmlspecialchars($student); ?>" placeholder="2020-12345">
                            </div>
                            <div style="text-align: center;">
                                <button class="submit" name="add" id="add">ADD</button>
                            </div>
                            <!-- Start of foreach -->
                            <div style="text-align: center;"><i class="fa-solid fa-user"></i></div>
                            <?php foreach($data2 as $entry2): ?> 
                                <div style="text-align: center;"><?php echo htmlspecialchars($entry2['student_id']); ?></div>
                            <?php endforeach; ?>
                            <!-- endforeach -->
                            <div class="right">
                                <input type="checkbox" name="edit" id="edit">
                                <label for="edit">EDIT</label>
                            </div>
                            <div>
                                <input class="details"  type="hidden" name="id" id="id" value="<?php echo htmlspecialchars($data['id']); ?>">
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