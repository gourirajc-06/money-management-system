<?php
include '../config/db_connect.php';

$message = "";

if(isset($_POST['submit'])){
    $category_id = $_POST['category_id'];
    $amount = $_POST['amount'];
    $frequency = $_POST['frequency'];
    $next_date = $_POST['next_date'];

    $sql = "INSERT INTO recurring_payments
            (category_id, amount, frequency, next_date)
            VALUES ('$category_id','$amount','$frequency','$next_date')";

    if($conn->query($sql)){
        $message = "✅ Recurring Payment Added!";
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Recurring Payment</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<a href="../index.php">Dashboard</a>
<h2>Add Recurring Payment</h2>

<p><?php echo $message; ?></p>

<form method="POST" onsubmit="return validateForm(this)">
    Category ID:
    <input type="number" name="category_id" required><br><br>

    Amount:
    <input type="number" step="0.01" name="amount" required><br><br>

    Frequency:
    <select name="frequency">
        <option>Monthly</option>
        <option>Weekly</option>
        <option>Yearly</option>
    </select><br><br>

    Next Date:
    <input type="date" name="next_date" required><br><br>

    <button type="submit" name="submit">Add Recurring</button>
</form>

<script src="../assets/js/script.js"></script>
</body>
</html>