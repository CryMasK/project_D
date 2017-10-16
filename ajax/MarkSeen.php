<?php
	if ( isset($_POST['account']) ){
		if ( !(empty($_POST['account'])) ){
			$strPattern = '^[a-zA-Z0-9_-]+$';
			if ( ereg($strPattern, $_POST['account']) ){
				require '../db/connector.php';
				$account = trim($_POST['account']);
				
				$query = mysql_query("
					UPDATE	`member`
					SET	`unseen` = '0'
					WHERE	`member` . `account` = '$account'
				");

				if ($query === true){				
					echo "1";
				}
				else {
					echo "0";
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