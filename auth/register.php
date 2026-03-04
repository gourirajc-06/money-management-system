<?php
include '../config/db_connect.php';

if(isset($_POST['register'])){

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// check if email already exists
$check = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($check);

if($result->num_rows > 0){
$error = "Email already registered";
}else{

$sql = "INSERT INTO users(name,email,password) VALUES('$name','$email','$password')";

if($conn->query($sql)){
header("Location: login.php");
exit();
}else{
$error = "Registration failed";
}

}

}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<div class="container">

<h2>Create Account</h2>

<?php
if(isset($error)){
echo "<p style='color:red;'>$error</p>";
}
?>

<form method="POST">

Name<br>
<input type="text" name="name" required>
<br><br>

Email<br>
<input type="email" name="email" required>
<br><br>

Password<br>
<input type="password" name="password" required>
<br><br>

<button type="submit" name="register">Register</button>

</form>

<br>

<a href="login.php">Back to Login</a>

</div>

</body>
</html>