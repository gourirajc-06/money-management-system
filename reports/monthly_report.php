<?php
include '../config/db_connect.php';

$sql = "SELECT MONTH(date) as month,
        SUM(amount) as total_expense
        FROM transactions
        WHERE transaction_type='Expense'
        GROUP BY MONTH(date)";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Monthly Report</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<a href="../index.php">Dashboard</a>
<h2>Monthly Expense Report</h2>

<a href="../index.php">Dashboard</a>

<br><br>

<?php
while($row = $result->fetch_assoc()){
    echo "Month: " . $row['month'] .
         " | Total Expense: ₹" . $row['total_expense'];

    echo "<br><br>";
}
?>

<script src="../assets/js/script.js"></script>
</body>
</html>