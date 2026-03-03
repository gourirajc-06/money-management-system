<?php
include '../config/db_connect.php';

$message = "";

if(isset($_POST['submit'])){
    $goal_name = $_POST['goal_name'];
    $target_amount = $_POST['target_amount'];
    $deadline = $_POST['deadline'];

    $sql = "INSERT INTO savings_goals 
            (goal_name, target_amount, deadline)
            VALUES ('$goal_name','$target_amount','$deadline')";

    if($conn->query($sql)){
        $message = " Goal Added!";
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Savings Goal</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<a href="../index.php">Dashboard</a>
<h2>Add Savings Goal</h2>

<p><?php echo $message; ?></p>

<form method="POST" onsubmit="return validateForm(this)">
    Goal Name:
    <input type="text" name="goal_name" required><br><br>

    Target Amount:
    <input type="number" step="0.01" name="target_amount" required><br><br>

    Deadline:
    <input type="date" name="deadline" required><br><br>

    <button type="submit" name="submit">Add Goal</button>
</form>

<script src="../assets/js/script.js"></script>
</body>
</html>