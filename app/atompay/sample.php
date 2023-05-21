<?php
date_default_timezone_set('Asia/Kolkata');
$datenow = date("d/m/Y h:m:s");
$transactionDate = str_replace(" ", "%20", $datenow);
$transactionId = 100;
require_once 'TransactionRequest.php';

$transactionRequest = new TransactionRequest();

//Setting all values here
$transactionRequest->setLogin(192);
$transactionRequest->setPassword("Test@123");
$transactionRequest->setProductId("NSE");
$transactionRequest->setAmount('15.55');
$transactionRequest->setTransactionCurrency("INR");
$transactionRequest->setTransactionAmount('15.55');
$transactionRequest->setReturnUrl("http://localhost:8080/Atompay/response.php");
$transactionRequest->setClientCode('NAVIN');
$transactionRequest->setTransactionId($transactionId);
$transactionRequest->setTransactionDate($transactionDate);
$transactionRequest->setCustomerName("Test Name");
$transactionRequest->setCustomerEmailId("test@test.com");
$transactionRequest->setCustomerMobile("9999999999");
$transactionRequest->setCustomerBillingAddress("Mumbai");
$transactionRequest->setCustomerAccount("639827");
$transactionRequest->setReqHashKey("KEY123657234");
$transactionRequest->seturl("https://paynetzuat.atomtech.in/paynetz/epi/fts");
$transactionRequest->setRequestEncypritonKey("8E41C78439831010F81F61C344B7BFC7");
$transactionRequest->setSalt("8E41C78439831010F81F61C344B7BFC7");


$url = $transactionRequest->getPGUrl();
header("Location: $url");
