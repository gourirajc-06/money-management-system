<?php
include '../auth/auth_check.php';
include '../config/db_connect.php';

$result = $conn->query("SELECT * FROM recurring_payments");
?>

<!DOCTYPE html>
<html>
<head>
<title>Recurring Payments</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<div class="dashboard-layout">

<?php include '../includes/sidebar.php'; ?>

<div class="main-content">

<h1>Recurring Payments</h1>

<a href="add_recurring.php">Add Recurring Payment</a>

<br><br>

<?php
while($row = $result->fetch_assoc()){
?>

<div class="card">

<p>
<strong>ID:</strong> <?php echo $row['recurring_id']; ?> |
<strong>Description:</strong> <?php echo $row['description']; ?> |
<strong>Amount:</strong> ₹<?php echo $row['amount']; ?>
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