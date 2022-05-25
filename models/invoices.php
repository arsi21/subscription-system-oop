<?php

class Invoices extends Dbh {
    public function getInvoices($id){
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

    public function getInvoicesCount($id){
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

}