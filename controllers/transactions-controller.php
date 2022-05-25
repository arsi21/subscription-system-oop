<?php

class TransactionsController extends Transactions {
    private $id;
    private $userId;
    private $invoiceId;
    private $amount;
    private $status;

    public function __construct($id, $userId, $invoiceId, $amount, $status){
        $this->id = $id;
        $this->userId = $userId;
        $this->invoiceId = $invoiceId;
        $this->amount = $amount;
        $this->status = $status;
    }

    public function addTransaction() {
        $this->setTransaction($this->id, $this->userId, $this->invoiceId, $this->amount, $this->status);
    }
}