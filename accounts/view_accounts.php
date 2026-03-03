<?php
include '../config/db_connect.php';
$result = $conn->query("SELECT * FROM accounts");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Accounts</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<a href="../index.php">Dashboard</a>
<h2>Accounts</h2>

<a href="add_account.php">Add Account</a><br><br>

<?php
while($row = $result->fetch_assoc()){
    echo "ID: " . $row['account_id'] .
         " | Name: " . $row['account_name'] .
         " | Balance: ₹" . $row['balance'];

    echo " | <a href='delete_account.php?id=" . $row['account_id'] . "' 
            onclick='return confirmDelete()'>Delete</a>";

    echo "<br><br>";
}
?>

<script src="../assets/js/script.js"></script>
</body>
</html>