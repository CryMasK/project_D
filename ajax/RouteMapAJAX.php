<?php
	//set_include_path(dirname(__FILE__)."/db/");

	if (isset($_POST['nowID']) === true && empty($_POST['nowID']) === false){
		$numPattern = '^[0-9]+$';
		if ( ereg($numPattern, $_POST['nowID']) ){
			require '../db/connector.php';
			
			$oldID = trim($_POST['nowID']);
			
			$query = mysql_query("
				SELECT	MAX(`location`.`id`) as id
				FROM	`location`
			");
			if (mysql_num_rows($query) !== 0){
				while($result = mysql_fetch_assoc($query)){
					$nowID = $result;
				}
				
				if ($oldID == $nowID["id"]){
					// force converte to int
					echo (int)false; /* echo ¡utrue¡v would be converted to "1"(string); 	echo ¡ufalse¡v would be converted to "" (the empty string) */
				}
				else {
					$query = mysql_query("
						SELECT	`location` . `id`, `uID`, `longitude`, `latitude`, `date`, `state`, `is_member`
						FROM	`location`
						WHERE	`location` . `id` > '" . mysql_real_escape_string($oldID) ."'
					");
					
					if (mysql_num_rows($query) !== 0){
						$user = array();
						while($result = mysql_fetch_assoc($query)){
							$user[] = $result;
						}
						echo json_encode($user);
					}
					else {
						echo 'not found';
					}
				}
			}
			else {
				echo 'database error';
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