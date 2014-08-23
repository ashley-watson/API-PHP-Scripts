<?php

// api.php needs to have apiUsername, apiKey, and the path to the SLApi file that used to be in this script.

require_once('api.php');

        echo "Please enter a new Password: ";
        system('stty -echo');
        $newPassword = trim(fgets(STDIN));
        system('stty echo');

$client = SoftLayer_SoapClient::getClient('SoftLayer_Account', null, $apiUsername, $apiKey);
$user = $client->getCurrentUser();

$userClient = SoftLayer_SoapClient::getClient('SoftLayer_User_Customer', $user->id,$apiUsername, $apiKey);

try {
$userClient->updateForumPassword($newPassword);
echo "\n\rForum password updated for user " . $user->username . "\n\r";
} catch (Exception $e) {
echo $e->getMessage() . "\n\r";
}
?>
