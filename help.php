<!DOCTYPE html>
<?php include 'global.php';?>
<head>
	<link rel="stylesheet" type="text/css" href="./css/global.css">
</head>
<body>
	<?php
	include("header.php");
	?>
	<h2>FAQ</h2>
	<p>
	<h4>Q: What are my passwords hashed with?</h4>
	<p>A: All passwords are plaintext. (just kidding, its bcrypt lol)</p>
	<h4>Q: Help! I can't upload a video. When I try to upload it, it loads for a few seconds and then does nothing!</h4>
	<p>A: Unfortunately there is no current known fix for it. I would advise you to do the following things though.</p>
	    <ul>
	    	<li>changing video file name</li>
	    	<li>upload a video with a smaller file size</li>
	    </ul>
	<h4>Q: What features will you add soon?</h4>
	<p>
	A: I'll add some new stuff soon I guess.<br><br>
	Contact server: https://discord.gg/hNv54nqd3u<br>
	</p>
	<hr>
    <?php include("footer.php") ?>
</body>
<?php $mysqli->close();?>