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

<div class="dashboard-layout">

<!-- Sidebar -->
<div class="sidebar">

<h2>Finance App</h2>

<a href="../dashboard/dashboard.php">Dashboard</a>
<a href="../accounts/view_accounts.php">Accounts</a>
<a href="../categories/view_categories.php">Categories</a>
<a href="../transactions/view_transactions.php">Transactions</a>
<a href="../reports/monthly_report.php">Reports</a>
<a href="../auth/logout.php">Logout</a>

</div>

<!-- Main Content -->
<div class="main-content">

<h1>Smart Personal Finance & Tax Management System</h1>

<p class="welcome">
Welcome <?php echo $_SESSION['user_name']; ?>
</p>

<div class="cards">

<div class="card">
<h3>Accounts</h3>
<p>Manage your financial accounts</p>
</div>

<div class="card">
<h3>Transactions</h3>
<p>Track income and expenses</p>
</div>

<div class="card">
<h3>Reports</h3>
<p>View monthly financial reports</p>
</div>

</div>

</div>

</div>

</body>
</html>