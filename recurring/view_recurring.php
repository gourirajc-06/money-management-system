<?php
include '../auth/auth_check.php';
include '../config/db_connect.php';
include '../includes/header.php';
?>

<?php include '../includes/sidebar.php'; ?>

<div class="main-content">

<h1>Recurring Payments</h1>

<a href="add_recurring.php" class="btn">Add Recurring Payment</a>

<br><br>

<?php

$sql = "SELECT r.*, c.category_name
        FROM recurring_payments r
        JOIN categories c ON r.category_id = c.category_id
        ORDER BY r.next_payment_date ASC";

$result = $conn->query($sql);

?>

<div class="cards">

<?php
while($row = $result->fetch_assoc()){
?>

<div class="card">

<strong>Category:</strong> <?php echo $row['category_name']; ?><br>

<strong>Amount:</strong> ₹<?php echo number_format($row['amount'],2); ?><br>

<strong>Frequency:</strong> <?php echo $row['frequency']; ?><br>

<strong>Next Payment:</strong> <?php echo $row['next_payment_date']; ?>

</div>

<?php } ?>

</div>

</div>

<?php include '../includes/footer.php'; ?>