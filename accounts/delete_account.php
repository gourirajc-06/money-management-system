<?php
include '../config/db_connect.php';

if(isset($_GET['id'])){
    $account_id = $_GET['id'];

    // Check if transactions exist
    $check = $conn->query("SELECT * FROM transactions WHERE account_id = $account_id");

    if($check->num_rows > 0){
        echo " Cannot delete account. Transactions exist for this account.";
    } else {
        $conn->query("DELETE FROM accounts WHERE account_id = $account_id");
        echo " Account deleted successfully!";
    }
}
?>