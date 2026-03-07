<?php
include '../auth/auth_check.php';
include '../config/db_connect.php';
include '../includes/header.php';
?>

<?php include '../includes/sidebar.php'; ?>

<div class="main-content">

<h1>Monthly Report</h1>

<?php
$sql = "SELECT MONTH(transaction_date) as month, SUM(amount) as total
        FROM transactions
        GROUP BY MONTH(transaction_date)";

$result = $conn->query($sql);
?>

<table border="1" cellpadding="10">

<tr>
<th>Month</th>
<th>Total Amount</th>
</tr>

<?php
while($row = $result->fetch_assoc()){
?>

<tr>
<td><?php echo $row['month']; ?></td>
<td>₹<?php echo $row['total']; ?></td>
</tr>

<?php } ?>

</table>

</div>

<?php include '../includes/footer.php'; ?>