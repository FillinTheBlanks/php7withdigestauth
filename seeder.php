<?php

// Connect to MySQL
include('db.php');


$selectUserSql = "SELECT * FROM Users";
$stmt = $mysqli->query($selectUserSql);
echo "Select returned %d rows.\n", $stmt->num_rows;
$stmt->close();

// Seed users
$numberOfUsers = 3000;
$numberOfActive = (int)($numberOfUsers * 0.9);

$numberOfInactiveUsers = $numberOfUsers - $numberOfActive;

$selectUserSql = "SELECT COUNT(user_id) rowcount FROM Users";
    $stmt = $mysqli->query($selectUserSql);
    $rows = $stmt->fetch_all(MYSQLI_ASSOC);
    
    foreach ($rows as $row) {
        $rowcount = $row["rowcount"];
        echo "Select returned {$row["rowcount"]} rows.\n";
    }
    $stmt->close();

// Generate random user data
if($rowcount >= $numberOfUsers) {
$users = [];
for ($i = 0; $i < $numberOfUsers; $i++) {
    $name = generateRandomName();
    $isActive = $i < $numberOfActive ? 1 : 0;
    $users[] = [$name, $isActive];
}

 //Insert users into database
    $insertUserSql = "INSERT INTO Users (username, active) VALUES (?, ?)";
    $stmt = $mysqli->prepare($insertUserSql);
    $stmt->bind_param('si', $name, $isActive);

    foreach ($users as $user) {
        $name = $user[0];
        $isActive = $user[1];
        $stmt->execute();
    }

    $stmt->close();
}

// Seed history
$startDate = strtotime('2023-05-01');
$endDate = strtotime('2024-06-30');
$numberOfHistories = 3000000;

// Generate random history data
$histories = [];
$rowcount = 0;

while($rowcount <= $numberOfHistories) {
    $time_start = microtime(true);
    $time_end = microtime(true);

    $selectUserSql = "SELECT COUNT(history_id) rowcount FROM Histories";
    $stmt = $mysqli->query($selectUserSql);
    $rows = $stmt->fetch_all(MYSQLI_ASSOC);

    $time = $time_end - $time_start;

    if($time > 29){
        $mysqli->close();
        usleep(100);
    }

    foreach ($rows as $row) {
        $rowcount = $row["rowcount"];
        echo "Select returned {$row["rowcount"]} rows.\n";
    }
    $stmt->close();

    for ($i = 0; $i < 1000; $i++) {
        $userId = rand(1, $numberOfUsers);
        $amount = (float) generateRandomNumber(4) . '.' . generateRandomNumber(2);
        $datetime = date('Y-m-d H:i:s', mt_rand($startDate, $endDate));
        $country = generateRandomCountry();
        $isActive = $i < $numberOfActive ? 1 : 0;
        $histories[] = [$userId,$amount,$country, $datetime,$isActive];
    }

    // Insert histories into database
    $insertHistorySql = "INSERT INTO Histories (user_id,amount,country, datetime,active) VALUES (?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($insertHistorySql);
    $stmt->bind_param('idssi', $userId, $amount, $country, $datetime, $isActive);

    foreach ($histories as $history) {
        $userId = $history[0];
        $amount = $history[1];
        $country = $history[2];
        $datetime = $history[3];
        $isActive = $history[4];
        $stmt->execute();
    }
    $stmt->close();
   
}

echo "Seeding completed successfully.";

// Close connection
//$mysqli->close();
// Function to generate random username
function generateRandomName() {
    $firstNames = ['John', 'Jane', 'Michael', 'Emily', 'William', 'Olivia', 'James', 'Sophia', 'Benjamin', 'Emma'];
    $lastNames = ['Smith', 'Johnson', 'Williams', 'Brown', 'Jones', 'Garcia', 'Miller', 'Davis', 'Rodriguez', 'Martinez'];
    $firstName = $firstNames[array_rand($firstNames)];
    $lastName = $lastNames[array_rand($lastNames)];
    $randomString = generateRandomString(4);
    $username = (string) $firstName . $lastName . $randomString;
    return $username;
}

// Function to generate random string
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

// Function to generate random number
function generateRandomNumber($length = 10) {
    $characters = '0123456789';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

// Function to generate random country
function generateRandomCountry() {
    $countries = ['USA', 'Canada', 'UK', 'Australia', 'Germany', 'France', 'Italy', 'Spain', 'Japan', 'China','Taiwan','Indonesia',
    'Malaysia','Philippines','Ecuador','Mexico','UAE','Brunei','Colombia','Croatia','Greece','India','Iran'];
    return $countries[array_rand($countries)];
}
?>