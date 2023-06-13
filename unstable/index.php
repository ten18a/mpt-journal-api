<?php

// APIv:
$apiv = 'unstable';

// Define base URL
$base_url = 'https://api.mpt-journal.ru/unstable/';

// Get request method and URI
$method = $_GET['method'];
$endpoint = $_GET['endpoint'];

// Route the request to the appropriate endpoint
switch ($method) {
    case 'GET':
        switch ($endpoint) {
            case 'apiv':
                echo json_encode(array('version' => $apiv));
            break;
            case 'fromMPT.schedule-changes':
                include 'GET/fromMPT.schedule-changes.php';
            break;
            default:
                // Return a 404 Not Found response for unknown endpoints
                http_response_code(404);
                echo json_encode(array('message' => 'Endpoint not found'));
            break;
        }
    break;
    default:
        // Return a 404 Not Found response for unknown endpoints
        http_response_code(404);
        echo json_encode(array('message' => 'Method not found'));
    break;
}
?>
