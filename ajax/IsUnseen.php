<?php
	if ( isset($_POST['account']) && !(empty($_POST['account'])) ){
		$strPattern = '^[a-zA-Z0-9_-]+$';
		if ( ereg($strPattern, $_POST['account']) ){
			require '../db/connector.php';
		
			$query = mysql_query("
				SELECT	`member` . `unseen`
				FROM	`member`
				WHERE	`member` . `account` = '" . mysql_real_escape_string(trim($_POST['account'])) ."'
			");

			if (mysql_num_rows($query) !== 0){
				while($result = mysql_fetch_assoc($query)){
					$check = $result["unseen"];
				}
				
				if ($check == 0){
					echo (int)false;
				}
				else {
					echo (int)true;
				}
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