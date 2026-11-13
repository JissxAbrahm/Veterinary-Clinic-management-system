<?php
$conn = new mysqli("localhost", "root", "", "vet_db", 3306);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>