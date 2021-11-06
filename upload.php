<!DOCTYPE html>
<?php include 'global.php';?>
<head>
    <link rel="stylesheet" type="text/css" href="./css/global.css">
    <link rel="stylesheet" type="text/css" href="./css/upload.css">
</head>
<body>
    <?php include("header.php");?>
    <div class="container-flex">
        <div class="col-2-3">
            <div class="card blue">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="input-group">
                        <label for="videofile">Select video to upload: </label>
                        <input type="file" name="fileToUpload" id="fileToUpload">
                    </div>
                    <div class="input-group">
                        <label for="videotitle">Video Title: </label>
                        <input type="text" id="videotitle" name="videotitle">
                    </div>
                    <div class="input-group">
                        <label for="bio">Description: </label>
                        <textarea style="background-color: var(--inputlol);" name="bio" rows="4" cols="50" required="required"></textarea>
                    </div>
                    <div class="input-group">
                        <div></div>
                        <div><input type="submit" value="Upload" name="submit"></div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-1-3">
            <div class="card message">
                <div class="card-header">Uploading Rules:</div>
                <ul>
                    <li>NO GORE/NSFW (video will be deleted)</li>
                    <li>NO ILLEGAL VIDEOS (permenant ip ban off of retrotube.ml)</li>
                    <li>VIDEO METADATA IS NOT CORRUPTED (video will be deleted)</li>
                </ul>
                Thanks.
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['submit'])){
        if(!isset($_SESSION['profileuser3'])) {
            die("login to upload videos...");
        }
        $target_dir = "./videos/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        if(!is_dir($target_dir)){
            mkdir($target_dir);
        }
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (file_exists($target_file)) {
            echo "video with the same filename already exists.";
            $uploadOk = 0;
        }
        if($imageFileType != "mp4") {
            echo "MP4 files only.";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo "unknown error.";
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $statement = $mysqli->prepare("INSERT INTO videos (videotitle, description, author, filename, date) VALUES (?, ?, ?, ?, now())");
                $statement->bind_param("ssss", $videotitle, $description, $author, $filename);
                $videotitle = htmlspecialchars($_POST['videotitle']);
                $description = str_replace(PHP_EOL, "<br>", htmlspecialchars($_POST['bio']));
                $author = htmlspecialchars($_SESSION['profileuser3']);
                $filename = basename($_FILES["fileToUpload"]["name"]);
                $statement->execute();
                $statement->close();
                header("Location: .");
            } else {
                echo "error!!!!!!!!!!!!!!!!!! error code: ";
                echo $_FILES["fileToUpload"]["error"];
            }
        }
    }
    ?>
    <hr>
    <?php include("footer.php") ?>
</body>
<?php $mysqli->close();?>