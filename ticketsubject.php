<?php
require_once('api.php');
$variable = SoftLayer_SoapClient::getClient('SoftLayer_Ticket_Subject', null, $apiUsername, $apiKey);

$tickets = $variable->getAllObjects();

foreach ($tickets as $ticksub){
        echo "Ticket Subject ID: *" . $ticksub->id . "* has the subject name of: \"" . $ticksub->name . "\"\n\r";
}

#print_r($tickets);


#$variable = SoftLayer_SoapClient::getClient('SoftLayer_Ticket', null, $apiUsername, $apiKey);

#$ticketgroups = $variable->getAllTicketGroups();

#print_r($ticketgroups);

?>
