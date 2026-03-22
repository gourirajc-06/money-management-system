<?php
session_start();
include '../config/db_connect.php';

// Check login
if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$message = "";

// Fetch ONLY this user's active accounts
$accounts = $conn->query("
    SELECT account_id, account_name 
    FROM accounts 
    WHERE user_id = $user_id
    AND is_active = 1
");

// categories can be common
$categories = $conn->query("SELECT category_id, category_name FROM categories");

if(isset($_POST['submit'])){
    $account_id = $_POST['account_id'];
    $category_id = $_POST['category_id'];
    $amount = $_POST['amount'];
    $type = $_POST['transaction_type'];
    $date = $_POST['date'];

    // Ensure selected account belongs to user and is active
    $checkAccount = $conn->query("
        SELECT * FROM accounts 
        WHERE account_id = $account_id 
        AND user_id = $user_id
        AND is_active = 1
    ");

    if($checkAccount->num_rows == 0){
        $message = "Invalid or inactive account selection!";
    } else {

        // Insert transaction with user_id
        $sql = "INSERT INTO transactions 
                (user_id, account_id, category_id, amount, transaction_type, transaction_date)
                VALUES ('$user_id','$account_id','$category_id','$amount','$type','$date')";

        if($conn->query($sql)){

            // Update balance only for this user's active account
            if($type == "Income"){
                $conn->query("
                    UPDATE accounts 
                    SET balance = balance + $amount 
                    WHERE account_id = $account_id 
                    AND user_id = $user_id
                    AND is_active = 1
                ");
            } else {
                $conn->query("
                    UPDATE accounts 
                    SET balance = balance - $amount 
                    WHERE account_id = $account_id 
                    AND user_id = $user_id
                    AND is_active = 1
                ");
            }

            $message = "Transaction Added Successfully!";
        } else {
            $message = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Transaction</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<div class="container">

<a href="../dashboard/dashboard.php">← Dashboard</a>

<h2>Add Transaction</h2>

<p><?php echo $message; ?></p>

<form method="POST">

<!-- Account Dropdown -->
Account:
<select name="account_id" required>
<option value="">Select Account</option>

<?php
while($row = $accounts->fetch_assoc()){
    echo "<option value='".$row['account_id']."'>".$row['account_name']."</option>";
}
?>

</select>

<br><br>

<!-- Category Dropdown -->
Category:
<select name="category_id" required>
<option value="">Select Category</option>

<?php
while($row = $categories->fetch_assoc()){
    echo "<option value='".$row['category_id']."'>".$row['category_name']."</option>";
}
?>

</select>

<br><br>

Amount:
<input type="number" step="0.01" name="amount" required>

<br><br>

Type:
<select name="transaction_type">
<option>Income</option>
<option>Expense</option>
</select>

<br><br>

Date:
<input type="date" name="date" required>

<br><br>

<button type="submit" name="submit">Add Transaction</button>

</form>

</div>
</body>
</html>