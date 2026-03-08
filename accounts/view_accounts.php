<?php
include '../auth/auth_check.php';
include '../config/db_connect.php';
include '../includes/header.php';
?>

<?php include '../includes/sidebar.php'; ?>

<div class="main-content container mt-4">

<h2 class="mb-4">Accounts</h2>

<a href="add_account.php" class="btn btn-primary mb-3">+ Add Account</a>

<div class="row">

<?php
$result = $conn->query("SELECT * FROM accounts");

if($result && $result->num_rows > 0){

while($row = $result->fetch_assoc()){
?>

<div class="col-md-4">

<div class="card shadow mb-4">

<div class="card-body">

<h5 class="card-title"> <?php echo $row['account_name']; ?></h5>

<p class="card-text">
<strong>ID:</strong> <?php echo $row['account_id']; ?><br>
<strong>Balance:</strong> ₹<?php echo number_format($row['balance'],2); ?>
</p>

<a href="edit_account.php?id=<?php echo $row['account_id']; ?>" class="btn btn-warning btn-sm">Edit</a>

<a href="delete_account.php?id=<?php echo $row['account_id']; ?>" class="btn btn-danger btn-sm">Delete</a>

</div>

</div>

</div>

<?php 
}
}else{
?>

<p>No accounts found.</p>

<?php } ?>

</div>

</div>

<?php include '../includes/footer.php'; ?>