<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
    error_reporting(1);
    date_default_timezone_set("Asia/Taipei");
    $conn = mysqli_connect("140.125.33.31", "admin", "123EWQasd", "smartkeep");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>

