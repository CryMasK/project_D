<?php
	//set_include_path(dirname(__FILE__)."/db/");

	if (isset($_POST['uID']) === true && empty($_POST['uID']) === false){
		$strPattern = '^[a-zA-Z0-9_-]+$';
		if ( ereg($strPattern, $_POST['uID']) ){
			require '../db/connector.php';
		
			$query = mysql_query("
				SELECT	`location` . `longitude`, `latitude`, `date`
				FROM	`location`
				WHERE	`location` . `uID` = '" . mysql_real_escape_string(trim($_POST['uID'])) ."'
			");

			if (mysql_num_rows($query) !== 0){
				$location = array();
				while($result = mysql_fetch_assoc($query)){
					$location[] = $result;
				}
				echo json_encode($location);
			}
			else {
				echo 'not found';
			}
		}
		else{
			echo 'invalid input';
		}
	}
	else{
		echo 'Query Failed';
	}
?>