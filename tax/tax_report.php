<?php
include '../auth/auth_check.php';
include '../config/db_connect.php';
include '../includes/header.php';
?>

<?php include '../includes/sidebar.php'; ?>

<div class="main-content">

<h1>Tax Report</h1>

<?php

$sql = "
SELECT 
t.transaction_id,
t.transaction_type,
t.amount,
c.category_name,
tx.tax_percent,
(t.amount * tx.tax_percent / 100) AS tax_amount
FROM transactions t
JOIN categories c ON t.category_id = c.category_id
LEFT JOIN taxes tx ON c.category_id = tx.category_id
";

$result = $conn->query($sql);

$total_income = 0;
$total_tax = 0;

?>

<?php
while($row = $result->fetch_assoc()){

$total_income += $row['amount'];
$total_tax += $row['tax_amount'];

$rows[] = $row;

}

$effective_tax_rate = 0;

if($total_income > 0){
$effective_tax_rate = ($total_tax / $total_income) * 100;
}
?>

<!-- Tax Summary Cards -->

<div class="cards">

<div class="card">
<h3>Total Income</h3>
<p>₹<?php echo number_format($total_income,2); ?></p>
</div>

<div class="card">
<h3>Total Tax</h3>
<p>₹<?php echo number_format($total_tax,2); ?></p>
</div>

<div class="card">
<h3>Effective Tax Rate</h3>
<p><?php echo number_format($effective_tax_rate,2); ?>%</p>
</div>

</div>

<br><br>

<!-- Tax Table -->

<table border="1" cellpadding="10">

<table class="tax-table">

<tr>
<th>Category</th>
<th>Type</th>
<th>Amount</th>
<th>Tax %</th>
<th>Tax Amount</th>
</tr>

<?php
if(!empty($rows)){
foreach($rows as $row){
?>

<tr>
<td><?php echo $row['category_name']; ?></td>
<td><?php echo $row['transaction_type']; ?></td>
<td>₹<?php echo number_format($row['amount'],2); ?></td>
<td><?php echo $row['tax_percent']; ?>%</td>
<td>₹<?php echo number_format($row['tax_amount'],2); ?></td>
</tr>

<?php
}
}
?>

</table>

</div>

<?php include '../includes/footer.php'; ?>