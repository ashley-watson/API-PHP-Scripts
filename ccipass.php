<?php
require_once('api.php');
$variable = SoftLayer_SoapClient::getClient('SoftLayer_Virtual_Guest', null, $apiUsername, $apiKey);

$cciip = readline("Please insert the IP address of the instance: ");
$cci = $variable->findByIpAddress($cciip);
$cciid = $cci->id;

$component = SoftLayer_SoapClient::getClient('SoftLayer_Virtual_Guest', $cciid, $apiUsername, $apiKey);

$os = $component->getSoftwareComponents();

#print_r($os);
foreach($os as $ids){
$osid = $ids->id;
}

echo "--------------------------------------------------------------------------------------------------\n\r";

#$osid = readline("Please input the OS's ID number: ");

$software = SoftLayer_SoapClient::getClient('SoftLayer_Software_Component', $osid, $apiUsername, $apiKey);

$pass = $software->getPasswords();

#print_r($pass);

echo "\n\r Passwords are as follows\n\r";
echo "------------------------------------------------------\n\r";

foreach($pass as $credentials){
echo "Username: " . $credentials->username . "\n\r";
echo "Password: " . $credentials->password . "\n\r";

if(isset($credentials->notes)){
echo "Special notes to login: " . $credentials->notes . "\n\r";
echo "------------------------------------------------------\n\r";
}
else{
echo "------------------------------------------------------\n\r";
}
}

?>
