<?php
CLASS INDEX {
	
	function __construct(){
		
		// Connect to the MySQL database
		$this->conn = mysqli_connect("localhost", "root", "", "calender");
		//$this->conn = mysqli_connect("localhost", "u769302642_customdb", "r3V^L9KV!2", "u769302642_customdb");
		$this->fileName = "";  
		if(isset($_REQUEST['doAction'])){
			switch ($_REQUEST['doAction']) {
			  case 'exportCSV':
					$queryCSV = "SELECT * FROM orders WHERE (endeffdt IS NULL OR endeffdt > NOW())";
					if(isset($_REQUEST['startDate']) && isset($_REQUEST['endDate'])){
						if(!empty($_REQUEST['startDate']) && !empty($_REQUEST['endDate'])){
							$startDate = date("Y-m-d", strtotime($_REQUEST['startDate']));
							$endDate = date("Y-m-d", strtotime($_REQUEST['endDate']));
							
							$queryCSV .= " AND dateadded BETWEEN '" . $startDate ." 00:00:00' AND '" . $endDate . " 11:59:59'";
							
						}
					}
					$queryCSV .= " ORDER BY dateadded DESC";
					$resultCSV = mysqli_query($this->conn, $queryCSV);
					$this->fileName = "orderDetails_" . date("Y-m-d") .".csv";
					$file = fopen($this->fileName, "w+");
					// Add the column headers to the file
					$headers = array(
						"Order Number",
						"Custom/Main site",
						"Customer Name",
						"Product Name",
						"Expected Delivery Date",
						"Function Date ",
						"Date of completion"
					);
					
					fputcsv($file, $headers);
					
					while($row = mysqli_fetch_array($resultCSV)) {
						
						if($row['customflag'] == "Y"){
							$orderType = "Custom Order";
						}
						else{
							$orderType = "Main Order";
						}
						$arrdata = array(
							$row['order_number'],
							$orderType,
							$row['customer_name'],
							$row['product_name'],
							$row['expected_delivery'],
							$row['function_date'],
							$row['dateofcompletion']
						);
							
						fputcsv($file, $arrdata);
							
					}
					
					fclose($file);
					$_REQUEST['doAction'] = "";
					
					break;
			  case 'downloadFile':
					// set headers to download file rather than displayed
					header('Content-Type: text/csv');
					header('Content-Disposition: attachment; filename="orderDetails.csv"');
					header('Pragma: no-cache');
					header('Expires: 0');
					// output the file
					readfile($_REQUEST['fileName']);
					exit();
					break;
			  default:
					break;
			}
		}
	}
}
?>