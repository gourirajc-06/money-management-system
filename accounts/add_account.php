<?php
session_start();
include '../config/db_connect.php';

// 🔐 Check if user is logged in
if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$message = "";

if(isset($_POST['submit'])){
    $name = $_POST['account_name'];
    $balance = $_POST['balance'];

    // ✅ Insert account with user_id
    $sql = "INSERT INTO accounts (account_name, balance, user_id)
            VALUES ('$name', '$balance', '$user_id')";

    if($conn->query($sql)){
        $message = "Account added successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Account</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<div class="container">

    <h2>Add Account</h2>

    <!-- Success/Error Message -->
    <?php
    if($message != ""){
        echo "<p style='color:green;'>$message</p>";
    }
    ?>

    <!-- Form -->
    <form method="POST">

        <label>Account Name</label><br>
        <input type="text" name="account_name" required><br><br>

        <label>Balance</label><br>
        <input type="number" name="balance" required><br><br>

        <button type="submit" name="submit">Add Account</button>

    </form>

    <br>

    <!-- Navigation -->
    <a href="../dashboard/dashboard.php">← Back to Dashboard</a>

</div>

<script src="../assets/js/script.js"></script>

</body>
</html>