<?php

class Invoices extends Dbh {
    protected function getUnpaidInvoices($id){
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

    protected function getOverDueInvoices(){
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

    protected function getNonOverDueInvoices(){
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

    protected function updateIsMailedOverDue($id){
        $stmt = $this->connect()->prepare('UPDATE invoice SET  
        is_mailed_overdue = 1
        WHERE user_id = ?;');
        $stmt->execute(array($id));
        $results = $stmt->fetchAll();

        return $results;
    }

    protected function updateIsMailed($id){
        $stmt = $this->connect()->prepare('UPDATE invoice SET  
        is_mailed = 1
        WHERE user_id = ?;');
        $stmt->execute(array($id));
        $results = $stmt->fetchAll();

        return $results;
    }

    protected function getUnpaidInvoicesCount($id){
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

    protected function getUnpaidInvoiceCount($id){
        $stmt = $this->connect()->prepare('SELECT id
        FROM invoice
        WHERE id = ?
        AND status = "unpaid";');
        $stmt->execute(array($id));
        $result = $stmt->rowCount();

        return $result;
    }

    protected function getInvoiceInfo($id){
        $stmt = $this->connect()->prepare('SELECT invoice.id, invoice.user_id, subscription.subscription_name, subscription.amount, invoice.pay_by
        FROM subscription
        INNER JOIN invoice
        ON invoice.subscription_id = subscription.id
        AND invoice.id = ?
        INNER JOIN user
        ON invoice.user_id = user.id;');
        $stmt->execute(array($id));
        $results = $stmt->fetch();

        return $results;
    }

    protected function getInvoiceUserInfo($id){
        $stmt = $this->connect()->prepare('SELECT user.first_name, user.last_name, user.email
        FROM user
        INNER JOIN invoice
        ON invoice.user_id = user.id
        WHERE invoice.id = ?;');
        $stmt->execute(array($id));
        $results = $stmt->fetch();

        return $results;
    }

    protected function updateStatus($id){
        $stmt = $this->connect()->prepare('UPDATE invoice SET 
        status = "paid"
        WHERE id = ?;');
        //run and check if success
        if(!$stmt->execute(array($id))){
            $stmt = null;
            header("location: ../unpaid.php?error=stmtFailed");
            exit();
        }

        $stmt = null;
    }
}