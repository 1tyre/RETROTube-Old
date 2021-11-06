<!DOCTYPE html>
<?php include 'global.php';?>
<html dark-theme='light'>
<head>
    <link rel="stylesheet" type="text/css" href="./css/global.css">
    <link rel="stylesheet" type="text/css" href="./css/upload.css">
    <link rel="stylesheet" type="text/css" href="./css/index.css">
</head>
<body>
    <?php include("header.php");?>
    <strong><h2>its not done yet</h2></strong>
    <?php
    $statement = $mysqli->prepare("SELECT * FROM videos ORDER BY views DESC");
    //$statement->bind_param("s", $_POST['fr']); i have no idea what this is but we don't need it
    $statement->execute();
    $result = $statement->get_result();
    if($result->num_rows !== 0){
        while($row = $result->fetch_assoc()) {
            echo '
                <div class="video container-flex">
                    <div class="col-1-3 video-thumbnail">
                    <a href="viewvideo.php?id='.$row['id'].'">
                        <video>
                            <source src="videos/'.$row['filename'].'" type="video/mp4">
                            Your browser does not support the video tag.
                        </video> 
                    </a>
                    </div>
                    <div class="col-1-3 video-title"><a href="viewvideo.php?id='.$row['id'].'">'.$row['videotitle'].'</a></div>
                    <div class="col-1-3 video-info">
                        <div>From: <a href="profile.php?id='.$row['author'].'">'.$row['author'].'</a></div>
                        <div>Views: <span>'.$row['views'].'</span></div>
                        <div>Likes: <span>'.$row['likes'].'</span></div>
                    </div>
                </div>
                <hr>';
        }
    }
    else{
        echo "It seems there are no videos here. Why don't you upload one?";
    }
    $statement->close();
    ?>
    <hr>
	<?php include("footer.php") ?>
</body>
</html>