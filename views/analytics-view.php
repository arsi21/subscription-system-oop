<?php

class AnalyticsView extends Analytics {
    public function showUsersCount(){
        return $this->getUsersCount();
    }

    public function showPaidCount(){
        return $this->getPaidCount();
    }

    public function showUnpaidCount(){
        return $this->getUnpaidCount();
    }

    public function showSubscription(){
        return $this->getSubscription();
    }

    public function showSubscriptionCount(){
        return $this->getSubscriptionCount();
    }
}