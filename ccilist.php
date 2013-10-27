<?php
require_once('api.php');

$variable = SoftLayer_SoapClient::getClient('SoftLayer_Virtual_Guest', null, $apiUsername, $apiKey);

$hwlist = $variable->getCreateObjectOptions();

#print_r($hwlist);

foreach ($hwlist->operatingSystems as $oslist) {

        echo "\n\r=====================================================================================================\n\r";
        echo "Operating System available: " . $oslist->itemPrice->item->description . "\n\r";
        echo "OS Reference Code: " . $oslist->template->operatingSystemReferenceCode . "\n\r";
        echo "OS Hourly Cost: $0" . $oslist->itemPrice->hourlyRecurringFee . "\n\r";
        echo "OS Monthly Cost: $" . $oslist->itemPrice->recurringFee . "\n\r";
}

?>
