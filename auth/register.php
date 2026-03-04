<?php
include '../config/db.php';

if(isset($_POST['register'])){

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO users(name,email,password) VALUES('$name','$email','$password')";

if($conn->query($sql)){
    echo "Registration successful";
    header("Location: login.php");
}else{
    echo "Error: " . $conn->error;
}

}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
</head>

<body>

<h2>Register</h2>

<form method="POST">

Name <br>
<input type="text" name="name" required>
<br><br>

Email <br>
<input type="email" name="email" required>
<br><br>

Password <br>
<input type="password" name="password" required>
<br><br>

<button type="submit" name="register">Register</button>

</form>

<a href="login.php">Already have an account? Login</a>

</body>
</html>