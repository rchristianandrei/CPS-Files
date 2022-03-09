<?php
    session_start();
    $_SESSION['page'] = "Edit";

    if(!isset($_SESSION['login'])){
        session_abort();
        header('Location: index.php');
    }

    include '../config/connection.php';
    $message = "";


    if(isset($_GET['id'])){
        initialInfo();
    }elseif(isset($_POST['submit'])){
        update();
    }elseif(isset($_POST['delete'])){
        delete();
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
            <h2>Profile</h2>
            <h3>Parent / Guardian Info</h3>
            <form action="parent-information2.php" method="post">
                <div class="sub">
                    <div class="grid">
                        <span class="padding">
                            <caption><h4>Primary</h4></caption>
                            <div>
                                <label for="">Student ID: </label>
                                <span class="center right"><?php echo htmlspecialchars($data['student_id']); ?></span>
                            </div>
                            <div>
                                <label for="mail">E-mail: </label>
                                <input class="details"  type="text" name="mail" id="mail" maxlength="30" value="<?php echo htmlspecialchars($data['email']); ?>">
                            </div>
                            <div>
                                <label for="fname">First Name: </label>
                                <input class="details"  type="text" name="fname" id="fname" maxlength="30" value="<?php echo htmlspecialchars($data['first_name']); ?>">
                            </div>
                            <div>
                                <label for="mname">Middle Name: </label>
                                <input class="details"  type="text" name="mname" id="mname" maxlength="15" value="<?php echo htmlspecialchars($data['middle_name']); ?>">
                            </div>
                            <div>
                                <label for="lname">Last Name: </label>
                                <input class="details"  type="text" name="lname" id="lname" maxlength="20" value="<?php echo htmlspecialchars($data['last_name']); ?>">
                            </div>
                            <div>
                                <label for="suffix">Suffix: </label>
                                <input class="details"  type="text" name="suffix" id="suffix" maxlength="20" maxlength="4" value="<?php echo htmlspecialchars($data['suffix']); ?>">
                            </div>
                            <div>
                                <label for="">Sex: </label>
                                <span class="center right"><?php echo htmlspecialchars($data['sex']); ?></span>
                            </div>
                            <div>
                                <label for="">Relationship: </label>
                                <span class="center right"><?php echo htmlspecialchars($data['relationship']); ?></span>
                            </div>
                        </span>
                        <span class="padding">
                            <caption><h4>Address</h4></caption>
                            <div>
                                <label for="street">Street: </label>
                                <input class="details"  type="text" name="street" id="street" maxlength="40" value="<?php echo htmlspecialchars($data['street']); ?>">
                            </div>
                            <div>
                                <label for="city">City: </label>
                                <input class="details"  type="text" name="city" id="city" maxlength="20" value="<?php echo htmlspecialchars($data['city']); ?>">
                            </div>
                            <div>
                                <label for="postal">Postal Code: </label>
                                <input class="details"  type="text" name="postal" id="postal" max="9999" value="<?php echo htmlspecialchars($data['postal']); ?>">
                            </div>
                            <div>
                                <label for="province">Province: </label>
                                <input class="details"  type="text" name="province" id="province" maxlength="20" value="<?php echo htmlspecialchars($data['province']); ?>">
                            </div>
                            <div>
                                <label for="country">Country: </label>
                                <input class="details"  type="text" name="country" id="country" maxlength="15" value="<?php echo htmlspecialchars($data['country']); ?>">
                            </div>
                            <div>
                                <label for="contact">Contact: </label>
                                <input class="details"  type="text" name="contact" id="contact" maxlength="11" value="<?php echo htmlspecialchars($data['contact']); ?>">
                            </div>

                            <hr>

                            <div>
                                <label for="">Date Created: </label>
                                <span class="center right"><?php echo htmlspecialchars($data['created_at']); ?></span>
                            </div>
                            <div class="right">
                                <input type="checkbox" name="edit" id="edit">
                                <label for="edit">EDIT</label>
                            </div>
                            <div>
                                <input class="details"  type="hidden" name="id" id="id" value="<?php echo htmlspecialchars($data['id']); ?>">
                            </div>
                        </span>
                    </div>
                    <div class="message" style="color: <?php if($message == "Update success"){echo 'green';}else{
                        echo 'red';
                    } ?>"><?php echo htmlspecialchars($message); ?></div>
                    <div class="buttons">
                        <button class="submit" name="submit" id="submit">Update</button>
                        <button class="delete" name="delete" id="delete">Delete</button>
                    </div>
                    <script src="../js/view_parent.js"></script>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
<?php
    function initialInfo(){
        global $result, $message , $connect, $data;

        $id = mysqli_real_escape_string($connect, $_GET['id']);
        $sql = "SELECT * FROM parents WHERE id = '$id'";
        $result = mysqli_query($connect, $sql);

        if(mysqli_num_rows($result) == 1){

            $data = mysqli_fetch_assoc($result);
    
        }else{
            $message = "student not found";
        }

        
    }
    function update(){
        global $result, $data, $message, $connect;

        $id = mysqli_real_escape_string($connect, $_POST['id']);
        $mail = mysqli_real_escape_string($connect, $_POST['mail']);
        $firstName = mysqli_real_escape_string($connect, $_POST['fname']);
        $midName = mysqli_real_escape_string($connect, $_POST['mname']);
        $lastName = mysqli_real_escape_string($connect, $_POST['lname']);
        $suffix = mysqli_real_escape_string($connect, $_POST['suffix']);
        $street = mysqli_real_escape_string($connect, $_POST['street']);
        $city = mysqli_real_escape_string($connect, $_POST['city']);
        $province = mysqli_real_escape_string($connect, $_POST['province']);
        $postal = mysqli_real_escape_string($connect, $_POST['postal']);
        $country = mysqli_real_escape_string($connect, $_POST['country']);
        $contact = mysqli_real_escape_string($connect, $_POST['contact']);

        $sql = "UPDATE parents SET 
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
            WHERE id = '$id'";

        if(mysqli_query($connect, $sql)){
            $message = "Update success";
        }else{
            $message = "Error " . mysqli_error($connect);
        }

        $sql = "SELECT * FROM parents WHERE id = '$id'";
        $result = mysqli_query($connect, $sql);
        $data = mysqli_fetch_assoc($result);
    }
    function delete(){
        global $result, $data, $connect, $message;

        $id = mysqli_real_escape_string($connect, $_POST['id']);

        $sql = "DELETE FROM parents WHERE id='$id'";

        try{
            mysqli_query($connect, $sql);
            echo "<script type=\"text/javascript\">window.close();</script>";
        }catch(Exception $e){
            $message = 'Message: ' . $e->getMessage();
        }

        $sql = "SELECT * FROM parents WHERE id = '$id'";
        $result = mysqli_query($connect, $sql);
        $data = mysqli_fetch_assoc($result);
    }
?>