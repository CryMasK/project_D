<?php
    // 使用utf-8編碼
    //header("Content-Type:text/html; charset=utf-8");

    if (isset($_POST['uID']) && isset($_POST['longitude']) && isset($_POST['latitude']) && isset($_POST['state']) ){
		if ( !(empty($_POST['uID'])) && !(empty($_POST['longitude'])) && !(empty($_POST['latitude'])) && !(is_null($_POST['state'])) ){
			$strPattern = '^[a-zA-Z0-9_-]+$';
			$numPattern = '^[0-9\.\-]+$';
			$boolPattern = '^[0|1]{1}$'; // Not real boolean value, use number "0" & "1" instead
			if ( ereg($strPattern, $_POST['uID']) && ereg($numPattern, $_POST['longitude']) && ereg($numPattern, $_POST['latitude']) && ereg($boolPattern, $_POST['state']) ){
				if ( (-180<=(int)$_POST['longitude'] && (int)$_POST['longitude']<=180) && (-90<=(int)$_POST['latitude'] && (int)$_POST['latitude']<=90) ){
					require '../db/connector.php';
					$uID = trim($_POST['uID']); // .trim() 去空格
					$longitude = trim($_POST['longitude']);
					$latitude = trim($_POST['latitude']);
					$date = date('Y-m-d H:i:s');
					$state = trim($_POST['state']);
					
					if ( isset($_POST['is_member']) && !(empty($_POST['is_member'])) && ereg($boolPattern, $_POST['is_member']) ){ // 可優化項目
						$is_member = trim($_POST['is_member']);
						
						mysql_query("INSERT INTO location (uID, longitude, latitude, date, state, is_member)
									VALUES ('$uID', '$longitude', '$latitude', now(), '$state', '$is_member')");
					}
					else{
						mysql_query("INSERT INTO location (uID, longitude, latitude, date, state)
									VALUES ('$uID', '$longitude', '$latitude', now(), '$state')");
					}
					
					echo "nice try";
				}
				else{
					echo "you are not on the earth";
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
