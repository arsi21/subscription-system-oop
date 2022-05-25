<?php

class Invoices extends Dbh {
    public function getUnpaidInvoices($id){
        $stmt = $this->connect()->prepare('SELECT invoice.id, subscription.subscription_name, subscription.amount, invoice.pay_by
        FROM subscription
        INNER JOIN invoice
        ON invoice.subscription_id = subscription.id
        AND invoice.status = "unpaid"
        INNER JOIN user
        ON invoice.user_id = user.id
        WHERE user.id = ?;');
        $stmt->execute(array($id));
        $results = $stmt->fetchAll();

        return $results;
    }

    public function getPaidInvoices($id){
        $stmt = $this->connect()->prepare('SELECT subscription.subscription_name, transaction.amount, transaction.paid_date, transaction.id, transaction.status
        FROM subscription
        INNER JOIN invoice
        ON invoice.subscription_id = subscription.id
        AND invoice.status = "paid"
        INNER JOIN transaction
        ON transaction.invoice_id = invoice.id
        INNER JOIN user
        ON transaction.user_id = user.id
        AND user.id = ?;');
        $stmt->execute(array($id));
        $results = $stmt->fetchAll();

        return $results;
    }

    public function getUnpaidInvoicesCount($id){
        $stmt = $this->connect()->prepare('SELECT invoice.id, subscription.subscription_name, subscription.amount, invoice.pay_by
        FROM subscription
        INNER JOIN invoice
        ON invoice.subscription_id = subscription.id
        AND invoice.status = "unpaid"
        INNER JOIN user
        ON invoice.user_id = user.id
        WHERE user.id = ?;');
        $stmt->execute(array($id));
        $result = $stmt->rowCount();

        return $result;
    }

    public function getPaidInvoicesCount($id){
        $stmt = $this->connect()->prepare('SELECT subscription.subscription_name, transaction.amount, transaction.paid_date, transaction.id, transaction.status
        FROM subscription
        INNER JOIN invoice
        ON invoice.subscription_id = subscription.id
        AND invoice.status = "paid"
        INNER JOIN transaction
        ON transaction.invoice_id = invoice.id
        INNER JOIN user
        ON transaction.user_id = user.id
        AND user.id = ?;');
        $stmt->execute(array($id));
        $result = $stmt->rowCount();

        return $result;
    }

}