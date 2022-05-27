<?php

class TransactionsView extends Transactions {
    public function showTransactions(){
        return $this->getTransactions();
    }

    public function showTransactionsCount(){
        return $this->getTransactionsCount();
    }

    public function showUserTransactions($id){
        return $this->getUserTransactions($id);
    }

    public function showUserTransactionsCount($id){
        return $this->getUserTransactionsCount($id);
    }

    public function showTransactionReceipt($id){
        return $this->getTransactionReceipt($id);
    }
}