<?php
include '../auth/auth_check.php';
include '../config/db_connect.php';
include '../includes/header.php';
?>

<?php include '../includes/sidebar.php'; ?>

<div class="main-content">

<h1>Categories</h1>

<a href="add_category.php" class="btn">Add Category</a>

<br><br>

<?php
$result = $conn->query("SELECT * FROM categories");

while($row = $result->fetch_assoc()){
?>

<div class="card">

<strong>ID:</strong> <?php echo $row['category_id']; ?><br>
<strong>Name:</strong> <?php echo $row['category_name']; ?>

</div>

<br>

<?php } ?>

</div>

<?php include '../includes/footer.php'; ?>