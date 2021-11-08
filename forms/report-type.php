<?php
$enum_sql="SHOW COLUMNS FROM report LIKE 'report_type'";
$result_id=$conn->query($enum_sql);
while($row = $result_id->fetch_assoc()) {
	$type = $row["Type"];
}

// format the values
// $type currently has the value of: enum('Equipment','Set','Show')


// ouput will be: Equipment','Set','Show')
$output = str_replace("enum('", "", $type);

 // $output will now be: Equipment','Set','Show
$output = str_replace("')", "", $output);

// array $results contains the ENUM values
$results = explode("','", $output);

// create HTML select object

	foreach ($results as $key => $value) {
			echo "<option value='$value'>$value</option>";
			continue;
		
		}

?>
