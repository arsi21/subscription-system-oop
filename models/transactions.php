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
        $result = $stmt->fetchAll();

        return $result;
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
        $transactionCount = $stmt->rowCount();

        return $transactionCount;
    }

}