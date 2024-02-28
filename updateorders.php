<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'vendor/autoload.php';

// Connect to the MySQL database
//$conn = mysqli_connect("localhost", "root", "", "orderdetails");
//$conn = mysqli_csonnect("localhost", "u346522538_customdb", "r3V^L9KV!2", "u346522538_customdb");
//Updated oon 12/09/2023
$conn = mysqli_connect("localhost", "u769302642_customdb", "r3V^L9KV!2", "u769302642_customdb");
// Get the raw post data
$json = file_get_contents("php://input");

// Decode the JSON post data into an array
$data = json_decode($json, true);


// Extract the relevant information from the data array
$orderNo = $data['id'];
//Line items array initialisation
$lineItemsArray = $data['line_items'];
$customerName = $data['shipping']['first_name'] . " " . $data['shipping']['last_name'];
$customflag = "N";
$expectedDate = "";
$status = $data['status'];

if(count($lineItemsArray) != 0){
	foreach ($lineItemsArray as $key => $value){
		$productName = $value['name']; 
		if($value['name'] == 'Custom Product'){
			$customflag = "Y";
		}
		$metaItemsArray = $value['meta_data'];
		foreach ($metaItemsArray as $key => $value){
			if($value['display_key'] == "Expected date of completion"){
				$expectedDate = $value['value'];
			}
		}
	}
}

//Flag event 
$queryEvent = "SELECT flagevent FROM orders WHERE order_number = '$orderNo'";
$resultEvent = mysqli_query($conn, $queryEvent);
$rowEvent = mysqli_fetch_assoc($resultEvent);


$metaData = $data['meta_data'];
foreach ($metaData as $key => $value){
	if($value['key'] == "completion date"){
		$expectedDate = $value['value'];
	}
	if($value['key'] == "model code"){
		$model_code = $value['value'];
	}
}

//Date of completion 

// Update the data into the orders table
if($status == "completed"){
	$currentDate = date("Y-m-d");
	$query	 = "UPDATE orders
		    SET endeffdt = '$currentDate'
			WHERE order_number = '$orderNo'";
}
else{
    if(!empty($expectedDate)){
        $query = "UPDATE orders
		    SET dateofcompletion = '$expectedDate',
		    flagevent = 'Y'
			WHERE order_number = '$orderNo'";    
    }
    else{
        $query = "UPDATE orders
		    SET dateofcompletion = '$expectedDate'
			WHERE order_number = '$orderNo'"; 
    }
    
    
	if(!empty($expectedDate) && $rowEvent['flagevent'] == 'N'){
    	$date = date_create_from_format('d/m/Y', $expectedDate);
    	$converted_date_str = date_format($date, 'Y-m-d');
    	 
    	$credentials = __DIR__ . '/credentials.json';
        $client = new Google_Client();
        $client->setApplicationName('OrderDetails');
        $client->setScopes(array(Google_Service_Calendar::CALENDAR));
        $client->setAuthConfig($credentials);
        $client->setAccessType('offline');
        $client->getAccessToken();
        $client->getRefreshToken(); 
    
        $service = new Google_Service_Calendar($client);
    
        $event   = new Google_Service_Calendar_Event(array(
            'summary' => 'Complete Order No :' . $orderNo .' - ' . $model_code,
            'location' => '',
            'description' => 'You have an order of "' . $customerName . '" to complete today with a model code - "'. $model_code . '"' ,
            'start' => array(
            'dateTime' => $converted_date_str . 'T10:00:00+05:30',
            'timeZone' => 'Asia/Calcutta',
            ),
            'end' => array(
            'dateTime' => $converted_date_str . 'T11:00:00+05:30',
            'timeZone' => 'Asia/Calcutta',
            ),
            'recurrence' => array(),
            'attendees' => array(),  
            'reminders' => array(
            'useDefault' => FALSE,
            'overrides' => array(
                array('method' => 'email', 'minutes' => 24 * 60),
                array('method' => 'popup', 'minutes' => 10),
            ),
            ),
        ));
        
        $calendarId = 'ordernavincreations@gmail.com';
        $event      = $service->events->insert($calendarId, $event);
	}		
}	

		
$result = mysqli_query($conn, $query); 



if($result){
    // Write the response to a log file
    $log_file = 'webhook_update_log.txt';
    $log_response = "Webhook received for Order ID: $order_id, Status: $status, Total: $total\n";
    file_put_contents($log_file, $json . '\n', FILE_APPEND);
    
}else{
	$log_file = 'webhook_update_log.txt';
    $log_response = "Webhook received for Order ID: $order_id, Status: $status, Total: $total\n";
    file_put_contents($log_file, $json . '\n', FILE_APPEND);
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

// Close the MySQL connection
mysqli_close($conn);

?>
