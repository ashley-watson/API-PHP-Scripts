## Ticket titles do not post to the ticket

<?php
require_once('api.php');

## Getting the HWO ID #

$account_service = SoftLayer_SoapClient::getClient('SoftLayer_Account', null, $apiUsername, $apiKey);

try {
$account_hw = $account_service->getHardware();
} catch (Exception $e) {
die( $e->getMessage());
}

print_r("\n\rAvailable servers:\n\r---------------------------------------------------------------------\n\r");

foreach ($account_hw as $hwcomponents){
        echo "Hardware with the FQDN: \"" . $hwcomponents->fullyQualifiedDomainName . "\" has the ID of: *" . $hwcomponents->id . "*\n\r";
}


#$hardware = SoftLayer_SoapClient::getClient('SoftLayer_Account', null, $apiUsername, $apiKey);

#$hwo = $hardware->getHardware();

echo "---------------------------------------------------------------------\n\r";

$hwoid = readline("\n\rPlease input the Hardware ID you wish to attach: ");

#print_r($hwo);

#echo "Hardware has ID: " . $hwoid . ".\n\r";



## Getting Account ID


$account_id = SoftLayer_SoapClient::getClient('SoftLayer_Hardware', $hwoid, $apiUsername, $apiKey);

$setaccount = $account_id->getAccount();

$accid = $setaccount->id;

#echo "Account ID: " . $accid . "\n\r";



## Listing all Subject IDs to choose from

$variable = SoftLayer_SoapClient::getClient('SoftLayer_Ticket_Subject', null, $apiUsername, $apiKey);

$tickets = $variable->getAllObjects();

echo "\n\r---------------------------------------------------------------------------------------\n\r";

foreach ($tickets as $ticksub){
        echo "Ticket Subject ID: *" . $ticksub->id . "* has the subject name of: \"" . $ticksub->name . "\"\n\r";
}

echo "---------------------------------------------------------------------------------------\n\r\n\r";


#$newticket = SoftLayer_SoapClient::getClient('SoftLayer_Ticket', null, $apiUsername, $apiKey);

#$createticket = $newticket->addAttachedHardware();

$subjectid = readline('What is the Subject ID you wish to use? ');

$title = readline("What do you want to title the ticket? ");

$ticketcontents = readline("Please input the contents for the ticket: \n\r");

#echo "\n\r\n\rAccount ID: " . $accid . "\n\r";
#echo "Ticket subject ID: " . $subjectid . "\n\r";
#echo "Ticket Message: " . $ticketcontents . "\n\r";


## Creating the ticket

$createnewticket = SoftLayer_SoapClient::getClient('SoftLayer_Ticket', null, $apiUsername, $apiKey);

        $tickobj = new stdClass();
        $tickobj->subjectId = $subjectid;
        $tickobj->assignedUserId = 136521;

        $contents = $ticketcontents;
        $attachmentId = $hwoid;
        $rootPassword = "Please see on file";
try {
        $newticket = $createnewticket->createStandardTicket($tickobj, $contents, $attachmentId, $rootPassword);
        $result = "Ticket Created! Ticket ID: " . $newticket->id . ".\n\r";
} catch (Exception $e) {
        $result = "Unable to create ticket: " . $e->getMessage();
}

echo $result;

?>
