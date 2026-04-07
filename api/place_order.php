<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

require_once 'db_connect.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["status" => "error", "message" => "No data received"]);
    exit;
}

$block = $data['block'];
$room = $data['room'];
$totalPrice = $data['totalPrice'];



$stmt = $conn->prepare("INSERT INTO orders (hostel_block, room_number, total_price, status) VALUES (?, ?, ?, 'Pending')");
$stmt->bind_param("ssd", $block, $room, $totalPrice);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Order saved to database!"]);
} else {
    echo json_encode(["status" => "error", "message" => "SQL Error: " . $conn->error]);
}

$stmt->close();
$conn->close();
?>