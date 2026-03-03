<?php
include '../config/db_connect.php';

$sql = "SELECT t.*, a.account_name, c.category_name
        FROM transactions t
        JOIN accounts a ON t.account_id = a.account_id
        JOIN categories c ON t.category_id = c.category_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Transactions</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<a href="../index.php">Dashboard</a>
<h2>Transactions</h2>

<a href="../index.php">Dashboard</a> |
<a href="add_transaction.php">Add Transaction</a>

<br><br>

<?php
while($row = $result->fetch_assoc()){
    echo $row['account_name'] . " | " .
         $row['category_name'] . " | ₹" .
         $row['amount'] . " | " .
         $row['transaction_type'] . " | " .
         $row['date'];

    echo " | <a href='delete_transaction.php?id=" . $row['transaction_id'] . "' 
            onclick='return confirmDelete()'>Delete</a>";

    echo "<br><br>";
}
?>

<script src="../assets/js/script.js"></script>
</body>
</html>