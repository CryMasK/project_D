<?php
	if ( isset($_POST['account']) ){
		if ( !(empty($_POST['account'])) ){
			$strPattern = '^[a-zA-Z0-9_-]+$';
			if ( ereg($strPattern, $_POST['account']) ){
				require '../db/connector.php';
				$account = trim($_POST['account']);
				
				$query = mysql_query("
					SELECT	`member` . `unseen`, `message`
					FROM	`member`
					WHERE	`member` . `account` = '$account'
				");

				if (mysql_num_rows($query) !== 0){
					while($result = mysql_fetch_assoc($query)){
						$unseen = $result["unseen"];
						if ($unseen == '1'){				
							echo $message = $result["message"];
						}
						else {
							// echo nothing
							echo NULL;
						}
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