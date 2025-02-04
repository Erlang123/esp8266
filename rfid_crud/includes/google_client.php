<?php
require_once __DIR__ . '/../vendor/autoload.php';

function getGoogleClient()
{
    $client = new Google_Client();
    $client->setApplicationName('RFID CRUD');
    $client->setScopes([
        Google_Service_Sheets::SPREADSHEETS, 
        Google_Service_Drive::DRIVE
    ]);
    $client->setAuthConfig(__DIR__ . '/../credentials.json'); // Path ke file credentials.json
    $client->setAccessType('offline');
    return $client;
}

function getSpreadsheetService()
{
    $client = getGoogleClient();
    return new Google_Service_Sheets($client);
}
?>
