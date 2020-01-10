<?php

require __DIR__ . '/vendor/autoload.php';

$client = new \Google_Client();
$client->setApplicationName('Google Sheets and PHP');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__ . '/credentials.json');
$service = new Google_Service_Sheets($client);
// https://docs.google.com/spreadsheets/d/1uqaoZagEdwA0pwsFTT2n1OA4_wPxDImoUPTE3oMIRZc/edit#gid=2063166065
$spreadsheetId = "1uqaoZagEdwA0pwsFTT2n1OA4_wPxDImoUPTE3oMIRZc";

$range = "congress!D2:F8";

$values = [
    ["Schooley", "Brent"],
];

function readSheet($service, $range, $sheetId)
{
    $response = $service->spreadsheets_values->get($sheetId, $range);
    $values = $response->getValues();
    if (empty($values)) {
        print "No Data Found.\n";
    } else {
        $mask = "%10s %-10s %s\n";
        foreach ($values as $row) {
            echo sprintf($mask, $row[2], $row[1], $row[0]);
        }
    }
}

readSheet($service, $range, $spreadsheetId);
