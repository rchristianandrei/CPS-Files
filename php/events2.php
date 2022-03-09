<?php 

    session_start();

    if(!isset($_SESSION['login'])){
        session_abort();
        header('Location: index.php');
    }

    include '../config/connection.php';
    $sql = "SELECT * FROM events ORDER BY date, time LIMIT 10";
    $result = mysqli_query($connect, $sql);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../templates/head.php' ?>
    <link rel="stylesheet" href="../css/events2.css">
    <style>
        #events{
            opacity: 50%;
        }
    </style>
</head>
<body>
    <header>
        <?php include '../templates/header.php' ?>
    </header>
    <main>
        <section class="title">
            <h2>Events</h2>
        </section>
        <section>
            <h3>CPS EVENTS</h3>
            <p>Information on past and upcoming events of CPS organization and School wide events will be placed here. Schedules of the upcoming Events will also be here for the CPS members, Officers and Admins to see.</p>
        </section>
        <section>
            <h3>Schedule</h3>
            <div class="grid">
                <!-- Start foreach -->
                <?php foreach($data as $entry): ?>
                <div class="row">
                    <div class="grid-items"><?php echo htmlspecialchars($entry['date']) ?></div>
                    <div class="grid-items red-text"><?php echo htmlspecialchars($entry['status']) ?></div>
                    <h2 class="grid-items"><?php echo htmlspecialchars($entry['event']) ?></h2>
                    <p class="grid-items"><?php echo htmlspecialchars($entry['details']) ?></p>
                    <div class="grid-items">
                        <i class="fa-solid fa-clock"></i>
                        <div><?php echo htmlspecialchars($entry['time']) ?></div>
                    </div>
                    <div class="grid-items">
                        <i class="fa-solid fa-location-pin"></i>
                        <div><?php echo htmlspecialchars($entry['location']) ?></div>
                    </div>
                    <div class="grid-items">
                        <i class="fa-solid fa-user"></i>
                        <!-- Iterate through participants -->
                        
                        <div></div>
                        
                        <!-- endforeach -->
                    </div>
                </div>
                <?php endforeach; ?>
                <!-- endforech -->
            </div>
        </section>
        <section>
            <h3>Past Events</h3>
            <div class="grid">
                <!-- same style as the one on the top -->
            </div>
        </section>
    </main>
    <footer>
        <?php include '../templates/footer.php' ?>
    </footer>
</body>
</html>