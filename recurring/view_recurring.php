<?php
include '../auth/auth_check.php';
include '../config/db_connect.php';
include '../includes/header.php';
?>

<?php include '../includes/sidebar.php'; ?>

<div class="main-content">

<h1>Recurring Payments</h1>

<a href="add_recurring.php">Add Recurring Payment</a>

<br><br>

<?php
$result = $conn->query("SELECT * FROM recurring_payments");

while($row = $result->fetch_assoc()){
?>

<div class="card">

<strong>ID:</strong> <?php echo $row['recurring_id']; ?><br>
<strong>Description:</strong> <?php echo $row['description']; ?><br>
<strong>Amount:</strong> ₹<?php echo $row['amount']; ?>

</div>

<br>

<?php } ?>

</div>

<?php include '../includes/footer.php'; ?>