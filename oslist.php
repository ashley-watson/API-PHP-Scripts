<?php
require_once('api.php');

$hwinfo = SoftLayer_SoapClient::getClient('SoftLayer_Product_Package_Server', null, $apiUsername, $apiKey);

$hwid = $hwinfo->getAllObjects();
#print_r($hwid);

foreach ($hwid as $hwspecify) {
        echo "\n\r=====================================================================================================\n\r";
        echo "Package Id: " . $hwspecify->packageId . ".\n\r";
        echo "Processor Name: " . $hwspecify->processorName . ".\n\r";
        echo "Processor's Physical Cores: " . $hwspecify->processorPhysicalCores . ".\n\r";
        echo "Processor's Speed: " . $hwspecify->processorSpeed . ".\n\r";
        echo "Processor's Cache: " . $hwspecify->processorCache . ".\n\r";
        echo "Maximum Ram: " . $hwspecify->maxRamCapacity . ".\n\r";
        echo "Maximum Drives: " . $hwspecify->maxDriveCount . ".\n\r";
        echo "Starting Price: " . $hwspecify->startingPrice . ".\n\r";
}

echo "\n\r";

$packageid = readline("Please input Package ID for a list of Operating systems: ");

$variable = SoftLayer_SoapClient::getClient('SoftLayer_Product_Package', $packageid, $apiUsername, $apiKey);

$hwlist = $variable->getActiveSoftwareItems();

foreach ($hwlist as $oslist) {

        echo "\n\r=====================================================================================================\n\r";
        echo "Package ID: " . $oslist->id . "\n\r";
        echo "Package available: " . $oslist->description . ".\n\r";
}

?>
