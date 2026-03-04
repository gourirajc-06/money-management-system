<?php
session_start();
include '../config/db_connect.php';

if(isset($_POST['login'])){

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if($result && $result->num_rows > 0){

$user = $result->fetch_assoc();

if(password_verify($password,$user['password'])){

$_SESSION['user_id'] = $user['user_id'];
$_SESSION['user_name'] = $user['name'];

header("Location: ../dashboard/dashboard.php");
exit();

}else{
$error = "Wrong password";
}

}else{
$error = "User not found";
}

}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<div class="container">

<h2>Login</h2>

<?php
if(isset($error)){
echo "<p style='color:red;'>$error</p>";
}
?>

<form method="POST">

Email<br>
<input type="email" name="email" required>
<br><br>

Password<br>
<input type="password" name="password" required>
<br><br>

<button type="submit" name="login">Login</button>

</form>

<br>

<a href="register.php">Create account</a>

</div>

</body>
</html>