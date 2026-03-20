<?php
include '../auth/auth_check.php';
include '../config/db_connect.php';
include '../includes/header.php';

// ✅ Get logged-in user
$user_id = $_SESSION['user_id'];
?>

<?php include '../includes/sidebar.php'; ?>

<div class="main-content">

<h1>Transactions</h1>

<a href="add_transaction.php" class="btn">Add Transaction</a>

<br><br>

<!-- Filter Form -->
<form method="GET">

<select name="type">

<option value="">All Transactions</option>
<option value="Income">Income</option>
<option value="Expense">Expense</option>

</select>

<button type="submit">Filter</button>

</form>

<?php

$type = $_GET['type'] ?? '';

// ✅ ALWAYS start with user filter
$sql = "SELECT t.*, a.account_name, c.category_name
        FROM transactions t
        JOIN accounts a ON t.account_id = a.account_id
        JOIN categories c ON t.category_id = c.category_id
        WHERE t.user_id = $user_id";

// ✅ Add filter if selected
if($type != ''){
    $sql .= " AND t.transaction_type = '$type'";
}

$sql .= " ORDER BY t.transaction_date DESC";

$result = $conn->query($sql);
?>

<div class="cards">

<?php
if($result && $result->num_rows > 0){
while($row = $result->fetch_assoc()){
?>

<div class="card">

<strong>ID:</strong> <?php echo $row['transaction_id']; ?><br>
<strong>Account:</strong> <?php echo $row['account_name']; ?><br>
<strong>Category:</strong> <?php echo $row['category_name']; ?><br>
<strong>Amount:</strong> ₹<?php echo $row['amount']; ?><br>
<strong>Type:</strong> <?php echo $row['transaction_type']; ?><br>
<strong>Date:</strong> <?php echo $row['transaction_date']; ?>

</div>

<?php 
}
}else{
    echo "<p>No transactions found.</p>";
}
?>

</div>

<?php include '../includes/footer.php'; ?>