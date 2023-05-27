<?php
error_reporting(0);
include_once 'db.php';
$table = 'users';

$requestData= $_REQUEST;

$columns = array( 
// datatable column index  => database column name
	0 =>'id', 
	1 => 'wallet_address',
	2=> 'trigger_date',
	3=> 'ip_address_hash',
	4=> 'twitter_username',
	5=> 'twitter_id',
	6=> 'twitter_follower_count',
	7=> 'discord_username',
	8=> 'discord_id',
	9=> 'eth_balance_at_registration',
	10=> 'disqualified',
	11=> 'custom_field',
);


$sql = "select *  from ".$table."";

$query=mysqli_query($conn, $sql) or die("not found: get upgrades");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "select *  from ".$table."";

// if( !empty($requestData['search']['value']) ) { 
// 	$sql.=" AND ( b._Baddress LIKE '".$requestData['search']['value']."%' ";    
// 	$sql.=" OR a._Payto LIKE '".$requestData['search']['value']."%' ";
// }

$query=mysqli_query($conn, $sql) or die("not found: get upgrades");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$query=mysqli_query($conn, $sql) or die("not found: get upgrades");


$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

	$nestedData[] = $row["id"];
	$nestedData[] = $row["wallet_address"];
	$nestedData[] = $row["trigger_date"];
	$nestedData[] = $row["ip_address_hash"];
	$nestedData[] = $row["twitter_username"];
	$nestedData[] = $row["twitter_id"];
	$nestedData[] = $row["twitter_follower_count"];
	$nestedData[] = $row["discord_username"];
	$nestedData[] = $row["discord_id"];
	$nestedData[] = $row["eth_balance_at_registration"];
	$nestedData[] = $row["disqualified"];
	$nestedData[] = $row["custom_field"];
	
	$data[] = $nestedData;
}

// indexes
$json_data = array(
			"draw"            => intval( $requestData['draw'] ),  
			"recordsTotal"    => intval( $totalData ),  
			"recordsFiltered" => intval( $totalFiltered ),
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format