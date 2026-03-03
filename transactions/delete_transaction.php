<?php
include '../config/db_connect.php';

if(isset($_GET['id'])){
    $transaction_id = $_GET['id'];

    // Get transaction details first
    $result = $conn->query("SELECT * FROM transactions WHERE transaction_id = $transaction_id");

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();

        $account_id = $row['account_id'];
        $amount = $row['amount'];
        $type = $row['transaction_type'];

        // Reverse account balance
        if($type == "Income"){
            $conn->query("UPDATE accounts SET balance = balance - $amount WHERE account_id = $account_id");
        } else {
            $conn->query("UPDATE accounts SET balance = balance + $amount WHERE account_id = $account_id");
        }

        // Delete transaction
        $conn->query("DELETE FROM transactions WHERE transaction_id = $transaction_id");

        echo "✅ Transaction deleted successfully!";
    } else {
        echo "Transaction not found.";
    }
}
?>