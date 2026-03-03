<?php
include '../config/db_connect.php';

$message = "";

if(isset($_POST['submit'])){
    $name = $_POST['category_name'];
    $type = $_POST['type'];

    $sql = "INSERT INTO categories (category_name, type)
            VALUES ('$name','$type')";

    if($conn->query($sql)){
        $message = "✅ Category Added!";
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Category</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<a href="../index.php">Dashboard</a>
<h2>Add Category</h2>

<p><?php echo $message; ?></p>

<form method="POST" onsubmit="return validateForm(this)">
    Category Name:
    <input type="text" name="category_name" required><br><br>

    Type:
    <select name="type">
        <option>Income</option>
        <option>Expense</option>
    </select><br><br>

    <button type="submit" name="submit">Add Category</button>
</form>

<script src="../assets/js/script.js"></script>
</body>
</html>