<?php
/* Database connection start */
$servername = "sql105.epizy.com";
$username = "epiz_33070717";
$password = "WBtcNlYDj3Y5qkD";
$dbname = "epiz_33070717_cbt_db";
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>
