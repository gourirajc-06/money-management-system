<?php
session_start();
include '../config/db_connect.php';

// 🔐 Check login
if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if(isset($_GET['id'])){
    $account_id = $_GET['id'];

    // ✅ Check if account belongs to this user
    $checkOwner = $conn->query("
        SELECT * FROM accounts 
        WHERE account_id = $account_id 
        AND user_id = $user_id
    ");

    if($checkOwner->num_rows == 0){
        echo "Unauthorized action!";
        exit();
    }

    // ✅ Check if transactions exist
    $check = $conn->query("
        SELECT * FROM transactions 
        WHERE account_id = $account_id 
        AND user_id = $user_id
    ");

    if($check->num_rows > 0){
        echo "Cannot delete account. Transactions exist for this account.";
    } else {

        // ✅ Delete ONLY this user's account
        $conn->query("
            DELETE FROM accounts 
            WHERE account_id = $account_id 
            AND user_id = $user_id
        ");

        echo "Account deleted successfully!";
    }
}
?>