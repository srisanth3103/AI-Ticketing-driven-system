<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "event_ticketing";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT booking_id, movie_name, transactions FROM movie_bookings";
$result = $conn->query($sql);

$notifications = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notifications[] = array(
            "booking_id" => $row["booking_id"],
            "movie_name" => $row["movie_name"],
            "transactions" => $row["transactions"]
        );
    }
}

echo json_encode($notifications);

$conn->close();
?>
