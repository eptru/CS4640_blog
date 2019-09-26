<?php 

	require('connect_db.php');
	global $db;
	$query = "SELECT * FROM users";
	$statement = $db->prepare($query);
	$statement->execute();
	$results = $statement->fetchAll();
	//$results =$result[mt_rand(1, count($result))]['username'];
	$statement->closecursor();
 
	// try commenting out the header setting to experiment how the back end refuses the request
	header('Access-Control-Allow-Origin: http://localhost:4200'); 
  	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: PUT, GET, POST"); 
	header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding');
	
	// retrieve data from the request
	$postdata = file_get_contents("php://input");

	// process data 
	// (this example simply extracts the data and restructures them back) 
	$request = json_decode($postdata);

	$data = [];

	//var_dump($request);
	
	$index = 0;
	
	foreach($results as $result) {
		
		$data[$index] = $result['username'];
		++$index;
		
	}
		  
	// sent response (in json format) back to the front end
	 echo json_encode(['content'=>$data]); 



 
 
 ?>