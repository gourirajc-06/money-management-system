<?php
include '../config/db_connect.php';

if(isset($_POST['submit'])){
    $name = $_POST['account_name'];
    $balance = $_POST['balance'];

    $conn->query("INSERT INTO accounts (account_name, balance)
                  VALUES ('$name','$balance')");

    echo "Account Added Successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Account</title>
</head>
<body>
<a href="../index.php">Dashboard</a>
<h2>Add Account</h2>

<form method="POST">
    Account Name:
    <input type="text" name="account_name" required><br><br>

    Balance:
    <input type="number" name="balance" required><br><br>

    <button type="submit" name="submit">Add Account</button>
</form>

<script src="../assets/js/script.js"></script>

</body>
</html>