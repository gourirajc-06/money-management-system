<?php
include '../auth/auth_check.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<div class="container">

<h1>Dashboard</h1>

<p>Welcome <?php echo $_SESSION['user_name']; ?></p>

<ul>
<li><a href="../accounts/view_accounts.php">View Accounts</a></li>
<li><a href="../categories/view_categories.php">View Categories</a></li>
<li><a href="../transactions/view_transactions.php">View Transactions</a></li>
<li><a href="../reports/monthly_report.php">Monthly Report</a></li>
<li><a href="../auth/logout.php">Logout</a></li>
</ul>

</div>

</body>
</html>