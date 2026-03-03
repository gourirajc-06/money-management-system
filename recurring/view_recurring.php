<?php
include '../config/db_connect.php';

$sql = "SELECT r.*, c.category_name
        FROM recurring_payments r
        JOIN categories c ON r.category_id = c.category_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Recurring Payments</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<a href="../index.php">Dashboard</a>
<h2>Recurring Payments</h2>

<a href="../index.php">Dashboard</a> |
<a href="add_recurring.php">Add Recurring</a>

<br><br>

<?php
while($row = $result->fetch_assoc()){
    echo "Category: " . $row['category_name'] .
         " | Amount: ₹" . $row['amount'] .
         " | Frequency: " . $row['frequency'] .
         " | Next Date: " . $row['next_date'];

    echo "<br><br>";
}
?>

<script src="../assets/js/script.js"></script>
</body>
</html>