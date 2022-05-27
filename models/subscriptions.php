<?php

class Subscriptions extends Dbh {
    protected function getSubscriptions($id){
        $stmt = $this->connect()->prepare('SELECT * FROM subscription
        WHERE user_id = ?;');
        $stmt->execute(array($id));
        $results = $stmt->fetchAll();

        return $results;
    }

    protected function getSubscriptionsCount($id){
        $stmt = $this->connect()->prepare('SELECT * FROM subscription
        WHERE user_id = ?;');
        $stmt->execute(array($id));
        $result = $stmt->rowCount();

        return $result;
    }

}