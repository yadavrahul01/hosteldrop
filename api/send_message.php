<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_connect.php';


$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    $name = $data['name'];
    $room = $data['room'];
    $message = $data['message'];

    $stmt = $conn->prepare("INSERT INTO messages (name, room_details, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $room, $message);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Message sent!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to send message."]);
    }
    $stmt->close();
}
$conn->close();
?>