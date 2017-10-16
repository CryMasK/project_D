<?php

set_include_path(dirname(__FILE__)."/db/");
require 'connector.php';
$id = $_GET['id'];
$sql = "SELECT * FROM location WHERE uID = '".$id."' ";
$myquery = mysql_query($sql);

$location = array();
while($result = mysql_fetch_assoc($myquery)){
	$location[] = $result;
}
echo json_encode($location);
?>