<?php
    if ( isset($_POST['account']) && isset($_POST['password']) ){
		if ( !(empty($_POST['account'])) && !(empty($_POST['password'])) ){
			$strPattern = '^[a-zA-Z0-9_-]+$';
			if ( ereg($strPattern, $_POST['account']) && ereg($strPattern, $_POST['password']) ){
				require '../db/connector.php';
				$account = trim($_POST['account']); // .trim() ?h???
				$password = trim($_POST['password']);
				
				$query = mysql_query("
					SELECT	`member` . `password`
					FROM	`member`
					WHERE	`member` . `account` = '" . mysql_real_escape_string(trim($_POST['account'])) ."'
				");

				if (mysql_num_rows($query) !== 0){
					while($result = mysql_fetch_assoc($query)){
						$check = $result["password"];
					}
					
					if ($password == $check){				
						echo "nice try";
					}
					else {
						echo "password incorrect";
					}
				}
				else {
					echo 'not found';
				}
			}
			else{
				echo "your data contain invalid literals";
			}
		}
		else{
			echo "data is empty";
		}
	}
	else{
		echo "data not set";
	}
?>