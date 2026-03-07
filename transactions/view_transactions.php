<?php
include '../auth/auth_check.php';
include '../config/db_connect.php';
include '../includes/header.php';
?>

<?php include '../includes/sidebar.php'; ?>

<div class="main-content">

<h1>Transactions</h1>

<a href="add_transaction.php">Add Transaction</a>

<br><br>

<?php
$result = $conn->query("SELECT * FROM transactions ORDER BY transaction_date DESC");

while($row = $result->fetch_assoc()){
?>

<div class="card">

<strong>ID:</strong> <?php echo $row['transaction_id']; ?><br>
<strong>Account:</strong> <?php echo $row['account_id']; ?><br>
<strong>Category:</strong> <?php echo $row['category_id']; ?><br>
<strong>Amount:</strong> ₹<?php echo $row['amount']; ?><br>
<strong>Type:</strong> <?php echo $row['transaction_type']; ?><br>
<strong>Date:</strong> <?php echo $row['transaction_date']; ?>

</div>

<br>

<?php } ?>

</div>

<?php include '../includes/footer.php'; ?>