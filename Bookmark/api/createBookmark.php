<?php
// Allow requests from any origin
header("Access-Control-Allow-Origin: *");
// Allow specific HTTP methods (e.g., GET, POST, PUT, DELETE)
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
// Allow specific HTTP headers
header("Access-Control-Allow-Headers: Content-Type");

include('../db/db_connection.php');

// Get data from the request
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->URL) && !empty($data->title)) {
    $URL = $data->URL;
    $title = $data->title;
    
    // Insert the new bookmark into the database
    $sql = "INSERT INTO Bookmark (URL, title) VALUES ('$URL', '$title')";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "Bookmark created successfully."));
    } else {
        echo json_encode(array("message" => "Error: " . $sql . "<br>" . $conn->error));
    }
} else {
    echo json_encode(array("message" => "URL and title are required."));
}

$conn->close();
?>
