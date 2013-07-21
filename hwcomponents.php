<?php
require_once("api.php");

/* Pull a list of all hardware servers on the account and output them */

$account_service = SoftLayer_SoapClient::getClient('SoftLayer_Account', null, $apiUsername, $apiKey);

try {
$account_hw = $account_service->getHardware();
} catch (Exception $e) {
die( $e->getMessage());
}

print_r("Available servers:\n\r---------------------------------------------------------------------\n\r");

foreach ($account_hw as $hwcomponents){
	echo "Hardware named " . $hwcomponents->hostname . " has the ID of: " . $hwcomponents->id . "\n\r";
}

$hwoid = readline("Please input the server's ID number: ");

/* Outputs all Hardware information on the inputted server */

$hardware_service = SoftLayer_SoapClient::getClient('SoftLayer_Hardware_Server', $hwoid, $apiUsername, $apiKey);
$hardware = $hardware_service->getComponents();
print_r($hardware)

?>
