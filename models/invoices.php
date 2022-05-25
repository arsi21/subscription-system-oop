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

    public function getOverDueInvoices(){
        $stmt = $this->connect()->query('SELECT invoice.id, invoice.user_id, user.first_name, user.email, subscription.subscription_name, subscription.amount, invoice.pay_by
        FROM subscription
        INNER JOIN invoice
        ON invoice.subscription_id = subscription.id
        AND invoice.status = "unpaid"
        AND invoice.pay_by < CURRENT_TIMESTAMP
        AND invoice.is_mailed_overdue = 0
        INNER JOIN user
        ON invoice.user_id = user.id LIMIT 25;');
        $results = $stmt->fetchAll();

        return $results;
    }

    public function getNonOverDueInvoices(){
        $stmt = $this->connect()->query('SELECT invoice.id, invoice.user_id, user.first_name, user.email, subscription.subscription_name, subscription.amount, invoice.pay_by
        FROM subscription
        INNER JOIN invoice
        ON invoice.subscription_id = subscription.id
        AND invoice.status = "unpaid"
        AND SUBTIME(invoice.pay_by, "100") <= CURRENT_TIMESTAMP
        AND invoice.pay_by > CURRENT_TIMESTAMP
        AND invoice.is_mailed = 0
        INNER JOIN user
        ON invoice.user_id = user.id LIMIT 25;');
        $results = $stmt->fetchAll();

        return $results;
    }

    public function updateIsMailedOverDue($id){
        $stmt = $this->connect()->prepare('UPDATE invoice SET  
        is_mailed_overdue = 1
        WHERE user_id = ?;');
        $stmt->execute(array($id));
        $results = $stmt->fetchAll();

        return $results;
    }

    public function updateIsMailed($id){
        $stmt = $this->connect()->prepare('UPDATE invoice SET  
        is_mailed = 1
        WHERE user_id = ?;');
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