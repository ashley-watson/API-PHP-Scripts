<?php
require_once('api.php');

$tickets = SoftLayer_SoapClient::getClient('SoftLayer_Account', null, $apiUsername, $apiKey);
try {
$ticketlist = $tickets->getOpenTickets();
} catch (Exception $e) {
die( $e->getMessage());
}

#print_r($ticketlist);

foreach ($ticketlist as $opentickets){
        echo "Ticket: " . $opentickets->id . " - " . $opentickets->title . "\n\r";
}


$ticketid = readline("Please input Ticket ID to reference: ");
$client = SoftLayer_SoapClient::getClient('SoftLayer_Ticket', $ticketid, $apiUsername, $apiKey);
$status = $client->getStatus();
echo "\n\r**********************************************************************************\n\r";
echo "Ticket: " . $ticketid . " has the status - " . $status->name . ".\n\r";
echo "**********************************************************************************\n\r";
#print_r($status);
$tckt = $client->getUpdates();
foreach ($tckt as $update){
        echo "\n\r=====================================================================================================";
        echo "\n\rMessage date: " . $update->createDate . ".\n\r";
        echo "\n\rTicket Messages: \n\r----------------\n\r" . $update->entry . ".\n\r";
}


?>
