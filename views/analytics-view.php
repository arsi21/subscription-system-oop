<?php

class AnalyticsView extends Analytics {
    public function showTotalUsers(){
        $result = $this->getTotalUsers();
        return $result;
    }

    public function showTotalPaid(){
        $result = $this->getTotalPaid();
        return $result;
    }

    public function showTotalUnpaid(){
        $result = $this->getTotalUnpaid();
        return $result;
    }

    public function showSubscriptionInfo(){
        $result = $this->getSubscriptionInfo();
        return $result;
    }

    public function showSubscriptionInfoTotal(){
        $result = $this->getSubscriptionInfoTotal();
        return $result;
    }
}