<?php
include '../config/db_connect.php';

$message = "";

if(isset($_POST['submit'])){
    $account_id = $_POST['account_id'];
    $category_id = $_POST['category_id'];
    $amount = $_POST['amount'];
    $type = $_POST['transaction_type'];
    $date = $_POST['date'];

    $sql = "INSERT INTO transactions 
            (account_id, category_id, amount, transaction_type, date)
            VALUES ('$account_id','$category_id','$amount','$type','$date')";

    if($conn->query($sql)){

        if($type == "Income"){
            $conn->query("UPDATE accounts SET balance = balance + $amount WHERE account_id = $account_id");
        } else {
            $conn->query("UPDATE accounts SET balance = balance - $amount WHERE account_id = $account_id");
        }

        $message = " Transaction Added!";
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Transaction</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<a href="../index.php">Dashboard</a>
<h2>Add Transaction</h2>

<p><?php echo $message; ?></p>

<form method="POST" onsubmit="return validateForm(this)">
    Account ID:
    <input type="number" name="account_id" required><br><br>

    Category ID:
    <input type="number" name="category_id" required><br><br>

    Amount:
    <input type="number" step="0.01" name="amount" required><br><br>

    Type:
    <select name="transaction_type">
        <option>Income</option>
        <option>Expense</option>
    </select><br><br>

    Date:
    <input type="date" id="date" name="date" required><br><br>

    <button type="submit" name="submit">Add Transaction</button>
</form>

<script>
setTodayDate("date");
</script>

<script src="../assets/js/script.js"></script>
</body>
</html>