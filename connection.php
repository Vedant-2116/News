<?php

$conn = new mysqli('localhost', 'root', '', 'News');

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "";
?>