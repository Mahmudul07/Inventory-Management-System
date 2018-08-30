<?php
header('Content-Type: application/json');
define('DB_HOST', '127.0.0.1');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'stock');

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if(!$mysqli){
    die("Connection failed: " . $mysqli->error);
}

//query to get data from the table
$query = sprintf("SELECT stock_name,company_price,selling_price FROM stock_details");

//execute query
$result = $mysqli->query($query);

//loop through the returned data

$data = array();
while($row =mysqli_fetch_assoc($result))
{
    $data[] = $row;
}

//free memory associated with result
$result->close();

//close connection
$mysqli->close();

//now print the data
print json_encode($data);
