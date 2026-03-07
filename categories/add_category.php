<?php
include '../auth/auth_check.php';
include '../config/db_connect.php';
include '../includes/header.php';

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

<?php include '../includes/sidebar.php'; ?>

<div class="main-content">

<h1>Add Category</h1>

<p><?php echo $message; ?></p>

<form method="POST" onsubmit="return validateForm(this)">

<label>Category Name:</label><br>
<input type="text" name="category_name" required><br><br>

<label>Type:</label><br>
<select name="type">
<option value="Income">Income</option>
<option value="Expense">Expense</option>
</select>

<br><br>

<button type="submit" name="submit">Add Category</button>

</form>

</div>

<?php include '../includes/footer.php'; ?>