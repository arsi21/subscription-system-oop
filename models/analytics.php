<?php

class Analytics extends Dbh {
    public function getTotalUsers(){
        $stmt = $this->connect()->query('SELECT * 
        FROM user 
        WHERE access = "regular";');
        $userCount = $stmt->rowCount();

        return $userCount;
    }

    public function getTotalPaid(){
        $stmt = $this->connect()->query('SELECT *
        FROM invoice
        WHERE status = "paid";');
        $paidCount = $stmt->rowCount();

        return $paidCount;
    }

    public function getTotalUnpaid(){
        $stmt = $this->connect()->query('SELECT *
        FROM invoice
        WHERE status = "unpaid";');
        $unpaidCount = $stmt->rowCount();

        return $unpaidCount;
    }

    public function getSubscription(){
        $stmt = $this->connect()->query('SELECT invoice.id, subscription.subscription_name, invoice.user_id, user.first_name, user.last_name, subscription.amount, invoice.status
        FROM subscription
        INNER JOIN invoice
        ON invoice.subscription_id = subscription.id
        INNER JOIN user
        ON invoice.user_id = user.id;');
        $result = $stmt->fetchAll();

        return $result;
    }

    public function getSubscriptionTotal(){
        $stmt = $this->connect()->query('SELECT invoice.id, subscription.subscription_name, invoice.user_id, user.first_name, user.last_name, subscription.amount, invoice.status
        FROM subscription
        INNER JOIN invoice
        ON invoice.subscription_id = subscription.id
        INNER JOIN user
        ON invoice.user_id = user.id;');
        $subscriptionInfoCount = $stmt->rowCount();

        return $subscriptionInfoCount;
    }
}