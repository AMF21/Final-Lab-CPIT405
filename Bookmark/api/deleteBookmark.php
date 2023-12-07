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

    // Delete the bookmark with the specified ID from the database
    $sql = "DELETE FROM Bookmark WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "Bookmark deleted successfully."));
    } else {
        echo json_encode(array("message" => "Error: " . $sql . "<br>" . $conn->error));
    }
} else {
    echo json_encode(array("message" => "ID parameter is required."));
}

$conn->close();
?>
