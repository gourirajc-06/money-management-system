<?php
include '../auth/auth_check.php';
include '../config/db_connect.php';

$result = $conn->query("SELECT * FROM categories");
?>

<!DOCTYPE html>
<html>
<head>
<title>Categories</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<div class="dashboard-layout">

<?php include '../includes/sidebar.php'; ?>

<div class="main-content">

<h1>Categories</h1>

<a href="add_category.php">Add Category</a>

<br><br>

<?php
while($row = $result->fetch_assoc()){
?>

<div class="card">

<p>
<strong>ID:</strong> <?php echo $row['category_id']; ?> |
<strong>Name:</strong> <?php echo $row['category_name']; ?>
</p>

</div>

<br>

<?php
}
?>

</div>

</div>

</body>
</html>