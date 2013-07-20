<?php
require_once('api.php');

$tickets = SoftLayer_SoapClient::getClient('SoftLayer_Account', null, $apiUsername, $apiKey);
try {
$ticketlist = $tickets->getLastFiveClosedTickets();
} catch (Exception $e) {
die( $e->getMessage());
}

foreach ($ticketlist as $closedtickets){
	echo "Ticket: " . $closedtickets->id . " - " . $closedtickets->title . "\n\r";
}

$ticketid = readline("Please input Ticket ID to reference: ");
$client = SoftLayer_SoapClient::getClient('SoftLayer_Ticket', $ticketid, $apiUsername, $apiKey);
$tckt = $client->getUpdates();
print_r($tckt)

?>
