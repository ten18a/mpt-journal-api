<?php

// Define the access key
$accessKey = 'XXXXXXXX';

// Check if the key exists in the query parameter
if (isset($_GET['access_key']) && $_GET['access_key'] === $accessKey) {
    // Key found in the query parameter, grant access
    grantAccess();
} else {
    // Key not found in the query parameter, check cookies
    if (isset($_COOKIE['access_key']) && $_COOKIE['access_key'] === $accessKey) {
        // Key found in cookies, grant access
        grantAccess();
    } else {
        // Access denied, return 403 Forbidden response
        http_response_code(403);
        echo json_encode(array('message' => 'Access denied'));
        exit;
    }
}

// Function to grant access
function grantAccess()
{
  http_response_code(401);
}
?>
