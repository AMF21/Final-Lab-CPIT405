<?php
include('../db/db_connection.php');
// Allow requests from any origin
header("Access-Control-Allow-Origin: *");
// Allow specific HTTP methods (e.g., GET, POST, PUT, DELETE)
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
// Allow specific HTTP headers
header("Access-Control-Allow-Headers: Content-Type");

// Retrieve all bookmarks from the database
$sql = "SELECT * FROM Bookmark";
$result = $conn->query($sql);

$bookmarks = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bookmarks[] = $row;
    }
    echo json_encode($bookmarks);
} else {
    echo json_encode(array());
}

$conn->close();
?>
