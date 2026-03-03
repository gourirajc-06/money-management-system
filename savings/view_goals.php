<?php
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
<a href="../index.php">Dashboard</a>
<h2>Savings Goals</h2>

<a href="../index.php">Dashboard</a> |
<a href="add_goal.php">Add Goal</a>

<br><br>

<?php
while($row = $result->fetch_assoc()){

    $percentage = 0;
    if($row['target_amount'] > 0){
        $percentage = ($row['saved_amount'] / $row['target_amount']) * 100;
    }

    echo "Goal: " . $row['goal_name'] .
         " | Target: ₹" . $row['target_amount'] .
         " | Saved: ₹" . $row['saved_amount'] .
         " | Progress: " . round($percentage,2) . "%" .
         " | Deadline: " . $row['deadline'];

    echo "<br><br>";
}
?>

<script src="../assets/js/script.js"></script>
</body>
</html>