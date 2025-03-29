<?php
header("Content-Type: application/json");

$database = new mysqli("localhost", "username", "password", "database_name");

if ($database->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed"]);
    exit();
}

$data = json_decode(file_get_contents("php://input"));

if (isset($data->email)) {
    $email = $database->real_escape_string($data->email);
    $query = "INSERT INTO subscribers (email) VALUES ('$email')";

    if ($database->query($query)) {
        echo json_encode(["success" => true, "message" => "Email added"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error adding email"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid data"]);
}

$database->close();
?>
