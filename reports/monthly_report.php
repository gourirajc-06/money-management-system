<?php
include '../auth/auth_check.php';
include '../config/db_connect.php';
include '../includes/header.php';
?>

<?php include '../includes/sidebar.php'; ?>

<div class="main-content container mt-4">

<h2 class="mb-4">Monthly Financial Report</h2>

<?php
$sql = "SELECT MONTH(transaction_date) as month, SUM(amount) as total
        FROM transactions
        GROUP BY MONTH(transaction_date)";

$result = $conn->query($sql);

$months = [];
$totals = [];
?>

<table class="table table-bordered table-striped">

<thead class="table-dark">
<tr>
<th>Month</th>
<th>Total Amount</th>
</tr>
</thead>

<tbody>

<?php
while($row = $result->fetch_assoc()){

$monthName = date("F", mktime(0,0,0,$row['month'],10));

$months[] = $monthName;
$totals[] = $row['total'];
?>

<tr>
<td><?php echo $monthName; ?></td>
<td>₹<?php echo $row['total']; ?></td>
</tr>

<?php } ?>

</tbody>
</table>

<br>

<div class="card p-3 shadow">
<h5>Monthly Expense Chart</h5>
<canvas id="monthlyChart"></canvas>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('monthlyChart');

new Chart(ctx, {
type: 'bar',
data: {
labels: <?php echo json_encode($months); ?>,
datasets: [{
label: 'Monthly Amount',
data: <?php echo json_encode($totals); ?>,
backgroundColor: '#007bff'
}]
}
});
</script>

<?php include '../includes/footer.php'; ?>