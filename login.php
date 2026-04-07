<?php
session_start();

$error = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'];
    
    
    if ($password === "hostel123") {
       
        $_SESSION['admin_logged_in'] = true;
        
        header("Location: admin.php");
        exit;
    } else {
        $error = "Incorrect Password! Nice try.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HostelDrop - Admin Login</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body { background-color: var(--background-color); display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background: white; padding: 40px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 350px; text-align: center; }
        .login-box h2 { color: var(--primary-color); margin-bottom: 20px; }
        .login-box input { width: 100%; padding: 12px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; font-size: 16px; }
        .login-box input:focus { border-color: var(--primary-color); outline: none; }
        .login-btn { background: var(--primary-color); color: white; border: none; padding: 15px; width: 100%; border-radius: 8px; font-weight: bold; font-size: 16px; cursor: pointer; }
        .login-btn:hover { background: #e66000; }
        .error-text { color: #d9534f; margin-bottom: 15px; font-weight: bold; }
    </style>
</head>
<body>

    <div class="login-box">
        <h2>⚙️ Admin Access</h2>
        
        <?php if($error) echo "<div class='error-text'>$error</div>"; ?>
        
        <form method="POST" action="login.php">
            <input type="password" name="password" placeholder="Enter Admin Password" required>
            <button type="submit" class="login-btn">Login</button>
        </form>
        
        <a href="index.php" style="display: block; margin-top: 20px; color: #666; text-decoration: none;">← Back to Store</a>
    </div>

</body>
</html>