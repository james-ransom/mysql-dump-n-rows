<?php

require_once("creds.inc"); 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function get_all_tables($conn, $dbname, $ignore_keywords=array())
{
	$tables = array(); 
	$sql = "SHOW TABLES FROM $dbname";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
   	 	// output data of each row
    		while($row = $result->fetch_row()) {
			$ignore = false; 
			print_r($ignore_keywords);
			foreach($ignore_keywords as $keyword) 
			{
				$ignore = strpos($row[0], $keyword) !== false; 
				if ( $ignore ) 
					break; 
			}	
			if ( $ignore > 0 ) 
				continue; 
	
                	$tables[] = $row[0];
        	}
	}
	else {
    		echo "0 results";
	}
	return $tables; 
}

$ignore = array("tmp", "temp", "__", "meta", "mysql");
$tables = get_all_tables($conn, $dbname, $ignore); 

foreach($tables as $table) 
{
	$cmd = "mysqldump -u $username -p$password -h$servername --opt --where='1 limit 100'  $dbname $table; "; 
	echo "\nRunning: " . $cmd; 
	system($cmd);
}
echo "\n";  

$conn->close();

?>
