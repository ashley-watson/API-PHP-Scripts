<?php
require_once('api.php');
$variable = SoftLayer_SoapClient::getClient('SoftLayer_Account', null, $apiUsername, $apiKey);

$subnet = $variable->getPublicSubnets();

echo "Public Subnets:\n\r\n\r";

foreach ($subnet as $pubsub) {
                if(isset ($pubsub->gateway)){
                        $pubgate = $pubsub->gateway;
                }else {
                        $pubgate = "N/A";
                }
                if(isset ($pubsub->networkIdentifier)){
                        $pubnet = $pubsub->networkIdentifier;
                }else {
                        $pubnet = "N/A";
                }
                if(isset ($pubsub->broadcastAddress)){
                        $pubbro = $pubsub->broadcastAddress;
                }else {
                        $pubbro = "N/A";
                }
                if(isset ($pubsub->netmask)){
                        $pubmask = $pubsub->netmask;
                }
                if(isset ($pubsub->cidr)){
                        $pubcidr = $pubsub->cidr;
                }else {
                        $pubmask = "N/A";
                }
echo "Subnet: " . $pubnet . "/" . $pubcidr . "\n\r";
#echo "Public IPs: " . $subnet . "\n\r";
echo "Gateway IP: " . $pubgate . "\n\r";
echo "Network IP: " . $pubnet . "\n\r";
echo "Broadcast IP: " . $pubbro . "\n\r";
echo "Subnet mask: " . $pubmask . "\n\r";
echo "--------------------------------------------------------------------------------------------\n\r";
}

echo "\n\rPrivate Subnets:\n\r\n\r";

$privsubnet = $variable->getPrivateSubnets();

foreach ($privsubnet as $psub) {
                if(isset ($psub->gateway)){
                        $pgate = $psub->gateway;
                }else {
                        $pgate = "N/A";
                }
                if(isset ($psub->networkIdentifier)){
                        $pnet = $psub->networkIdentifier;
                }else {
                        $pnet = "N/A";
                }
                 if(isset ($psub->broadcastAddress)){
                        $pbro = $psub->broadcastAddress;
                }else {
                        $pbro = "N/A";
                }
                if(isset ($psub->netmask)){
                        $pmask = $psub->netmask;
                }
                if(isset ($psub->cidr)){
                        $pcidr = $psub->cidr;
                }else {
                        $pmask = "N/A";
                }
echo "Subnet: " . $pnet . "/" . $pcidr . "\n\r";
#echo "Public IPs: " . $subnet . "\n\r";
echo "Gateway IP: " . $pgate . "\n\r";
echo "Network IP: " . $pnet . "\n\r";
echo "Broadcast IP: " . $pbro . "\n\r";
echo "Subnet Mask: " . $pmask . "\n\r";
echo "--------------------------------------------------------------------------------------------\n\r";
}
# (code to underline text) fwrite ( STDOUT, "\033[4m" . "Underlined Text" . PHP_EOL);
?>
