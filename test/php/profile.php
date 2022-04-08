<?php
    session_start();
    include '../config/admin.php';

    if(!isset($_SESSION['id'])){
        header("Location: home.php");
    }

    $id = $_SESSION['id'];

    $sql = "SELECT * FROM students WHERE id='$id'";
    $result = mysqli_query($admin, $sql);
    $data = mysqli_fetch_assoc($result);

    $pname = $data['last_name'];
    
    if(!empty($data['suffix'])){
        $pname .= $data['suffix'];
    }
    
    $pname .= ", ".$data['first_name'];

    if(!empty($data['middle_name'])){
        $pname .= " ".substr($data['middle_name'], 0, 1).".";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../templates/head.php'; ?>

    <link rel="stylesheet" type="text/css" href="../css/profile.css">
    <script src="../js/profile.js"></script>
</head>
<body>
    <header>
        <?php include '../templates/header.php'; ?>
    </header>
    <main>
        <section class="title">
            <h2>Profile</h2>
        </section>
        <section class="profile">
            <img class="profilepic" src="../images/cps-logo.png" alt="cps logo">
            <section>
                <div class="heading">
                    <div>
                        <h2><?php echo htmlspecialchars($pname); ?></h2>
                        <h4><?php echo $data['year']; ?> Year <?php echo htmlspecialchars($data['course']); ?> - COECS Department</h4>
                    </div>
                    <div>
                    <a href="view.php?form=student&id=<?php echo htmlspecialchars($id); ?>" target="_blank"><button class="edit" id="edit">Edit Profile</button></a>
                    </div>
                </div>
                <hr>
                <section class="information">
                    <div class="flex">
                        <div class="half">Student ID</div>
                        <div class="half"><?php echo htmlspecialchars($data['id']); ?></div>
                    </div>
                    <div class="flex">
                        <div class="half">Email</div>
                        <div class="half"><?php echo htmlspecialchars($data['email']); ?></div>
                    </div>
                    <div class="flex">
                        <div class="half">First Name</div>
                        <div class="half"><?php echo htmlspecialchars($data['first_name']); ?></div>
                    </div>
                    <div class="flex">
                        <div class="half">Middle Name</div>
                        <div class="half"><?php echo htmlspecialchars($data['middle_name']); ?></div>
                    </div>
                    <div class="flex">
                        <div class="half">Last Name</div>
                        <div class="half"><?php echo htmlspecialchars($data['last_name']); ?></div>
                    </div>
                    <div class="flex">
                        <div class="half">Suffix</div>
                        <div class="half"><?php echo htmlspecialchars($data['suffix']); ?></div>
                    </div>
                    <div class="flex">
                        <div class="half">Skills</div>
                        <div class="half"><?php echo htmlspecialchars($data['skills']); ?></div>
                    </div>
                    <div class="flex">
                        <div class="half">City</div>
                        <div class="half"><?php echo htmlspecialchars($data['city']); ?></div>
                    </div>
                    <div class="flex">
                        <div class="half">Postal</div>
                        <div class="half"><?php echo htmlspecialchars($data['postal']); ?></div>
                    </div>
                    <div class="flex">
                        <div class="half">Province</div>
                        <div class="half"><?php echo htmlspecialchars($data['province']); ?></div>
                    </div>
                    <div class="flex">
                        <div class="half">Country</div>
                        <div class="half"><?php echo htmlspecialchars($data['country']); ?></div>
                    </div>
                    <div class="flex">
                        <div class="half">Contact</div>
                        <div class="half"><?php echo htmlspecialchars($data['contact']); ?></div>
                    </div>
                </section>
            </section>
        </section>
        <?php 
            $sql = "SELECT * FROM accounts WHERE student_id='$id'";
            $result = mysqli_query($admin, $sql);
            $data = mysqli_fetch_assoc($result);
        ?>
        <section class="account">
            <section>
                <div class="heading">
                    <div>
                        <h2><?php echo htmlspecialchars($data['authorization']); ?> Account</h2>
                    </div>
                    <div>
                    <a href="view.php?form=account&id=<?php echo htmlspecialchars($id); ?>" target="_blank"><button class="edit" id="edit">Edit Account</button></a>
                    </div>
                </div>
                <hr>
                <section class="information">
                    <div class="flex">
                        <div class="half">Student ID</div>
                        <div class="half"><?php echo htmlspecialchars($data['student_id']); ?></div>
                    </div>
                    <div class="flex">
                        <div class="half">Password</div>
                        <input class="half" type="password" id="password" value="<?php echo htmlspecialchars($data['password']); ?>" disabled>
                    </div>
                    <div class="flex">
                        <div class="half">-</div>
                        <div class="half pointer"><i class="fa-solid fa-eye" id="show"></i></div>
                    </div>
                    <div class="flex">
                        <div class="half">Status</div>
                        <div class="half"><?php echo htmlspecialchars($data['status']); ?></div>
                    </div>
                </section>
            </section>
        </section>
        <?php 
            $sql = "SELECT * FROM parents WHERE student_id='$id'";
            $result = mysqli_query($admin, $sql);
            $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        ?>
        <section class="account">
            <section>
                <div class="heading">
                    <div>
                        <h2>Parent / Guardian</h2>
                    </div>
                    <a href="add.php?form=parent&student_id=<?php echo htmlspecialchars($id); ?>" target="_blank"><button class="edit" id="edit">Add</button></a>
                </div>
                <hr>
                <section class="information">
                    <table>
                        <tr class="table">
                            <th>Full Name</th>
                            <th id="email">Parent E-mail</th>
                            <th>Relationship</th>
                            <th id="sex">Sex</th>
                            <th>Contact</th>
                        </tr>
                        <?php foreach($data as $entry): 
                                if(empty($entry['middle_name'])){
                                    $fullName = $entry['first_name']." ".$entry['last_name']." ".$entry['suffix'];
                                }else{
                                    $fullName = $entry['first_name']." ".substr($entry['middle_name'], 0, 1).". ".$entry['last_name']." ".$entry['suffix'];
                                }
                        ?>
                        <tr class="half">
                            <td><?php echo htmlspecialchars($fullName); ?></td>
                            <td class="mail"><?php echo htmlspecialchars($entry['email']); ?></td>
                            <td><?php echo htmlspecialchars($entry['relationship']); ?></td>
                            <td class="dsex"><?php echo htmlspecialchars($entry['sex']); ?></td>
                            <td><?php echo htmlspecialchars($entry['contact']); ?></td>
                            <td><a href="view.php?form=parent&id=<?php echo htmlspecialchars($entry['id']); ?>" target="_blank"><i class="fa-solid fa-ellipsis"></i></a></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </section>
            </section>
        </section>
    </main>
    <footer>
        <?php include '../templates/footer.php'; ?>
    </footer>
</body>
</html>