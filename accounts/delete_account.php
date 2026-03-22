<?php
session_start();
include '../config/db_connect.php';

// Check login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_GET['id'])) {
    $account_id = (int) $_GET['id'];

    // Check if account belongs to this user
    $checkOwner = $conn->query("
        SELECT * FROM accounts
        WHERE account_id = $account_id
        AND user_id = $user_id
    ");

    if ($checkOwner->num_rows == 0) {
        echo "Unauthorized action!";
        exit();
    }

    // Soft delete = mark account as inactive
    $update = $conn->query("
        UPDATE accounts
        SET is_active = 0
        WHERE account_id = $account_id
        AND user_id = $user_id
    ");

    if ($update) {
        echo "Account deactivated successfully!";
    } else {
        echo "Error deactivating account.";
    }
}
?>