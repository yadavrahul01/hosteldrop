<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db_connect.php';


$category = isset($_GET['category']) ? $_GET['category'] : 'All';


if ($category === 'All' || $category === 'All Items') {
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);
} else {
    
    $stmt = $conn->prepare("SELECT * FROM products WHERE category = ?");
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
}

$products = array();

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

echo json_encode($products);
$conn->close();
?>