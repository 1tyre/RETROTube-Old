<!DOCTYPE html>
<?php include 'global.php';?>
<html data-theme="light">
    <head>
        <title><?php 
            $statement = $mysqli->prepare("SELECT username FROM users WHERE id = ? LIMIT 1");
            $statement->bind_param("i", $_GET['id']);
            $statement->execute();
            $result = $statement->get_result();
            while($row = $result->fetch_assoc()) {
                echo $row['username']."'s Profile - RETROTube";
            }
            $statement->close();
        ?></title>
        <link rel="stylesheet" type="text/css" href="./css/global.css">
        <link rel="stylesheet" type="text/css" href="./css/profile.css">
    </head>
    <body>
        <?php include("header.php");?>
        <div class="container-flex">
            <div class="col-2-3">
                <?php
                    $statement = $mysqli->prepare("SELECT `username`, `id`, `subscribers` FROM `users` WHERE `id` = ? LIMIT 1");
                    $statement->bind_param("i", $_GET['id']);
                    $statement->execute();
                    $result = $statement->get_result();
                    while($row = $result->fetch_assoc()) {
                        $finalstring = "<h3>User ".$row['username']."</h3>
                        <img class=\"user-pic\" src=\"pfp/".getUserPic($row["id"])."\">
                        <div class=\"user-info\">
                            <div class=\"user-name\"><a href=\"profile.php?id=".$row["id"]."\">".$row["username"]."</a></div>
                            <div><span class=\"black\">".$row["subscribers"]."</span> subscribers</div>";
                            if($_SESSION["subscribedto".$row["id"]] === false) {
                                $finalstring .= "<div><a href=\"subscribe.php?id=".$row["id"]."&u=0\"><img src=\"buttonsub.png\"></a></div>";
                            }
                            else{
                                $finalstring .= "<div><a href=\"subscribe.php?id=".$row["id"]."&u=1\"><img src=\"buttonunsub.png\"></a></div>";
                            }
                        $finalstring .= "</div>";

                        echo $finalstring;
                        $username = $row["username"];
                    }
                    $statement = $mysqli->prepare("SELECT * FROM `videos` WHERE `author` = ?");
                    $statement->bind_param("s", $username);
                    $statement->execute();
                    $result = $statement->get_result();
                    echo "<hr><h3>Videos</h3>";
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
                                    <div>Vistas: <span>'.$row['views'].'</span></div>
                                    <div>Likes: <span>'.$row['likes'].'</span></div>
                                </div>
                            </div>
                            <hr>';
                    }
                    }
                    else{
                        echo("This user has no videos.");
                    }
                    $statement->close();
                ?>
            </div>
            <div class="col-1-3">
                <?php
                $statement = $mysqli->prepare("SELECT `description` FROM `users` WHERE `id` = ? LIMIT 1");
                $statement->bind_param("i", $_GET['id']);
                $statement->execute();
                $result = $statement->get_result();
                while($row = $result->fetch_assoc()) {
                    echo "<div class='card message'>
                    <div class='card-header'>Description</div>
                    ".$row["description"]."
                    </div>";
                }
                $statement->close();
                ?>
            </div>
        </div>
        <script src="js/themes-global.js"></script>
    </body>
    <?php $mysqli->close();?>
<html>