<?php
include '../auth/auth_check.php';
include '../config/db_connect.php';
include '../includes/header.php';

// ✅ Get logged-in user
$user_id = $_SESSION['user_id'];
?>

<?php include '../includes/sidebar.php'; ?>

<div class="main-content container mt-4">

<h2 class="mb-4">Monthly Financial Report</h2>

<?php
// ✅ Filter by user_id
$sql = "SELECT MONTH(transaction_date) as month, SUM(amount) as total
        FROM transactions
        WHERE transaction_type='Expense'
        AND user_id = $user_id
        GROUP BY MONTH(transaction_date)
        ORDER BY MONTH(transaction_date)";

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
if($result && $result->num_rows > 0){
while($row = $result->fetch_assoc()){

$monthName = date("F", mktime(0,0,0,$row['month'],10));

$months[] = $monthName;
$totals[] = $row['total'];
?>

<tr>
<td><?php echo $monthName; ?></td>
<td>₹<?php echo number_format($row['total'],2); ?></td>
</tr>

<?php 
}
}else{
echo "<tr><td colspan='2'>No data available</td></tr>";
}
?>

</tbody>
</table>

<br>

<div class="card shadow p-4 mx-auto" style="width:90%;">

<h5 class="mb-3">Monthly Expense Chart</h5>

<div style="height:450px; width:100%;">
<canvas id="monthlyChart"></canvas>
</div>

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
label: 'Monthly Expense',
data: <?php echo json_encode($totals); ?>,
backgroundColor: '#007bff'
}]
},

options: {

responsive: true,
maintainAspectRatio: false,

plugins:{
legend:{
display:true
}
},

scales:{
y:{
beginAtZero:true
}
}

}

});

</script>

<?php include '../includes/footer.php'; ?>