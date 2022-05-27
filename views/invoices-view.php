<?php

class InvoicesView extends Invoices {
    public function showUnpaidInvoices($id){
        return $this->getUnpaidInvoices($id);
    }

    public function showUnpaidInvoicesCount($id){
        return $this->getUnpaidInvoicesCount($id);
    }

    public function showUnpaidInvoiceCount($id){
        return $this->getUnpaidInvoiceCount($id);
    }

    public function showInvoiceInfo($id){
        return $this->getInvoiceInfo($id);
    }

    public function showInvoiceUserInfo($id){
        return $this->getInvoiceUserInfo($id);
    }
}