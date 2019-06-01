<?php

// Api link, replace [apikey] with your API key and [ids] with a comma separated string of Steam64IDs
$apiurl = "https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=[apikey]&steamids=[ids]";

// Fetch JSON data from Steam's servers
$response = file_get_contents($apiurl);
// Make sure it was successful
if($response === false)
    exit("Error: Unable to reach the remote server.");

// Decode JSON data into an associative array instead of an object by sending true as the second argument
$data = json_decode($response, true);
// Make sure it was successful
if($data == null)
    if(strpos($response, "key=") !== false) // If "key=" exists in response, servers rejected the key
        exit("Error: Missing/Invalid API key");
    else // Otherwise something went wrong when parsing the data
        exit("Error: Unable to decode JSON data.");

// $data should have a property "response" and it should in turn have "players"
// If that's not the case, something went wrong with the API
if(!isset($data["response"]) || !isset($data["response"]["players"]))
    exit("Error: Invalid response");

// Make it easier to reference the player list
$players = $data["response"]["players"];

// If $players is emty, it means no IDs were provided or said IDs were invalid
if(count($players) == 0)
    exit("Error: Emty response, no ids provided?");

// Loop over $players and do whatever floats your boats with the data
for($i = 0;$i < count($players);$i++){
    // Do stuff here, preferably
}
