<?php
include '../auth/auth_check.php';
include '../config/db_connect.php';
include '../includes/header.php';
?>

<?php include '../includes/sidebar.php'; ?>

<div class="main-content">

<h1>Accounts</h1>

<a href="add_account.php">Add Account</a>

<br><br>

<?php
$result = $conn->query("SELECT * FROM accounts");

while($row = $result->fetch_assoc()){
?>

<div class="card">

<strong>ID:</strong> <?php echo $row['account_id']; ?><br>
<strong>Name:</strong> <?php echo $row['account_name']; ?><br>
<strong>Balance:</strong> ₹<?php echo $row['balance']; ?>

<br><br>

<a href="delete_account.php?id=<?php echo $row['account_id']; ?>">Delete</a>

</div>

<br>

<?php } ?>

</div>

<?php include '../includes/footer.php'; ?>