<?php
	include_once "./index.class.php";
	$objIndex = new INDEX();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Orders List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
	
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    
	<div class="container" >
		<h1>Orders List</h1>
		 
		<form style = "display: flex;flex-direction: row;">
		  <div class="form-group" style="margin-right: 20px;" >
		    <?php
				$startDate = "";
				$endDate = "";
				if(isset($_REQUEST['startDate']) && !empty($_REQUEST['startDate'])){
					$startDate = $_REQUEST['startDate'];
				}
				if(isset($_REQUEST['endDate']) && !empty($_REQUEST['endDate'])){
					$endDate = $_REQUEST['endDate'];
				}
			?>
			<label for="startDate">Start Date</label>
			<input readonly type="text" name="startDate" class="form-control" id="startDate" value="<?php print($startDate) ?>">
		  </div>
		  <div class="form-group"style="margin-right: 20px;">
			<label for="endDate">End Date</label>
			<input readonly type="text" name="endDate" class="form-control" id="endDate" value= "<?php print($endDate); ?>">
		  </div>
		  <button type="submit" class="btn btn-primary" style = "height: fit-content; margin-top: 22px;">Submit</button>
		  <input type="hidden" name="doAction" value="dateFilter" />
		</form>
		
		<form action="" method="post">
			<br/><br/><input type="submit" class="btn btn-primary" value="Export to CSV" name="export"><br/><br/>
			<?php
			if(!empty($objIndex->fileName)){
			?>
				<div>
				  <a href="orderdetails.php?doAction=downloadFile&fileName=<?php print($objIndex->fileName); ?>"  target="_blank" class="">Please click here to download CSV</a>
				</div>
				<br/>
			<?php
			}
			?>
			<?php
				if(isset($_REQUEST['startDate']) && !empty($_REQUEST['startDate'])){
					$startDate = $_REQUEST['startDate'];
					
				}
				if(isset($_REQUEST['endDate']) && !empty($_REQUEST['endDate'])){
					
				}
			?>
			<input type="hidden" name="startDate" value="<?php print($_REQUEST['startDate']) ?>" />
			<input type="hidden" name="endDate" value="<?php print($_REQUEST['endDate']) ?>" />
			<input type="hidden" name="doAction" value="exportCSV" />
		</form>
		 
		<table class="table table-striped">
			<tr class="table-dark">
				<th>Order Number</th>
				<th>Custom/Main site</th>
				<th>Customer Name</th>
				<th>Product Name</th>
				<th>Expected Delivery Date</th>
				<th>Function Date </th>
				<th>Date of completion </th>
			</tr>
			<?php
				
			// Set the number of records to display per page
				$records_per_page = 20;

				// Determine the current page number
				$page = isset($_REQUEST['page']) ? (int)$_REQUEST['page'] : 1;

				// Calculate the start record for the current page
				$start_from = ($page - 1) * $records_per_page;
				
				$query = "SELECT * FROM orders ";
				
				$query .= "WHERE (endeffdt IS NULL OR endeffdt > NOW())";
				
				if(isset($_REQUEST['startDate']) && isset($_REQUEST['endDate'])){
					if(!empty($_REQUEST['startDate']) && !empty($_REQUEST['endDate'])){
						$startDate = date("Y-m-d", strtotime($_REQUEST['startDate']));
						$endDate = date("Y-m-d", strtotime($_REQUEST['endDate']));
						
						$query .= "AND dateadded BETWEEN '" . $startDate ." 00:00:00' AND '" . $endDate . " 11:59:59'";
						
					}
				}
				
				
				$query .= "ORDER BY dateadded DESC 
							LIMIT $start_from, $records_per_page";
				
					
				$result = mysqli_query($objIndex->conn, $query);
				
				
				$query_pagination = "SELECT COUNT(*) FROM orders WHERE (endeffdt IS NULL OR endeffdt > NOW())";
				
				if(isset($_REQUEST['startDate']) && isset($_REQUEST['endDate'])){
					if(!empty($_REQUEST['startDate']) && !empty($_REQUEST['endDate'])){
						$startDate = date("Y-m-d", strtotime($_REQUEST['startDate']));
						$endDate = date("Y-m-d", strtotime($_REQUEST['endDate']));
						
						$query_pagination .= " AND WHERE dateadded BETWEEN '" . $startDate ." 00:00:00' AND '" . $endDate . " 11:59:59'";
						
					}
				}
				$result_pagination = mysqli_query($objIndex->conn, $query_pagination);
				
				
				$total_records = mysqli_fetch_row($result_pagination)[0];
				$total_pages = ceil($total_records / $records_per_page);
				
				// Loop through the result set and create a new table row for each order
				while($row = mysqli_fetch_array($result)) {
					echo "<tr>";
					echo "<td>" . $row['order_number'] . "</td>";
					if($row['customflag'] == "Y"){
						echo "<td>Custom Order</td>";
					}
					else{
						echo "<td>Main Order</td>";
					}
					echo "<td>" . $row['customer_name'] . "</td>";
					echo "<td>" . $row['product_name'] . "</td>";
					echo "<td>" . $row['expected_delivery'] . "</td>";
					echo "<td>" . $row['function_date'] . "</td>";
					echo "<td>" . $row['dateofcompletion'] . "</td>";
					echo "</tr>";
				} 

			?>
		</table>
		<nav aria-label="Page navigation example">
		  <ul class="pagination justify-content-center">
			<?php
			 for($count = 1; $count <= $total_pages; $count++){
				 $class_selected = "";
				 if($page == $count){
					$class_selected = "active"; 
				 }
				 
				?>
					<li class="page-item"><a class="page-link <?php print($class_selected); ?>" href="?page=<?php print($count) ?>&startDate=<?php print($startDate);?>&endDate=<?php print($endDate); ?>"><?php print($count); ?></a></li>
				<?php
			 }
			?>
			
		  </ul>
		</nav>
	</div>
	<?php
		
	// Close the MySQL connection
	mysqli_close($objIndex->conn);	
	?>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
	
	<script>
	 $( function() {
        $( "#startDate" ).datepicker();
		$( "#endDate" ).datepicker();
		
      });
	</script>
</body>
</html>