<!DOCTYPE html>
<html>

<?php
    include_once "db.php";
?>

<head>
    <title>Melbourne Service Status</title>
    <link rel="stylesheet" type="text/css" href = "reset.css"></link>
    <link rel="stylesheet" type="text/css" href = "application.css"></link>
    <link rel="stylesheet" type="text/css" href = "afm.css"></link>
    <script type="text/javascript" src="application.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

    <link type = "application/rss+xml" title = "Subscribe to the RSS feed" rel = "alternate" 
            href = "localhost:81/mel/events-rss.php"></link>
</head>

<body>

        <div id="header">
            <div class = "inner">
            <ul>
            <li><a href = "/mel">Home</li>
            <li><a href = "resolved.php">Resolved Events</a></li>
            <li><a href = "http://www.melbourne.co.uk">Website</a></li>
            <li><a href = "http://www.twitter.com/melbournehost">Twitter</a></li>
            <li><a href = "http://support.melbourne.co.uk">Support</a></li>
            <?php 
                if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Useremail']) && $_SESSION['LoggedIn']==1):
            ?>
            <li>Logged in: <a href = "login.php"><?php echo $_SESSION['Useremail'];?></a></li>
        <?php else: ?>
            <li><a href = "login.php">Login</a></li>
        <?php endif; ?>    
        </ul>
        </div>

        </div>