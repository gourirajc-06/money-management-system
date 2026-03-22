<?php
include '../auth/auth_check.php';
include '../config/db_connect.php';
include '../includes/header.php';

// Get logged-in user id
$user_id = $_SESSION['user_id'];
?>

<?php include '../includes/sidebar.php'; ?>

<div class="main-content container mt-4">

<h2 class="mb-4">Smart Personal Finance & Tax Management System</h2>

<p class="mb-4">Welcome <b><?php echo $_SESSION['user_name']; ?></b></p>

<?php

// Total Balance (ONLY this user's ACTIVE accounts)
$totalBalance = $conn->query("
    SELECT SUM(balance) as total 
    FROM accounts 
    WHERE user_id = $user_id
    AND is_active = 1
")->fetch_assoc()['total'] ?? 0;

// Total Income (ONLY this user)
$totalIncome = $conn->query("
    SELECT SUM(amount) as total 
    FROM transactions 
    WHERE transaction_type='Income' 
    AND user_id = $user_id
")->fetch_assoc()['total'] ?? 0;

// Total Expense (ONLY this user)
$totalExpense = $conn->query("
    SELECT SUM(amount) as total 
    FROM transactions 
    WHERE transaction_type='Expense' 
    AND user_id = $user_id
")->fetch_assoc()['total'] ?? 0;

// Get ONLY this user's ACTIVE accounts
$accounts = $conn->query("
    SELECT account_name, balance 
    FROM accounts 
    WHERE user_id = $user_id
    AND is_active = 1
");

?>

<!-- Summary Cards -->

<div class="row mb-4">

<div class="col-md-4">
<div class="card shadow p-3 text-center">
<h5>Total Balance</h5>
<h3>₹<?php echo number_format($totalBalance,2); ?></h3>
</div>
</div>

<div class="col-md-4">
<div class="card shadow p-3 text-center">
<h5>Total Income</h5>
<h3 class="text-success">₹<?php echo number_format($totalIncome,2); ?></h3>
</div>
</div>

<div class="col-md-4">
<div class="card shadow p-3 text-center">
<h5>Total Expense</h5>
<h3 class="text-danger">₹<?php echo number_format($totalExpense,2); ?></h3>
</div>
</div>

</div>

<!-- Account Balances -->

<h5 class="mb-3">Account Balances</h5>

<div class="row mb-4">

<?php
while($row = $accounts->fetch_assoc()){
?>

<div class="col-md-4">

<div class="card shadow p-3 text-center mb-3">

<h6><?php echo $row['account_name']; ?></h6>

<h5>₹<?php echo number_format($row['balance'],2); ?></h5>

</div>

</div>

<?php } ?>

</div>

<!-- Finance Overview -->

<div class="row">

<div class="col-md-6">
<div class="card shadow p-3">
<h5>Finance Overview</h5>

<canvas id="financeChart"></canvas>

</div>
</div>

<div class="col-md-6">

<div class="card shadow p-3 mb-3">
<h5>Accounts</h5>
<p>Manage your financial accounts</p>
</div>

<div class="card shadow p-3 mb-3">
<h5>Transactions</h5>
<p>Track your income and expenses</p>
</div>

<div class="card shadow p-3">
<h5>Reports</h5>
<p>View monthly financial reports</p>
</div>

</div>

</div>

</div>

<script>

const ctx = document.getElementById('financeChart');

new Chart(ctx, {
type: 'pie',
data: {
labels: ['Income', 'Expense'],
datasets: [{
data: [<?php echo $totalIncome ?? 0 ?>, <?php echo $totalExpense ?? 0 ?>],
backgroundColor: ['#28a745','#dc3545']
}]
}
});

</script>

<?php include '../includes/footer.php'; ?>