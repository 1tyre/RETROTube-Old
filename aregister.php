<!DOCTYPE html>
<?php include 'global.php';?>
<html data-theme="light">
<head>
    <link rel="stylesheet" type="text/css" href="./css/global.css">
    <link rel="stylesheet" type="text/css" href="./css/register.css">
</head>
<body>
    <?php include("header.php"); ?>
    <div class="container-flex">
        <div class="col-1-2">
            <h3>Member Login</h1>
            <p>Already have an account? Login here.</p>
            <div class="card gray">
                <form method='post' action=''>
                    <div class="input-group">
                        <label for="username">Username: </label>
                        <input type="text" name="name" pattern="[^()/><\][\\\x22,;|]+" required>
                    </div>
                    <div class="input-group">
                        <label for="email">Email: </label>
                        <input type="email" name="email" required>
                    </div>
                    <div class="input-group">
                        <label for="password">Password: </label>
                        <input type="password" name="password" required>
                    </div>
                    <div class="input-group">
                        <div></div>
                        <div><button type="submit" class="btn" name="reg_user" class="button">Log In</button></div>
                    </div>
                </form>
            </div>
            <hr>
            <div class="about">
                <b>Join the largest worldwide video-sharing community!</b><br>
                <ul>
                    <li><b>Search and browse</b> millions of commmunity and partner videos</li>
                    <li><b>Comment, rate, and make</b> video responses to your favorite videos</li>
                    <li><b>Upload and share</b> your videos with millions of other users</li>
                    <li><b>Save your favorite</b> videos to watch and share later</li>
                </ul>
            </div>
            <?php
            if (!empty($_POST)){
                //i should add captcha support lol but cloudfront breaks it
                $sql = "SELECT `username` FROM `users` WHERE `username`='". htmlspecialchars($_POST['name']) ."'";
                $result = $mysqli->query($sql);
                if($result->num_rows >= 1) {
                    echo "Username already exists, try something else.";
                } else {
                    $statement = $mysqli->prepare("INSERT INTO `users` (`date`, `username`, `email`, `password`) VALUES (now(), ?, ?, ?)");
                    $statement->bind_param("sss", $username, $email, $password);
                    $username = htmlspecialchars($_POST['name']);
                    $email = htmlspecialchars($_POST['email']);
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $statement->execute();
                    $statement->close();
                    $mysqli->close();
                    echo "<br><br>Sucessfully made a RETROTube account!<br><a href='./alogin.php'>CLICK HERE TO LOGIN</a>";
                }
            }
            ?>
        </div>
        <div class="col-1-2">
            <h3>Create Your Account</h1>
            <p>It's free and easy. Just fill out the account info below. <span class="red">(All fields required)</span></p>
            <div class="card blue">
                <form method='post' action=''>
                    <div class="input-group">
                        <label for="username">Username: </label>
                        <input type="text" name="name" pattern="[^()/><\][\\\x22,;|]+" required>
                    </div>
                    <div class="input-group">
                        <label for="email">Email: </label>
                        <input type="email" name="email" required>
                    </div>
                    <div class="input-group">
                        <label for="password">Password: </label>
                        <input type="password" name="password" required>
                    </div>
                    <div class="input-group">
                        <div></div>
                        <div><button type="submit" class="btn" name="reg_user" class="button">Sign Up</button></div>
                    </div>
                </form>
            </div>
            <div class="card message">
                Never give your password to a stranger!
            </div>
        </div>
    </div>
    <hr>
    <?php include("footer.php") ?>
</body>
</html>
<?php $mysqli->close();?>