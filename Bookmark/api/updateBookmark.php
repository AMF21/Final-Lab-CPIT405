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

    // Get data from the request
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->URL) && !empty($data->title)) {
        $URL = $data->URL;
        $title = $data->title;

        // Update the bookmark with the specified ID in the database
        $sql = "UPDATE Bookmark SET URL = '$URL', title = '$title' WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(array("message" => "Bookmark updated successfully."));
        } else {
            echo json_encode(array("message" => "Error: " . $sql . "<br>" . $conn->error));
        }
    } else {
        echo json_encode(array("message" => "URL and title are required."));
    }
} else {
    echo json_encode(array("message" => "ID parameter is required."));
}

$conn->close();
?>
