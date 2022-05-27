<?php

class SubscriptionsView extends Subscriptions {
    public function showSubscriptions($id){
        return $this->getSubscriptions($id);
    }

    public function showSubscriptionsCount($id){
        return $this->getSubscriptionsCount($id);
    }
}