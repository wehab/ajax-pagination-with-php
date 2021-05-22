

<?php

	$con = mysqli_connect("localhost", "root" , "" , "test" ) or die("connection_error");

	$limit_per_page = 5;

	$page = "";
	if(isset($_POST["page_no"])){
		 $page = $_POST["page_no"];
	}else{
		$page = 1;
	}

	$offset = ($page - 1) * $limit_per_page;

	$sql = "SELECT * FROM  students LIMIT {$offset}, {$limit_per_page}";

	$result = mysqli_query($con , $sql) or die("Query Load Failed");

	$output = "";

	if(mysqli_num_rows($result) > 0){
		$output .= '<table border="1" width="100%" cellspacing="0" cellpadding="10px">
		<tr>
			<th width="100px">Id</th>
			<th width="100px">First Name</th>
			<th width="100px">Last Name</th>
		</tr>';
		while ($row = mysqli_fetch_assoc($result)){
			$output .=	"<tr>
							<td>{$row["Id"]}</td>
							<td>{$row["first_name"]}</td>
							<td>{$row["last_name"]}</td>
						</tr>";
					}
		
		$output .= "</table>";

		$sql_total = "SELECT * FROM students";
		$records = mysqli_query($con,$sql_total) or die("Query Unsuccessful.");

		$total_record = mysqli_num_rows($records);

		$total_pages = ceil($total_record/$limit_per_page); 

		$output .= '<div id="pagination">';

		for($i=1; $i <= $total_pages; $i++){
			if ($i == $page) {
				$class_name = "active";
			} else {
				$class_name = "";
			}
			
			$output	.= "<a  id='{$i}' class='{$class_name}' >{$i}</a>";	
		}

		$output .= '<div>';

		echo $output;
	}
	else{
		echo "<h2>No Record Found...!</h2>";
	}

?>
