<?php

session_start();

include "validate.php";
$user = test_input($_POST['user']);
$userpd = test_input($_POST['pwd']);
$repeat = test_input($_POST['repeat']);

if ($userpd == $repeat) {
    $pwd = password_hash($userpd, PASSWORD_DEFAULT);
} else {
    header('location: index.php');
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "softball";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_check_query = "SELECT * FROM users WHERE username = '$user'";
$result = $conn->query($user_check_query);

if ($result->num_rows > 0) {
    echo "Username taken";
    exit;
}

$sql = "INSERT INTO users (username, password) VALUES ('$user', '$pwd')";

if ($conn->query($sql) === TRUE) {
    echo "Account Created";
    $_SESSION['username'] = $user;
    $_SESSION['error'] = '';
    echo "<br>";
    echo "<a href='index.php'>Menu</a>";
} else {
    echo "Error creating account";
}

$conn->close();
?>
