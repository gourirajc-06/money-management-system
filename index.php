<?php
session_start();
include 'config/db_connect.php';

if(!isset($_SESSION['user_id'])){
    header("Location: auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Money Management Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<h1>Smart Personal Finance & Tax Management System</h1>

<p>Welcome <?php echo $_SESSION['user_name']; ?></p>

<ul>
    <li><a href="accounts/view_accounts.php">View Accounts</a></li>
    <li><a href="categories/view_categories.php">View Categories</a></li>
    <li><a href="transactions/view_transactions.php">View Transactions</a></li>
    <li><a href="reports/monthly_report.php">Monthly Report</a></li>
    <li><a href="auth/logout.php">Logout</a></li>
</ul>

<script src="assets/js/script.js"></script>

</body>
</html>