<?php
//include required files
require 'mailer/PHPMailer.php';
require 'mailer/SMTP.php';
require 'mailer/Exception.php';
require_once "../models/transactions.php";
require_once "../views/transactions-view.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Instantiate Class
$transactionsView = new TransactionsView();

$transaction_id = $charge->id;

//for getting data
$row = $transactionsView->showTransactionReceipt($transaction_id);

    //data needed
    $sender = "jc7310431@gmail.com";
    $senderPass = "juancruz1234";
    $receiver = $row['email'];
    $receiverId = $row['user_id'];
    $subject = $row['subscription_name'];
    $body = "PAYMENT RECEIPT
".$row['subscription_name']."
Transaction ID: ".$row['id']."
Amount: Php ".$row['amount']."
Paid date: ".$row['paid_date']."
Status: ".$row['status'];

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

    }else{
        echo "Error!";
    }
    $mail->smtpClose(); //closing smtp connection

?>