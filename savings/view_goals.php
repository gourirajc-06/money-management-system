<?php
include '../auth/auth_check.php';
include '../config/db_connect.php';
include '../includes/header.php';
?>

<?php include '../includes/sidebar.php'; ?>

<div class="main-content">

<h1>Savings Goals</h1>

<a href="add_goal.php">Add Goal</a>

<br><br>

<?php
$result = $conn->query("SELECT * FROM savings_goals");

while($row = $result->fetch_assoc()){

    $percentage = 0;
    if($row['target_amount'] > 0){
        $percentage = ($row['saved_amount'] / $row['target_amount']) * 100;
    }
?>

<div class="card">

<strong>Goal:</strong> <?php echo $row['goal_name']; ?><br>
<strong>Target:</strong> ₹<?php echo $row['target_amount']; ?><br>
<strong>Saved:</strong> ₹<?php echo $row['saved_amount']; ?><br>
<strong>Progress:</strong> <?php echo round($percentage,2); ?>%<br>
<strong>Deadline:</strong> <?php echo $row['deadline']; ?>

</div>

<br>

<?php } ?>

</div>

<?php include '../includes/footer.php'; ?>