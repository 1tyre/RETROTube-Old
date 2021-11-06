<!DOCTYPE html>
<?php include 'global.php';?>
<head>
    <link rel="shortcut icon" href="./favicon.ico">
	<link rel="stylesheet" type="text/css" href="./css/global.css">
	<link rel="stylesheet" type="text/css" href="./css/account.css">
</head>
<body>
	<?php include("header.php");?>
	<div class="container-flex">
		<div class="col-1-2">
		    <h3>Edit your settings</h3>
		    <div class="card blue">
			<form action="" method="post" enctype="multipart/form-data">
				<div class="input-group">
				    <label for="new_pic">Set a new picture: </label>
				    <input type="file" name="new_pic" id="new_pic">
				</div>
				<div class="input-group">
				    <label for="description">Description: </label>
				    <textarea name="description" rows="4" cols="50"></textarea>
				</div>
				<div class="input-group">
					<div></div>
					<div><input type="submit" value="Update" name="submit"></div>
				</div>
				<div class="input-group">
					<div></div>
					<div class="red"><?php
				if (isset($_POST["submit"])){
					if(isset($_FILES["new_pic"]) && is_uploaded_file($_FILES["new_pic"]["tmp_name"])){
						$supportedFormats = [
							"image/jpeg",
							"image/png",
							"image/gif",
						];
					    $uid = 0;
					    try{
					    	$uid = idFromUser($_SESSION["profileuser3"]);
						    $target_file = "./pfp/".$uid;
						    $supported = false;
						    foreach($supportedFormats as $value){
						    	if($value === mime_content_type($_FILES["new_pic"]["tmp_name"])){
						    		$supported = true;
						    	}
						    }
						    if($supported === true && $_FILES["new_pic"]["size"] < 5000000){
						    	file_put_contents($target_file, file_get_contents($_FILES["new_pic"]["tmp_name"]));
						    }
						    else{
						    	if(!$supported){
						    		echo "Image not supported (jpg, png or gif)";
						    	}
						    	else{
							    	echo "Image is too large";
						    	}
						    }
					    }
					    catch(Exception $e){
					    	echo "Something happened: ".$e;
					    }
					}
					if(!empty($_POST['description'])){
						$statement = $mysqli->prepare("UPDATE `users` SET `description` = ? WHERE `username` = '" . $_SESSION["profileuser3"] . "'");
					    $statement->bind_param("s", $description);
					    $description = str_replace(PHP_EOL, "<br>", htmlspecialchars($_POST['description']));
					    $statement->execute();
					    $statement->close();
					}
				}
			?></div>
				</div>
			</form>
			</div>
		</div>
		<hr>
		<div class="col-1-2">
			<h3>Your Account Details</h3>
			<?php
			if(isset($_SESSION['profileuser3'])){
			    $statement = $mysqli->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
			    $statement->bind_param("s", $_SESSION['profileuser3']);
			    $statement->execute();
			    $result = $statement->get_result();
			    if($result->num_rows === 0) exit('No rows');
			    while($row = $result->fetch_assoc()) {
			        echo "
			        <div class=\"user-info\">
				        <a href=\"./profile.php?id=".$row["id"]."\"><img class=\"user-pic\" src=\"pfp/".getUserPic($row["id"])."\"></a>
				        <div class=\"user-stats\">
					        <div class=\"username\"><a href=\"./profile.php?id=".$row["id"]."\">".$row["username"]."</a></div>
					        <div><span class=\"subscribers black\">".$row["subscribers"]."</span> subscribers</div>
					        <div>Your E-mail: <span class=\"black\">".$row["email"]."</span></div>
					        <div>Joined: <span class=\"black\">".$row["date"]."</span></div>
				        </div>
			        </div>
			        <hr>
			        <h3>Your Current Description</h3>
			        <textarea class=\"current-description\" readonly>".$row["description"]."</textarea>";
			    }
			    $statement->close();
			}
			?>
		</div>
	</div>
	<?php include("footer.php") ?>
</body>
<?php $mysqli->close();?>