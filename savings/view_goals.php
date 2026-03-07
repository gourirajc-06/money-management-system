<?php
include '../auth/auth_check.php';
include '../config/db_connect.php';

$result = $conn->query("SELECT * FROM savings_goals");
?>

<!DOCTYPE html>
<html>
<head>
<title>Savings Goals</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<div class="dashboard-layout">

<?php include '../includes/sidebar.php'; ?>

<div class="main-content">

<h1>Savings Goals</h1>

<a href="add_goal.php">Add Goal</a>

<br><br>

<?php
while($row = $result->fetch_assoc()){

    $percentage = 0;
    if($row['target_amount'] > 0){
        $percentage = ($row['saved_amount'] / $row['target_amount']) * 100;
    }
?>

<div class="card">

<p>
<strong>Goal:</strong> <?php echo $row['goal_name']; ?><br>
<strong>Target:</strong> ₹<?php echo $row['target_amount']; ?><br>
<strong>Saved:</strong> ₹<?php echo $row['saved_amount']; ?><br>
<strong>Progress:</strong> <?php echo round($percentage,2); ?>%<br>
<strong>Deadline:</strong> <?php echo $row['deadline']; ?>
</p>

</div>

<br>

<?php
}
?>

</div>

</div>

<script src="../assets/js/script.js"></script>

</body>
</html>