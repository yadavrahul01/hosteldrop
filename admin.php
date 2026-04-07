<?php
session_start();


if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}


require_once 'api/db_connect.php';



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    
    $name = $_POST['name'];
    $price = $_POST['price'];
        $category = $_POST['category'];
    
    
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $fileName = basename($_FILES["image"]["name"]);
        $targetDirectory = "images/";
        $targetFilePath = $targetDirectory . $fileName;
        
        if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
               $stmt = $conn->prepare("INSERT INTO products (name, price, image, category) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdss", $name, $price, $targetFilePath, $category);
            
            if ($stmt->execute()) {
                $message = "<div class='success-msg'>Item uploaded successfully!</div>";
            } else {
                $message = "<div class='error-msg'>Database Error: " . $conn->error . "</div>";
            }
            $stmt->close();
        } else {
            $message = "<div class='error-msg'>Error uploading image file.</div>";
        }
    } else {
        $message = "<div class='error-msg'>Please select an image file.</div>";
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['mark_delivered'])) {
    $orderId = $_POST['order_id'];
    
    
    $updateStmt = $conn->prepare("UPDATE orders SET status = 'Delivered' WHERE id = ?");
    $updateStmt->bind_param("i", $orderId);
    
    if ($updateStmt->execute()) {
        $message = "<div class='success-msg'>Order #{$orderId} marked as Delivered!</div>";
    } else {
        $message = "<div class='error-msg'>Error updating order: " . $conn->error . "</div>";
    }
    $updateStmt->close();
}


$ordersQuery = "SELECT * FROM orders ORDER BY created_at DESC";
$ordersResult = $conn->query($ordersQuery);
$messages_result = $conn->query("SELECT * FROM messages ORDER BY created_at DESC");

if (!$ordersResult) {
    die("Database Error when fetching orders: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HostelDrop - Admin Dashboard</title>
    <link rel="stylesheet" href="css/style.css"> 
    <style>
        
        .admin-container { max-width: 900px; margin: 40px auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .admin-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #eee; padding-bottom: 20px; margin-bottom: 30px; }
        .store-link { color: var(--primary-color); text-decoration: none; font-weight: bold; border: 2px solid var(--primary-color); padding: 8px 16px; border-radius: 8px; }
        .store-link:hover { background: var(--primary-color); color: white; }
        .form-grid { display: grid; gap: 20px; margin-bottom: 20px; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 8px; color: var(--secondary-color); }
        .form-group input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 16px; }
        .form-group input:focus { border-color: var(--primary-color); outline: none; }
        .form-group input[type="file"] { padding: 9px; background: #f8f9fa; cursor: pointer; }
        .submit-btn { background: var(--primary-color); color: white; border: none; padding: 15px 30px; font-size: 16px; font-weight: bold; border-radius: 8px; cursor: pointer; width: 100%; }
        .submit-btn:hover { background: #e66000; }
        .success-msg { background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c3e6cb; }
        .error-msg { background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>

    <header>
        <h1>⚙️ Admin Dashboard</h1>
    </header>

    <div class="admin-container">
        
                <div class="admin-header">
            <h2>Add New Inventory</h2>
            <div>
                <a href="index.php" class="store-link" style="margin-right: 10px;">← View Storefront</a>
                <a href="logout.php" class="store-link" style="border-color: #d9534f; color: #d9534f;">Logout</a>
            </div>
        </div>



        
        <form method="POST" action="admin.php" enctype="multipart/form-data">
            <div class="form-grid">
                <div class="form-group">
                    <label for="name">Item Name</label>
                    <input type="text" id="name" name="name" placeholder="e.g., Doritos Nacho Cheese" required>
                </div>
                <div class="form-group">
                    <label for="price">Price (₹)</label>
                    <input type="number" step="0.01" id="price" name="price" placeholder="e.g., 40.00" required>
                </div>
                <div class="form-group">
    <label for="category">Category</label>
    <select id="category" name="category" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 16px;">
        <option value="Snacks">Snacks</option>
        <option value="Beverages">Beverages</option>
        <option value="Essentials">Essentials</option>
    </select>
</div>
                <div class="form-group">
                    <label for="image">Upload Product Image</label>
                    <input type="file" id="image" name="image" accept="image/*" required>
                </div>
            </div>
            <button type="submit" name="add_product" class="submit-btn">+ Upload to Store</button>
        </form>
        
        
        <div style="margin-top: 50px; border-top: 2px solid #eee; padding-top: 30px;">
            <h2 style="margin-bottom: 20px; color: var(--secondary-color);">📦 Incoming Orders</h2>
            
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr style="background-color: var(--primary-color); color: white;">
                            <th style="padding: 12px; border-radius: 8px 0 0 0;">Order #</th>
                            <th style="padding: 12px;">Block</th>
                            <th style="padding: 12px;">Room</th>
                            <th style="padding: 12px;">Total</th>
                            <th style="padding: 12px;">Time</th>
                            <th style="padding: 12px;">Status</th>
                            <th style="padding: 12px; border-radius: 0 8px 0 0;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if ($ordersResult && $ordersResult->num_rows > 0) {
                            while($row = $ordersResult->fetch_assoc()) {
                                
                                $orderTime = date("h:i A (M j)", strtotime($row['created_at']));
                                $statusColor = ($row['status'] == 'Pending') ? '#ffc107' : '#28a745';
                                
                                echo "<tr style='border-bottom: 1px solid #eee;'>
                                        <td style='padding: 12px; font-weight: bold;'>#{$row['id']}</td>
                                        <td style='padding: 12px;'>{$row['hostel_block']}</td>
                                        <td style='padding: 12px; font-weight: bold;'>{$row['room_number']}</td>
                                        <td style='padding: 12px;'>₹{$row['total_price']}</td>
                                        <td style='padding: 12px; color: #666; font-size: 14px;'>{$orderTime}</td>
                                        <td style='padding: 12px;'>
                                            <span style='background-color: {$statusColor}; color: #000; padding: 4px 8px; border-radius: 4px; font-size: 14px; font-weight: bold;'>
                                                {$row['status']}
                                            </span>
                                        </td>
                                        <td style='padding: 12px;'>";
                                        
                               
                                if ($row['status'] == 'Pending') {
                                    echo "<form method='POST' action='admin.php' style='margin: 0;'>
                                            <input type='hidden' name='order_id' value='{$row['id']}'>
                                            <button type='submit' name='mark_delivered' style='background: #28a745; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-weight: bold; font-size: 12px;'>✓ Deliver</button>
                                          </form>";
                                } else {
                                    echo "<span style='color: #666; font-size: 12px; font-weight: bold;'>Done ✓</span>";
                                }
                                
                                echo "</td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7' style='padding: 20px; text-align: center; color: #666;'>No orders yet! Waiting for students to get hungry...</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>





