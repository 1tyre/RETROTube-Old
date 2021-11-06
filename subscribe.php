<?php include 'global.php';?>
<?php
include("header.php");
if(!isset($_SESSION['profileuser3'])) {
    die("login to subscribe...");
} 
else{
    if(!isset($_GET['id'])){
        die("no");
    } 
    else{
        $a = (int)$_GET['id'];
        $u = $_GET['u'];
        echo $u;
        if((bool)$u === true){
            $mysqli->query("UPDATE users SET subscribers = subscribers-1 WHERE id = '".$a."' LIMIT 1");
            $_SESSION['subscribedto'.$a] = false;
        }
        else{
            $mysqli->query("UPDATE users SET subscribers = subscribers+1 WHERE id = '".$a."'");
            $_SESSION['subscribedto'.$a] = true;
        }
        header("Location: ".$_SERVER['HTTP_REFERER']."");
    }
}
?>
<?php $mysqli->close();?>