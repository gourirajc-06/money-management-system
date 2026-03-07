<?php
include '../auth/auth_check.php';
include '../includes/header.php';
?>

<?php include '../includes/sidebar.php'; ?>

<div class="main-content">

<h1>Smart Personal Finance & Tax Management System</h1>

<p>Welcome <?php echo $_SESSION['user_name']; ?></p>

<div class="cards">

<div class="card">
<h3>Accounts</h3>
<p>Manage your financial accounts</p>
</div>

<div class="card">
<h3>Transactions</h3>
<p>Track your income and expenses</p>
</div>

<div class="card">
<h3>Reports</h3>
<p>View monthly financial reports</p>
</div>

</div>

</div>

<?php include '../includes/footer.php'; ?>