<?php
function generateUniqueID()
{
    // Combine the current timestamp with a random number to create a unique ID
    $timestamp = substr(time(), -4);
    $randomNumber = mt_rand(1000, 9999); // Generate a random number between 1000 and 9999
    $uniqueID = $timestamp . $randomNumber; // Concatenate timestamp and random number

    return $uniqueID;
}

// Return the unique ID as a JSON response
$response = array('unique_id' => generateUniqueID());
echo json_encode($response);
