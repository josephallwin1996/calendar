<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'vendor/autoload.php';

// Connect to the MySQL database
//$conn = mysqli_connect("localhost", "root", "", "orderdetails");
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
if(count($lineItemsArray) != 0){
	foreach ($lineItemsArray as $key => $value){
		$productName = $value['name']; 
		$metaItemsArray = $value['meta_data'];
		if($value['name'] == 'Custom Product'){
			$customflag = "Y";
			foreach ($metaItemsArray as $key => $value){
				if($value['key'] == "expected_date_of_delirvery"){
					$expectedDate = $value['value'];
				}
				else if($value['key'] == "function_date"){
					$functionDate = $value['value'];
				}
			}
		}
		else{
			foreach ($metaItemsArray as $key => $value){
				if($value['key'] == "_tmcartepo_data"){
					$valuesOftemp = $value['value'];
					foreach($valuesOftemp as $valKey => $valTemp){
						print_r($valTemp);
						if($valTemp['name'] == 'Expected Date Of Delivery'){
							$expectedDate = $valTemp['value'];
						}
						if($valTemp['name'] == 'Function Date (If a date is not specified, provide an estimated date to have the dress stitched)'){
							$functionDate = $valTemp['value'];
						}
					}
				}
			}
		}
		
	}
}

//Date of completion 

// Insert the data into the orders table
$query = "INSERT INTO orders 
			( 	
				order_number, 
				customflag, 
				expected_delivery, 
				function_date,
				customer_name,
				product_name,
				dateofcompletion,
				dateadded
			) VALUES 
			(   '$orderNo', 
				'$customflag', 
				'$expectedDate',
				'$functionDate',
				'$customerName',
				'$productName',
				'',
				NOW()
			)";
$result = mysqli_query($conn, $query);

if($result){
    // Write the response to a log file
    $log_file = 'webhook_log.txt';
    $log_response = "Webhook received for Order ID: $order_id, Status: $status, Total: $total\n";
    file_put_contents($log_file, $json, FILE_APPEND);
}else{
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

// Close the MySQL connection
mysqli_close($conn);

?>