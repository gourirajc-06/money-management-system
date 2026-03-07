<?php
include '../auth/auth_check.php';
include '../config/db_connect.php';

$result = $conn->query("SELECT * FROM transactions ORDER BY transaction_date DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Transactions</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<div class="dashboard-layout">

<?php include '../includes/sidebar.php'; ?>

<div class="main-content">

<h1>Transactions</h1>

<a href="add_transaction.php">Add Transaction</a>

<br><br>

<?php
while($row = $result->fetch_assoc()){
?>

<div class="card">

<p>
<strong>ID:</strong> <?php echo $row['transaction_id']; ?> |
<strong>Account:</strong> <?php echo $row['account_id']; ?> |
<strong>Category:</strong> <?php echo $row['category_id']; ?> |
<strong>Amount:</strong> ₹<?php echo $row['amount']; ?> |
<strong>Type:</strong> <?php echo $row['transaction_type']; ?> |
<strong>Date:</strong> <?php echo $row['transaction_date']; ?>
</p>

</div>

<br>

<?php
}
?>

</div>

</div>

</body>
</html>