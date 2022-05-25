<?php

class Transactions extends Dbh {
    public function getTransaction(){
        $stmt = $this->connect()->query('SELECT subscription.subscription_name, transaction.amount, transaction.paid_date, transaction.id, transaction.status
        FROM subscription
        INNER JOIN invoice
        ON invoice.subscription_id = subscription.id
        AND invoice.status = "paid"
        INNER JOIN transaction
        ON transaction.invoice_id = invoice.id
        INNER JOIN user
        ON transaction.user_id = user.id;');
        $results = $stmt->fetchAll();

        return $results;
    }

    public function getTransactionCount(){
        $stmt = $this->connect()->query('SELECT subscription.subscription_name, transaction.amount, transaction.paid_date, transaction.id, transaction.status
        FROM subscription
        INNER JOIN invoice
        ON invoice.subscription_id = subscription.id
        AND invoice.status = "paid"
        INNER JOIN transaction
        ON transaction.invoice_id = invoice.id
        INNER JOIN user
        ON transaction.user_id = user.id;');
        $result = $stmt->rowCount();

        return $result;
    }

    public function setTransaction($id, $userId, $invoiceId, $amount, $status){
        $stmt = $this->connect()->prepare('INSERT INTO transaction(id, user_id, invoice_id, amount, status) 
        VALUES (?, ?, ?, ?, ?);');

        //run and check if success
        if(!$stmt->execute(array($id, $userId, $invoiceId, $amount, $status))){
            $stmt = null;
            header("location: ../unpaid.php?error=stmtFailed");
            exit();
        }

        $stmt = null;
    }

    public function getTransactionReceipt($id){
        $stmt = $this->connect()->prepare('SELECT invoice.user_id, user.first_name, user.email, subscription.subscription_name, transaction.amount, transaction.paid_date, transaction.status, transaction.id
        FROM subscription
        INNER JOIN invoice
        ON invoice.subscription_id = subscription.id
        INNER JOIN transaction
        ON transaction.invoice_id = invoice.id
        AND transaction.id = ?
        INNER JOIN user
        ON transaction.user_id = user.id;');
        $stmt->execute(array($id));
        $results = $stmt->fetch();

        return $results;
    }
}