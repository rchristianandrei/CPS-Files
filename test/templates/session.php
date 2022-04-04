<?php
    if($page != "/test/html/search.php" && isset($_SESSION['search'])){
        unset($_SESSION['search']);
        unset($_SESSION['table']);
    }
?>