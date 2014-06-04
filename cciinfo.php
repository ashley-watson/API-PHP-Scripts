<?php
require_once('api.php');
$variable = SoftLayer_SoapClient::getClient('SoftLayer_Virtual_Guest', null, $apiUsername, $apiKey);

$cciip = readline("Please insert the IP address of the instance: ");
$cci = $variable->findByIpAddress($cciip);
$verbose = readline("Verbose? (Please enter 'Yes' or 'No'): ");
echo "\n\rInformation for CCI with IP address: " . $cciip . " below.\n\r------------------------------------------------------------------\n\r";
$cciid = $cci->id;

echo "CCI Fully Qualified Domain Name: ". $cci->fullyQualifiedDomainName . "\n\r";
echo "CCI ID: " . $cci->id . "\n\r";

if($verbose == 'Yes' or $verbose == 'yes') {
        echo "\n\rExtended information for Instance \"" . $cci->fullyQualifiedDomainName . "\" below: \n\r----------------------------------------------------------------------\n\r";
        #print_r($cci);
        echo "Account ID: " . $cci->accountId . "\n\r";
        echo "Cores: " . $cci->maxCpu . "\n\r";
        echo "RAM: " . $cci->maxMemory . "\n\r";
        echo "Public IP: " . $cci->primaryIpAddress . "\n\r";
        echo "Private IP: " . $cci->primaryBackendIpAddress . "\n\r";

        $cciinfo = SoftLayer_SoapClient::getClient('SoftLayer_Virtual_Guest', $cciid, $apiUsername, $apiKey);

        $blockpos = $cciinfo->getAvailableBlockDevicePositions();
        $usedblocks = $cciinfo->getBlockDevices();

        try {
                echo "\n\rCurrent used disks on \"" . $cci->fullyQualifiedDomainName . "\":\n\r-------------------------------------------------------------------------\n\r";
                foreach ($usedblocks as $blockinfo) {
                        $bootable = $blockinfo->bootableFlag;
                        echo "Block Device: " . $blockinfo->device . "\n\r";
                        if ($blockinfo->bootableFlag == 1) {
                                echo "Boot Partition: True\n\r";
                        } else {
                                echo "Boot Partition: False\n\r";
                        }
                        echo "Current Disk mode set to: " . $blockinfo->mountMode . "\n\r\n\r";
                }
                echo "\n\rCurrent available disks for order on \"" . $cci->fullyQualifiedDomainName . "\":\n\r";
                print_r($blockpos);
        } catch (Exception $e) {
die( $e->getMessage());
        }
}
?>
