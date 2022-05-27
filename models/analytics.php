<?php

class Analytics extends Dbh {
    protected function getUsersCount(){
        $stmt = $this->connect()->query('SELECT * 
        FROM user 
        WHERE access = "regular";');
        $result = $stmt->rowCount();

        return $result;
    }

    protected function getPaidCount(){
        $stmt = $this->connect()->query('SELECT *
        FROM invoice
        WHERE status = "paid";');
        $result = $stmt->rowCount();

        return $result;
    }

    protected function getUnpaidCount(){
        $stmt = $this->connect()->query('SELECT *
        FROM invoice
        WHERE status = "unpaid";');
        $result = $stmt->rowCount();

        return $result;
    }

    protected function getSubscription(){
        $stmt = $this->connect()->query('SELECT invoice.id, subscription.subscription_name, invoice.user_id, user.first_name, user.last_name, subscription.amount, invoice.status
        FROM subscription
        INNER JOIN invoice
        ON invoice.subscription_id = subscription.id
        INNER JOIN user
        ON invoice.user_id = user.id;');
        $results = $stmt->fetchAll();

        return $results;
    }

    protected function getSubscriptionCount(){
        $stmt = $this->connect()->query('SELECT invoice.id, subscription.subscription_name, invoice.user_id, user.first_name, user.last_name, subscription.amount, invoice.status
        FROM subscription
        INNER JOIN invoice
        ON invoice.subscription_id = subscription.id
        INNER JOIN user
        ON invoice.user_id = user.id;');
        $result = $stmt->rowCount();

        return $result;
    }
}