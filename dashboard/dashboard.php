<?php
include '../auth/auth_check.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>

<body>

<h1>Dashboard</h1>

<p>Welcome <?php echo $_SESSION['user_name']; ?></p>

<ul>
    <li><a href="../accounts/view_accounts.php">Accounts</a></li>
    <li><a href="../categories/view_categories.php">Categories</a></li>
    <li><a href="../transactions/view_transactions.php">Transactions</a></li>
    <li><a href="../reports/monthly_report.php">Reports</a></li>
    <li><a href="../auth/logout.php">Logout</a></li>
</ul>

</body>
</html>