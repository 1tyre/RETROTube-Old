<header>
	<style type="text/css">
		.menu-element{
			display: inline-block;
			font-size: 14px;
			margin: 5px;
			position: absolute;
			right: 0;
		}
		header{
			position: relative;
		}
		.header-buttons{
			margin: 0px 20%;
		}
		.header-button{
	        cursor: pointer;
	        color: var(--main-a);
	        font-weight: bold;
	        font-size: 12px;
	        padding: 7px 35px;
	        border-radius: 5px 5px 0 0;
	        border: 1px solid var(--header-border);
	        background: linear-gradient(var(--header-button-1), var(--header-button-2));
	        border-bottom: 0px;
	        text-align: center;
	        margin: 0px 5px;
	        text-decoration: none;
	    }
	    .brand-logo:{
	    	display: block;
	    }

		.brand-logo > img{
			content: var(--rlogo);
		}
	</style>
	<a class="brand-logo" href="."><img src="retrotube.gif"></a>
	<?php
      if(!$loggedIn) {
        echo '<div class="menu-element"><strong><a href="./aregister.php">Sign Up</a></strong> | <a href="./alogin.php">Login</a> | <a href="./help.php">Help</a></div>';
      } else {
        $statement = $mysqli->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
			    $statement->bind_param("s", $_SESSION['profileuser3']);
			    $statement->execute();
			    $result = $statement->get_result();
			    if($result->num_rows === 0) exit('No rows');
			    while($row = $result->fetch_assoc()) {
			        echo "<div class=\"menu-element\"><strong>Hello, <a href=\"./profile.php?id=".$row["id"]."\">".$row["username"]."</a></strong> | <a href=\"./account.php\">My Account</a> | <a href=\"./alogout.php\">Logout</a> | <a href=\"./help.php\">Help</a></div>";
			    }
			    $statement->close();
      }
    ?>
	<div class="container-flex header-buttons">
	    <a class="col-generic header-button" href="./">Home</a>
	    <a class="col-generic header-button" href="./videos.php">Videos</a>
	    <a class="col-generic header-button" href="./channels.php">Channels</a>
	    <a class="col-generic header-button" href="./community.php">Community</a>
	    <a class="menu-element" href="./upload.php"><img src="buttonupload.png"></a>
	</div>
	<div class="header">
	    <center><input type="text" placeholder=""> <button type="button">Search</button></center>
	</div>
</header>

<div style="
    color: var(--txtcol);
    background-color: var(--card-blue-1);
    border: 1px solid var(--card-blue-2);
    padding: 7px 15px;
    font-size: 12px;
    border-radius: 7px;
    text-align: center;
">we now have a discord server, <strong><a href="https://discord.gg/hNv54nqd3u">join now!</a></strong></div>
