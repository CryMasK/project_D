<?php
    if ( isset($_POST['account']) && isset($_POST['message']) ){
		if ( !(empty($_POST['account'])) && !(empty($_POST['message'])) ){
			$strPattern = '^[a-zA-Z0-9_-]+$';
			//$exceptPattern = '^[^]$';
			
			require '../db/connector.php'; // Because mysql_real_escape_string() need connector
			if ( ereg($strPattern, $_POST['account']) && $message = mysql_real_escape_string(trim($_POST['message'])) ){
				$account = trim($_POST['account']);
				
				$query = mysql_query("
					UPDATE	`member`
					SET	`member` . `unseen` = '1', `message` = '$message'
					WHERE	`member` . `account` = '$account'
				");

				if ($query === true){				
					echo (int)$query;
				}
				else {
					echo (int)false;
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