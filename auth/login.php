<?php
session_start();
include '../config/db_connect.php';

if(isset($_POST['login'])){

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if($result->num_rows > 0){

$user = $result->fetch_assoc();

if(password_verify($password,$user['password'])){

$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = $user['name'];

header("Location: ../dashboard/dashboard.php");

}else{
echo "Wrong password";
}

}else{
echo "User not found";
}

}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
</head>

<body>

<h2>Login</h2>

<form method="POST">

Email <br>
<input type="email" name="email" required>
<br><br>

Password <br>
<input type="password" name="password" required>
<br><br>

<button type="submit" name="login">Login</button>

</form>

<a href="register.php">Create account</a>

</body>
</html>