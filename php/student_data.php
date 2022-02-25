<?php
    //  Connect to databse
    $connect = mysqli_connect('localhost', 'root', '', 'cps');

    //  Check Connection

    if(!$connect){
        echo 'Connection Eror: ' . mysqli_connect_error();
    }

    $sql = "select * from student_data limit 10";

    $result = mysqli_query($connect, $sql);

    //  Get multiple results for showing in table
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="This is a website used ny CPS to update, manage, and delete data about students.">
        <title>CPS-Laguna</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <style> /* CSS for table */
            table {
                width: 80%;
                margin: auto;
                font-size: 30px;
                text-align: center;
                border-collapse: collapse;
            }
            td, th {
                padding: 5px;
                border: 2px solid white;
            }
            #firstName {
                width: 50%;
            }
        </style>
    </head>
    <body>
        <header>
            <img src="../images/cps-logo.png" alt="cps logo" class="logo">
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Events</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </nav>
            <button><a href="index.html">Login</a></button>
        </header>
        <main>
            <table>
                <caption>Student Primary Information Table</caption>
                <tr>
                    <th>Student Id</th>
                    <th>Last Name</th>
                    <th id="firstName">First Name</th>
                    <th>Update</th>
                </tr>
                <?php
                    foreach($data as $entry){
                        echo(
                            "
                            <tr>
                                <td>".$entry['student_id']."</td>
                                <td>".$entry['last_name']."</td>
                                <td>".$entry['first_name']."</td>
                                <td><u>edit</u></td>
                            </tr>
                            "
                        );  
                    }
                ?>
                <!-- <tr>
                    <td>2020-10735</td>
                    <td>Reyes</td>
                    <td>Christian Andrei</td>
                    <td><u>edit</u></td>
                </tr>
                <tr>
                    <td>2020-107xx</td>
                    <td>Daquioag</td>
                    <td>Paolo</td>
                    <td><u>edit</u></td>
                </tr>
                <tr>
                    <td>2020-107xx</td>
                    <td>Galang</td>
                    <td>Justin Ron</td>
                    <td><u>edit</u></td>
                </tr>
                <tr>
                    <td>2020-107xx</td>
                    <td>Arcillas</td>
                    <td>Jeah Raizza</td>
                    <td><u>edit</u></td>
                </tr>
                <tr>
                    <td>2020-107xx</td>
                    <td>Ignacio</td>
                    <td>Iñigo</td>
                    <td><u>edit</u></td>
                </tr> -->
            </table>
        </main>
        <footer>
            <div>
                <img src="../images/footer-logo.jpg" alt="cps logo" class="logo"> 
                <hr>
                <div style="display: flex;">
                    <span class="news">
                        <span>Subscribe to our newsletter</span>
                    </span>
                    <span class="about">
                        <section class="section">
                            <ul>
                                <caption>Site Map</caption>
                                <li><a href="#">Home</a></li>
                                <li><a href="#">About</a></li>
                                <li><a href="#">Events</a></li>
                                <li><a href="#">Contact Us</a></li>
                            </ul>
                        </section>
                        <section class="section">
                            <ul>
                                <caption>About</caption>
                                <li><a href="#">Our Story</a></li>
                                <li><a href="#">Benefits</a></li>
                                <li><a href="#">Team</a></li>
                                <li><a href="#">Carrers</a></li>
                            </ul>
                        </section>
                        <section class="section">
                            <ul>
                                <caption>Follow Us</caption>
                                <li><a href="#">Facebook</a></li>
                                <li><a href="#">Instagram</a></li>
                                <li><a href="#">Twitter</a></li>
                            </ul>
                        </section>
                    </span>
                </div>
                
                <div class="bottom">
                    <span class="rights">
                        © Computer Programming Society. All Rights Reserved.
                    </span>
                    <span class="terms">
                        <span style="margin-right: 40px;">
                            Terms & Condition
                        </span>
                        <span>
                            Privacy Policy
                        </span>
                    </span>
                </div>
            </div>
        </footer>
    </body>
</html>