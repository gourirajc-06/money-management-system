<?php
include '../auth/auth_check.php';
include '../config/db_connect.php';

$sql = "SELECT MONTH(transaction_date) as month, SUM(amount) as total
        FROM transactions
        GROUP BY MONTH(transaction_date)";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Monthly Report</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<div class="dashboard-layout">

<?php include '../includes/sidebar.php'; ?>

<div class="main-content">

<h1>Monthly Report</h1>

<table border="1" cellpadding="10">

<tr>
<th>Month</th>
<th>Total Amount</th>
</tr>

<?php
while($row = $result->fetch_assoc()){
echo "<tr>";
echo "<td>".$row['month']."</td>";
echo "<td>₹".$row['total']."</td>";
echo "</tr>";
}
?>

</table>

</div>

</div>

</body>
</html>