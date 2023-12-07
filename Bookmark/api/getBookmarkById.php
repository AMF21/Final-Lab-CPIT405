<?php
include('../db/db_connection.php');
// Allow requests from any origin
header("Access-Control-Allow-Origin: *");
// Allow specific HTTP methods (e.g., GET, POST, PUT, DELETE)
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
// Allow specific HTTP headers
header("Access-Control-Allow-Headers: Content-Type");

// Check if an ID parameter is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve the bookmark with the specified ID from the database
    $sql = "SELECT * FROM Bookmark WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $bookmark = $result->fetch_assoc();
        echo json_encode($bookmark);
    } else {
        echo json_encode(array("message" => "Bookmark not found."));
    }
} else {
    echo json_encode(array("message" => "ID parameter is required."));
}

$conn->close();
?>
