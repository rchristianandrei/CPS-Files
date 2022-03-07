<?php
    session_start();

    if(!isset($_SESSION['login'])){
        session_abort();
        header('Location: index.php');
    }

    //  Global Variables
    include '../config/connection.php';
    $noData = false;
    $message = '';

    if(isset($_GET['id'])){
        
        initialInfo();

    }elseif(isset($_POST['submit'])){

        submit();
    }elseif(isset($_POST['delete'])){

        delete();
    }

    function initialInfo(){

        //  Global references
        global $data, $connect, $cs, $it, $cpp, $csharp, $c, $java, $py, $js, $cisco;

        $id = mysqli_real_escape_string($connect, $_GET['id']);

        $sql = "SELECT * FROM parents WHERE id = '$id'";
        $result = mysqli_query($connect, $sql);
        $data = mysqli_fetch_assoc($result);

        mysqli_free_result($result);
        mysqli_close($connect);
    }

    function submit(){

        //  Global references
        global $data, $connect, $message;

        $primaryKey = mysqli_real_escape_string($connect, $_POST['id']);
        $id = mysqli_real_escape_string($connect, $_POST['student_id']);
        $mail = mysqli_real_escape_string($connect, $_POST['email']);
        $firstName = mysqli_real_escape_string($connect, $_POST['first_name']);
        $midName = mysqli_real_escape_string($connect, $_POST['middle_name']);
        $lastName = mysqli_real_escape_string($connect, $_POST['last_name']);
        $suffix = mysqli_real_escape_string($connect, $_POST['suffix']);
        $street = mysqli_real_escape_string($connect, $_POST['street']);
        $city = mysqli_real_escape_string($connect, $_POST['city']);
        $province = mysqli_real_escape_string($connect, $_POST['province']);
        $postal = mysqli_real_escape_string($connect, $_POST['postal_code']);
        $country = mysqli_real_escape_string($connect, $_POST['country']);
        $contact = mysqli_real_escape_string($connect, $_POST['contact']);

        $sql = "UPDATE parents SET 
            student_id = '$id',
            email = '$mail',
            first_name = '$firstName',
            middle_name = '$midName',
            last_name = '$lastName',
            suffix = '$suffix',
            street = '$street',
            city = '$city',
            province = '$province',
            postal = '$postal',
            country = '$country',
            contact = '$contact'
            WHERE id = '$primaryKey'";

        if(mysqli_query($connect, $sql)){
            $message = "Update success";
        }else{
            $message = "Error " . mysqli_error($connect);
        }

        $sql = "SELECT * FROM parents WHERE id = '$primaryKey'";
        $result = mysqli_query($connect, $sql);
        $data = mysqli_fetch_assoc($result);

        mysqli_free_result($result);
        mysqli_close($connect);
    }

    function delete(){
        global $result, $data, $connect, $message;

        $id = mysqli_real_escape_string($connect, $_POST['id']);

        $sql = "DELETE FROM parents WHERE id='$id'";

        try{
            mysqli_query($connect, $sql);
            echo "<script type=\"text/javascript\">window.close();</script>";
        }catch(Exception $e){
            $message = 'Message: ' .$e->getMessage();
        }

        $sql = "SELECT * FROM parents WHERE id = '$id'";
        $result = mysqli_query($connect, $sql);
        $data = mysqli_fetch_assoc($result);

        mysqli_free_result($result);
        mysqli_close($connect);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../templates/head.php' ?>

    <link rel="stylesheet" href="../css/view-info.css">
    
</head>
<body>
    <header>
        <?php include '../templates/header.php' ?>
    </header>
    <main>
        <div class="main">
            <h2>Profile</h2>
            <h3>Parent Info</h3>
            <form action="parent-information.php" method="post">
                <div class="sub">
                    <div class="details">
                        <span>
                            <caption><h4>Primary</h4></caption>
                            <div>
                                <label for="student_id">Student ID: </label>
                                <input type="text" id="student_id" name="student_id" size="30" value="<?php echo htmlspecialchars($data['student_id']); ?>" maxlength="10" pattern="[1-9]{1}[0-9]{3}-[0-9]{5}" required>
                            </div>
                            <div>
                                <label for="email">E-mail: </label>
                                <input type="email" id="email" name="email" size="30" maxlength="30" value="<?php echo htmlspecialchars($data['email']); ?>" required>
                            </div>
                            <div>
                                <label for="first_name">First name: </label>
                                <input type="text" id="first_name" name="first_name" maxlength="30" size="30" value="<?php echo htmlspecialchars($data['first_name']); ?>" required>
                            </div>
                            <div>
                                <label for="middle_name">Middle name: </label>
                                <input type="text" id="middle_name" name="middle_name" maxlength="15" size="30" value="<?php echo htmlspecialchars($data['middle_name']); ?>">
                            </div>
                            <div>
                                <label for="last_name">Last name: </label>
                                <input type="text" id="last_name" name="last_name" maxlength="20" size="30" value="<?php echo htmlspecialchars($data['last_name']); ?>" required>
                            </div>
                            <div>
                                <label for="suffix">Suffix: </label>
                                <input type="text" id="suffix" name="suffix" size="30" maxlength="4" value="<?php echo htmlspecialchars($data['suffix']); ?>">
                            </div>
                            <div>
                                <label>Sex: </label><span><?php echo htmlspecialchars($data['sex']); ?></span>
                            </div>
                            <div>
                                <label>Relationship to Student: </label><span><?php echo htmlspecialchars($data['relationship']); ?></span>
                            </div>
        
                        </span>
                        <span>
                            <caption><h4>Address</h4></caption>
                            <div>
                                <label for="street">Street: </label>
                                <input type="text" id="street" name="street" maxlength="40" size="30" value="<?php echo htmlspecialchars($data['street']); ?>" required>
                            </div>
                            <div>
                                <label for="city">City: </label>
                                <input type="text" id="city" name="city" maxlength="20" size="30" value="<?php echo htmlspecialchars($data['city']); ?>" required>
                            </div>
                            <div>
                                <label for="province">Province: </label>
                                <input type="text" id="province" name="province" maxlength="20" size="30" value="<?php echo htmlspecialchars($data['province']); ?>" required>
                            </div>
                            <div>
                                <label for="postal_code">Postal Code: </label>
                                <input type="number" id="postal_code" name="postal_code" size="30" max="9999" value="<?php echo htmlspecialchars($data['postal']); ?>" required>
                            </div>
                            <div>
                                <label for="country">Country: </label>
                                <input type="text" id="country" name="country" maxlength="15" size="30" value="<?php echo htmlspecialchars($data['country']); ?>" required>
                            </div>
                            <div>
                                <label for="contact">Contact: </label>
                                <input type="tel" id="contact" name="contact" maxlength="11" size="30" value="<?php echo htmlspecialchars($data['contact']); ?>" required>
                            </div>
        
                            <hr>
        
                            <div>
                                <label>Date Created: </label><span><?php echo htmlspecialchars($data['created_at']); ?></span>
                            </div>
                            <div>
                                <label>Edit: </label><input type="checkbox" id="edit">
                            </div>
                            <div>
                                <input type="hidden" id="id" name="id" value="<?php echo htmlspecialchars($data['id']); ?>">
                            </div>
                        </span>
                    </div>
                    <center>
                        <div style="color: <?php if($message == "Update success"){ echo "green"; }else{ echo "red"; } ?>"><?php echo $message; ?></div>
                    </center>
                    <div style="display: flex; justify-content: space-between;">
                        <button class="submit" id="submit" name="submit">Save Changes</button>
                        <button style="background-color: black; padding: 10px 40px; border-style: none; border-radius: 10px; color: white;" id="delete" name="delete">DELETE</button>
                    </div>
                </div>
            </form>
            <script src = "../js/edit_parent.js"></script>
        </div>
    </main>
    <footer>
        <?php include '../templates/footer.php' ?>
    </footer>
</body>
</html>