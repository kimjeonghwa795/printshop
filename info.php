<?php
$data = 1.2;
//$data = (json_decode( base64_decode($data),JSON_OBJECT_AS_ARRAY) );



$sql = 'select file_id, meta from exp_photoprints where meta is not null';





echo '<pre>';

echo unserialize(null);
$servername = "localhost";
$username = "adorama";
$password = "adorama";
$dbname = "adorama";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$result = $conn->query($sql);
var_dump($result->num_rows);
$stmsts = [];
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
//		print_r($row);
		if ( !is_null($row['meta']) ) {
//		$meta = json_decode($row['meta'],true));
		$meta = serialize($row['meta']);
		
		foreach($meta as $key => $val ) {
			$meta[$key] = $val;
		}
		
		if ( !is_null( $meta )) {
		$sql = 'update exp_photoprints set meta = \'' . $conn->escape_string($meta) . '\' WHERE file_id = ' . $row['file_id']  ;
 //        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
//		echo $sql . "\n";
		$stmsts[$row['file_id'] ] = $sql;
		}
		} 
    }
} else {
    echo "0 results";
}

echo implode(";\n",$stmsts);
echo  "\n" . count($stmsts);

// // // // $conn->autocommit(false);
// // // // if ($conn->multi_query(implode(";\n",$stmsts))) {
	// // // // $conn->commit();    
// // // // }else{
	// // // // printf("Errormessage: %s\n", $conn->error);
	// // // // $conn->rollback();
// // // // }


$conn->close();
echo '</pre>'; 
?>
