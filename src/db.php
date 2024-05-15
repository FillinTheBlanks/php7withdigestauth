<?php

date_default_timezone_set('Asia/Hong_Kong');

/* Database connection start */
$host = "host.docker.internal:3306";
$username = "root";
$password = "123abc";
$dbname = "php7test_db";
 
$connect = mysqli_connect($host, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* check connection */
if (mysqli_connect_errno()) {
    echo "Connect failed: %s\n", mysqli_connect_error();
    exit();
}
print("Connected successfully");

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

?>