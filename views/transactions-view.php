<?php

class TransactionsView extends Transactions {
    public function showTransaction(){
        $result = $this->getTransaction();
        return $result;
    }

    public function showTransactionTotal(){
        $result = $this->getTransactionTotal();
        return $result;
    }
}