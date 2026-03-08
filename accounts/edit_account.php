<?php
include '../config/db_connect.php';

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM accounts WHERE account_id=$id");
$row = $result->fetch_assoc();

if(isset($_POST['update'])){

$name = $_POST['name'];
$balance = $_POST['balance'];

$conn->query("UPDATE accounts 
SET account_name='$name', balance='$balance'
WHERE account_id=$id");

header("Location:view_accounts.php");

}
?>

<h2>Edit Account</h2>

<form method="POST">

Account Name:
<input type="text" name="name" value="<?php echo $row['account_name']; ?>">

<br><br>

Balance:
<input type="number" name="balance" value="<?php echo $row['balance']; ?>">

<br><br>

<button name="update">Update Account</button>

</form>