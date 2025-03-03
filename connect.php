<?php

$servername = "localhost";
$username = "Vkarthik";
$password = "";
$dbname = "event_ticketing";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $passwordValue = $_POST['password'];
    $repassword = $_POST['repassword'];
    
    if ($passwordValue !== $repassword) {
        echo '<script>alert("password and repassword are not same"); window.location = "registration.html";</script>';
        exit; 
    }

    $password_hash = password_hash($passwordValue, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO event_ticketing (firstname, lastname, email, password_hash, repassword) VALUES (?, ?, ?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param("sssss", $firstname, $lastname, $email, $password_hash, $repassword);
        
        if ($stmt->execute()) {
            header("Location: login.html");
            exit();
        } else {
            echo '<script>alert("password and repassword are not same"); window.location = "registration.html";</script>';
            exit();
        }
        
        $stmt->close();
    } else {    
        echo '<script>alert("unable to register"); window.location = "registration.html";</script>';
    }
}

$conn->close();
?>