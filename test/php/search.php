<?php
    session_start();

    if(!isset($_SESSION['id']) || $_SESSION['authorization'] != "Admin"){
        header("Location: home.php");
    }

    include '../config/admin.php';

    $page = $_SERVER['PHP_SELF'];
    $search = $_COOKIE['search'] ?? '';
    $table = $_COOKIE['table'] ?? 'Students';
    
    $message = 'No Data';
    $students = $address = $parents = $accounts = '';

    $success = false;

    if(isset($_POST['search'])){

        setcookie('search', $_POST['keyword'], time() + 60);
        setcookie('table', $_POST['tables'], time() + 60);

        header("Location: ".$page);
    }

    if(isset($_COOKIE['search'])){
        if($table == "Students"){

            $sql = "SELECT * FROM students WHERE 
                id LIKE '%$search%' OR 
                email LIKE '%$search%' OR 
                sex LIKE '%$search%' OR 
                first_name LIKE '%$search%' OR 
                middle_name LIKE '%$search%' OR 
                last_name LIKE '%$search%' OR 
                suffix LIKE '%$search%' OR
                course LIKE '%$search%' OR
                year LIKE '%$search%' OR 
                skills LIKE '%$search%' LIMIT 10";  

            $students = 'selected="selected"';
        }
        elseif($table == "Address"){
            
            $sql = "SELECT * FROM students WHERE
                id LIKE '%$search%' OR 
                first_name LIKE '%$search%' OR
                middle_name LIKE '%$search%' OR
                last_name LIKE '%$search%' OR
                suffix LIKE '%$search%' OR 
                city LIKE '%$search%' OR 
                province LIKE '%$search%' OR 
                postal LIKE '%$search%' OR 
                country LIKE '%$search%' OR 
                contact LIKE '%$search%' LIMIT 10";
                
            $address = 'selected="selected"';
        }
        elseif($table == "Parents"){

            $sql = "SELECT * FROM parents WHERE
                student_id LIKE '%$search%' OR 
                email LIKE '%$search%' OR 
                relationship LIKE '%$search%' OR 
                sex LIKE '%$search%' OR 
                first_name LIKE '%$search%' OR 
                middle_name LIKE '%$search%' OR 
                last_name LIKE '%$search%' OR 
                suffix LIKE '%$search%' OR 
                contact LIKE '%$search%' LIMIT 10";

            $parents = 'selected="selected"';
        }
        elseif($table == "Accounts"){
            $sql = "SELECT student_id, authorization, status FROM accounts WHERE
                student_id LIKE '%$search%' OR 
                authorization LIKE '%$search%' OR 
                status LIKE '%$search%' LIMIT 10";

            $accounts = 'selected="selected"';
        }

        try{
            $result = mysqli_query($admin, $sql);
            $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $success = true;
        }
        catch(Exception $e){
            $message = 'Message: ' . $e->getMessage();
            $success = false;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../templates/head.php'; ?>

    <link rel="stylesheet" type="text/css" href="../css/search.css">
    <script src="../js/search.js"></script>
</head>
<body>
    <header>
        <?php include '../templates/header.php'; ?>
    </header>
    <main>
        <section class="title">
            <h2>Search</h2>
        </section>
        <section class="outer">
            <section class="center"><h2 id="heading"><?php echo $table; ?></h2></section>
            <section class="search center">
                <form action="<?php echo $page; ?>" method="post" autocomplete="off">
                    <input class="search-box" type="text" name="keyword" id="search" placeholder="Search.." value="<?php echo htmlspecialchars($search); ?>">
                    <select name="tables" id="tables" class="tables">
                        <option value="Students" <?php echo $students; ?>>Students</option>
                        <option value="Address" <?php echo $address; ?>>Address</option>
                        <option value="Parents" <?php echo $parents; ?>>Parents</option>
                        <option value="Accounts" <?php echo $accounts; ?>>Accounts</option>
                    </select>
                    <button name="search" class="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </section>
            <section>
                <table cellspacing="0">
                    <tr class="entry">
                        <?php if($table == "Students"): ?>
                            <th>Student ID</th>
                            <th id="email">E-mail</th>
                            <th id="sex">Sex</th>                    
                            <th>Full Name</th>  
                            <th>Course</th>
                            <th>Year</th>
                            <th>Skills</th>
                        <?php elseif($table == "Address"): ?>
                            <th>Student ID</th>
                            <th>Full Name</th>
                            <th>Address</th>
                            <th id="country">Country</th>
                            <th>Contact</th>
                        <?php elseif($table == "Parents"): ?>
                            <th>Student ID</th>
                            <th>Full Name</th>
                            <th id="email">Parent E-mail</th>
                            <th>Relationship</th>
                            <th id="sex">Sex</th>
                            <th>Contact</th>
                        <?php elseif($table == "Accounts"): ?>
                            <th>Student ID</th>
                            <th>Authorization</th>
                            <th>Status</th>
                        <?php endif; ?>
                    </tr>
                    <?php 
                        if($success && $table == "Students"): 
                            foreach($data as $entry): 
                                if(empty($entry['middle_name'])){
                                    $fullName = $entry['first_name']." ".$entry['last_name']." ".$entry['suffix'];
                                }else{
                                    $fullName = $entry['first_name']." ".substr($entry['middle_name'], 0, 1).". ".$entry['last_name']." ".$entry['suffix'];
                                }
                    ?>
                        <tr class="entry">
                            <td><?php echo htmlspecialchars($entry['id']); ?></td>
                            <td class="mail"><?php echo htmlspecialchars($entry['email']); ?></td>
                            <td class="dsex"><?php echo htmlspecialchars($entry['sex']); ?></td>
                            <td><?php echo htmlspecialchars($fullName); ?></td>
                            <td><?php echo htmlspecialchars($entry['course']); ?></td>
                            <td><?php echo htmlspecialchars($entry['year']); ?></td>
                            <td><?php echo htmlspecialchars($entry['skills']); ?></td>
                            <td><a href="view.php?form=student&id=<?php echo htmlspecialchars($entry['id']); ?>" target="_blank"><i class="fa-solid fa-ellipsis"></i></a></td>
                        </tr>
                    <?php 
                            endforeach;
                        elseif($success && $table == "Address"):
                            foreach($data as $entry):
                                if(empty($entry['middle_name'])){
                                    $fullName = $entry['first_name']." ".$entry['last_name']." ".$entry['suffix'];
                                }else{
                                    $fullName = $entry['first_name']." ".substr($entry['middle_name'], 0, 1).". ".$entry['last_name']." ".$entry['suffix'];
                                }
                                $location = $entry['city'].", ".$entry['province'].", ".$entry['postal'];
                    ?>
                        <tr class="entry">
                            <td><?php echo htmlspecialchars($entry['id']); ?></td>
                            <td><?php echo htmlspecialchars($fullName); ?></td>
                            <td><?php echo htmlspecialchars($location); ?></td>
                            <td class="dcount"><?php echo htmlspecialchars($entry['country']); ?></td>
                            <td><?php echo htmlspecialchars($entry['contact']); ?></td>
                            <td><a href="view.php?form=student&id=<?php echo htmlspecialchars($entry['id']); ?>" target="_blank"><i class="fa-solid fa-ellipsis"></i></a></td>
                        </tr>
                    <?php
                            endforeach;
                        elseif($success && $table == "Parents"):
                            foreach($data as $entry):
                                if(empty($entry['middle_name'])){
                                    $fullName = $entry['first_name']." ".$entry['last_name']." ".$entry['suffix'];
                                }else{
                                    $fullName = $entry['first_name']." ".substr($entry['middle_name'], 0, 1).". ".$entry['last_name']." ".$entry['suffix'];
                                }
                    ?>
                        <tr class="entry">
                            <td><?php echo htmlspecialchars($entry['student_id']); ?></td>
                            <td><?php echo htmlspecialchars($fullName); ?></td>
                            <td class="mail"><?php echo htmlspecialchars($entry['email']); ?></td>
                            <td><?php echo htmlspecialchars($entry['relationship']); ?></td>
                            <td class="dsex"><?php echo htmlspecialchars($entry['sex']); ?></td>
                            <td><?php echo htmlspecialchars($entry['contact']); ?></td>
                            <td><a href="view.php?form=parent&id=<?php echo htmlspecialchars($entry['id']); ?>" target="_blank"><i class="fa-solid fa-ellipsis"></i></a></td>
                        </tr>
                    <?php
                            endforeach;
                        elseif($success && $table == "Accounts"):
                            foreach($data as $entry):
                    ?>
                        <tr class="entry">
                            <td><?php echo htmlspecialchars($entry['student_id']); ?></td>
                            <td class="mail"><?php echo htmlspecialchars($entry['authorization']); ?></td>
                            <td><?php echo htmlspecialchars($entry['status']); ?></td>
                            <td><a href="view.php?form=account&id=<?php echo htmlspecialchars($entry['student_id']); ?>" target="_blank"><i class="fa-solid fa-ellipsis"></i></a></td>
                        </tr>
                    <?php
                            endforeach;
                        endif;
                    ?>
                </table>
                <div class="message">
                    <?php
                        if(isset($result) && mysqli_num_rows($result) == 0){ echo $message; }
                        elseif(!isset($result)) echo "Search Something";
                    ?>
                </div>
            </section>
        </section>
    </main>
    <footer>
        <?php include '../templates/footer.php'; ?>
    </footer>
</body>
</html>
<?php
    if($success){
        mysqli_free_result($result);
        mysqli_close($admin);
    }
?>