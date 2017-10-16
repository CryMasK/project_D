<?php
	require '../db/connector.php';
	
	$query = mysql_query("
		SELECT	MAX(`location`.`id`) as id
		FROM	`location`
	");
	if (mysql_num_rows($query) !== 0){
		while($result = mysql_fetch_assoc($query)){
			$MaxID = $result;
		}
		echo $MaxID["id"];
	}
	else {
		echo 'database error';
	}
?>