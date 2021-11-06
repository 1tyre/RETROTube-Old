<?php
    $mysqli = new mysqli("127.0.0.1", "root", "", "retrotube");
    session_start();

    function idFromUser($nameuser){
    	global $mysqli;
    	$uid = 0;
    	$username = $mysqli->escape_string($nameuser);
		$statement = $mysqli->prepare("SELECT `id` FROM `users` WHERE `username` = ?");
		$statement->bind_param("s", $username);
		$statement->execute();
		$result = $statement->get_result();
		while($row = $result->fetch_assoc()){
			$uid = (int)$row["id"];
		}
		$statement->close();
		return $uid;
    }

    function getUserPic($uid){
    	$userpic = (string)$uid;
		if(file_exists("./pfp/".$userpic) !== TRUE){
			$userpic = "default";
		}
		return $userpic;
    }
    
    $loggedIn = isset($_SESSION['profileuser3']);
?>