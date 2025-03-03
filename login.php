<?php
session_start();
$servername = "localhost";
$username = "vkarthik";
$password = "";
$dbname = "event_ticketing";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Database connection failed"]));
}

$email = $_POST['email'];
$pass = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email' AND password='$pass'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $_SESSION['user'] = $email;
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false]);
}

$conn->close();
?>
