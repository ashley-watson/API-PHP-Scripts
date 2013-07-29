<?php
/*

v .1 - auto chooses one server based on hostname and updates, VERY roughly made currently
Future versions will loop out all servers and prompt which server you wish to update
*/


require_once('api.php');
$hardware = SoftLayer_SoapClient::getClient('SoftLayer_Account', null, $apiUsername, $apiKey);

$variable = SoftLayer_SoapClient::getClient('SoftLayer_Account', null, $apiUsername, $apiKey);

$subnets = $variable-> getPublicSubnets();
$typestring = 'STATIC_IP_ROUTED';

foreach ($subnets as $types) {
        if($types->subnetType == $typestring){
                $secondaryip = $types->networkIdentifier;
        }
}

$hostname = readline("Please input the hostname of the server you wish to update the PTR record for: ");

$hwobjectMask = new SoftLayer_ObjectMask();
$hwobjectMask->hardware->primaryIpAddress;
$hardware->setObjectMask($hwobjectMask);

$geninfo = $hardware->getHardware();

try {
        foreach ($geninfo as $server) {
                if ($server->hostname == $hostname){
                        echo "\nServer Found! Information show:\n--------------------------------------------------------\n\r";
                        print_r($server);
                        echo "\nSecondary IP address also found: " . $secondaryip . "\n\n\r";
                        $serverprimaryip = $server->primaryIpAddress;
                        $ptrrecord = readline("Please input the host value for the PTR record ( note: you need to add a period at the end - host.domain.com. ): ");
                        $ttlrecord = readline("Please input the TTL value for the PTR record ( default = 86400): ");
                        echo "\n--------------------------------------------------------\n\nUpdating PTR record for IP " . $serverprimaryip . " to " . $ptrrecord . " with a TTL of ". $ttlrecord . "\n\r";
                }
                else {
                        echo "\nNo matching servers found.\n\r";
                }
        }
} catch (Exception $e) {
die( $e->getMessage());
}

$ptrupdate = SoftLayer_SoapClient::getClient('SoftLayer_Dns_Domain',null, $apiUsername, $apiKey);

try {
                echo "\n--------------------------------------------------------\n\nUpdating PTR record for IP " . $serverprimaryip . " to " . $ptrrecord . " with a TTL of ". $ttlrecord . "\n\r";
                $ptrupdate->createPtrRecord($serverprimaryip, $ptrrecord, $ttlrecord);
                echo "\n--------------------------------------------------------\n\nUpdating PTR record for IP " . $secondaryip . " to " . $ptrrecord . " with a TTL of ". $ttlrecord . "\n\r";
                $ptrupdate->createPtrRecord($secondaryip, $ptrrecord, $ttlrecord);
} catch (Exception $e) {
die( $e->getMessage());
}
?>
