<?php
//include required files
require 'mailer/PHPMailer.php';
require 'mailer/SMTP.php';
require 'mailer/Exception.php';

include "../lib/dbh.php";
include "../models/invoices.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Instantiate Class
$invoices = new Invoices();

//get data from database
$result = $invoices->getNonOverDueInvoices();
$resultOverDue = $invoices->getOverDueInvoices();

//for getting non over due
foreach($result as $row){
    //data needed
    $sender = "jc7310431@gmail.com";
    $senderPass = "juancruz1234";
    $receiver = $row['email'];
    $receiverId = $row['user_id'];
    $subject = $row['subscription_name'];
    $body = "Hi ".$row['first_name'].",
PAYMENT DUE REMINDER
".$row['subscription_name']."
Invoice ID: ".$row['id']."
Amount: Php ".$row['amount']."
Due date: ".$row['pay_by']."
Pay here: "."https://localhost/subscription-system-oop/index.php?invoice_id=".$row['id'];
// Pay here: "."subscription-system.rf.gd/index.php?invoice_id=".$row['id'];

    $mail = new PHPMailer();//create phpmailer
    $mail->isSMTP();//set mailer to use smtp
    $mail->Host = "smtp.gmail.com";//smtp host
    $mail->SMTPAuth = "true";//smtp authentication
    $mail->SMTPSecure = "tls";//set type of encryption
    $mail->Port = "587";//set port to connect smtp
    $mail->Username = $sender;//set gmail username
    $mail->Password = $senderPass;//set gmail password
    $mail->Subject = $subject;//set mail subject
    $mail->setFrom($sender);//set sender email
    $mail->Body = $body;//email body
    $mail->addAddress($receiver);//Add recipient
    //send email
    if($mail->Send()){
       //update invoice
       $invoices->updateIsMailed($receiverId);
    }else{
        echo "Error!";
    }
    $mail->smtpClose(); //closing smtp connection
}

//for getting over due
foreach($resultOverDue as $rowOverDue){
    //data needed
    $sender = "jc7310431@gmail.com";
    $senderPass = "juancruz1234";
    $receiver = $rowOverDue['email'];
    $receiverId = $rowOverDue['user_id'];
    $subject = $rowOverDue['subscription_name'];
    $body = "Hi ".$rowOverDue['first_name'].",
OVERDUE REMINDER
".$rowOverDue['subscription_name']."
Invoice ID: ".$rowOverDue['id']."
Amount: Php ".$rowOverDue['amount']."
Due date: ".$rowOverDue['pay_by']."
Pay here: "."https://localhost/subscription-system-oop/index.php?invoice_id=".$rowOverDue['id'];
// Pay here: "."subscription-system.rf.gd/index.php?invoice_id=".$rowOverDue['id'];
    
    $mail = new PHPMailer();//create phpmailer
    $mail->isSMTP();//set mailer to use smtp
    $mail->Host = "smtp.gmail.com";//smtp host
    $mail->SMTPAuth = "true";//smtp authentication
    $mail->SMTPSecure = "tls";//set type of encryption
    $mail->Port = "587";//set port to connect smtp
    $mail->Username = $sender;//set gmail username
    $mail->Password = $senderPass;//set gmail password
    $mail->Subject = $subject;//set mail subject
    $mail->setFrom($sender);//set sender email
    $mail->Body = $body;//email body
    $mail->addAddress($receiver);//Add recipient
    //send email
    //if success update data
    if($mail->Send()){
        //update invoice
        $invoices->updateIsMailedOverDue($receiverId);
    }else{
        echo "Error!";
    }
    $mail->smtpClose(); //closing smtp connection
}

?>