<?php
include '../config/db_connect.php';
$result = $conn->query("SELECT * FROM categories");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Categories</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<a href="../index.php">Dashboard</a>
<h2>Categories</h2>

<a href="../index.php">Dashboard</a> |
<a href="add_category.php">Add Category</a>

<br><br>

<?php
while($row = $result->fetch_assoc()){
    echo "ID: " . $row['category_id'] .
         " | Name: " . $row['category_name'] .
         " | Type: " . $row['type'];

    echo " | <a href='delete_category.php?id=" . $row['category_id'] . "' 
            onclick='return confirmDelete()'>Delete</a>";

    echo "<br><br>";
}
?>

<script src="../assets/js/script.js"></script>
</body>
</html>