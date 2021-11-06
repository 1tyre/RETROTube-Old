<!DOCTYPE html>
<?php include 'global.php';?>
<html data-theme="light">
<head>
    <link rel="stylesheet" type="text/css" href="./css/global.css">
</head>
<body>
    <?php include("header.php");?>
    <div class="container-flex"> 
        <div class="col-1-2">
            <h3>Member Login</h3>
            <div class="card blue">
                <form method="post" action="alogin.php">
                    <div class="input-group">
                        <label>Username: </label>
                        <input type="text" name="name" required>
                    </div>
                    <div class="input-group">
                        <label>Email: </label>
                        <input type="email" name="email" required>
                    </div>
                    <div class="input-group">
                        <label>Password: </label>
                        <input type="password" name="password" required>
                    </div>
                    <div class="input-group">
                        <div></div>
                        <div><button type="submit" class="btn" name="reg_user" class="button">Login</button></div>
                    </div>
                    <a onclick="alert('Send an email to support@retrotube.ml or Send a message to one of our staff on Discord.')">Forgot your password?</a>
                    <div class="input-group">
                        <div></div>
                        <div class="red">
                            <?php
                                if(!empty($_POST)){
                                    $username = htmlspecialchars($_POST['name']);
                                    $statement = $mysqli->prepare("SELECT `password` FROM `users` WHERE `username` = ? LIMIT 1");
                                    $statement->bind_param("s", $username);
                                    $statement->execute();
                                    $result = $statement->get_result();
                                    if($result->num_rows !== 0){
                                    while($row = $result->fetch_assoc()){
                                            $hash = $row['password'];
                                            if(password_verify($_POST['password'], $hash)){
                                                session_start();
                                                $_SESSION["profileuser3"] = htmlspecialchars($_POST['name']);
                                                header("Location: .");
                                            }
                                            else {
                                                echo 'These credentials do not match our records.';
                                            }
                                        }
                                    }
                                    else{
                                        echo 'These credentials do not match our records.';
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-1-2">
            <h3>Thanks for registering.</h3>
            <p>
            Here are some things I'm adding into this crappy 2007 youtube recreation:
            </p>
            <ul>
                <li>uploading</li>
                <li>admin panel</li>
                <li>better code</li>
            </ul>
            and hopefully...
            <ul>
                <li>opensourcing this project</li>
            </ul>
        </div>
    </div>
    <hr>
    <?php include("footer.php") ?>
</body>
</html>
<?php $mysqli->close();?>