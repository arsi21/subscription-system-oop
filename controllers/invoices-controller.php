<?php

class InvoicesController extends Invoices {
    private $id;

    public function __construct($id){
        $this->id = $id;
    }

    public function updateInvoiceStatus() {
        $this->updateStatus($this->id);
    }
}