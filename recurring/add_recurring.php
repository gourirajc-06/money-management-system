<?php
include '../auth/auth_check.php';
include '../config/db_connect.php';
include '../includes/header.php';
?>

<?php include '../includes/sidebar.php'; ?>

<div class="main-content">

<h1>Add Recurring Payment</h1>

<?php

$message = "";

// Fetch categories
$categories = $conn->query("SELECT category_id, category_name FROM categories");

if(isset($_POST['submit'])){

$category_id = $_POST['category_id'];
$amount = $_POST['amount'];
$frequency = $_POST['frequency'];
$next_payment_date = $_POST['next_payment_date'];

$sql = "INSERT INTO recurring_payments
(category_id, amount, frequency, next_payment_date)
VALUES
('$category_id','$amount','$frequency','$next_payment_date')";

if($conn->query($sql)){
$message = "Recurring Payment Added Successfully!";
}else{
$message = "Error: " . $conn->error;
}

}

?>

<div class="card">

<p><?php echo $message; ?></p>

<form method="POST">

Category:
<select name="category_id" required>

<option value="">Select Category</option>

<?php
while($row = $categories->fetch_assoc()){
echo "<option value='".$row['category_id']."'>".$row['category_name']."</option>";
}
?>

</select>

<br><br>

Amount:
<input type="number" step="0.01" name="amount" required>

<br><br>

Frequency:
<select name="frequency">

<option value="Monthly">Monthly</option>
<option value="Weekly">Weekly</option>

</select>

<br><br>

Next Payment Date:
<input type="date" name="next_payment_date" required>

<br><br>

<button type="submit" name="submit">Add Recurring Payment</button>

</form>

</div>

</div>

<?php include '../includes/footer.php'; ?>