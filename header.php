<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
    include_once "db.php";
?>

<head>
    <title>Melbourne Service Status</title>
    <link rel="stylesheet" type="text/css" href = "reset.css"></link>
    <link rel="stylesheet" type="text/css" href = "application.css"></link>
    <link rel="stylesheet" type="text/css" href = "afm.css"></link>

    <script type='text/javascript' src='//ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js?ver=1.3.2'></script>
    <link type = "application/rss+xml" title = "Subscribe to the RSS feed" rel = "alternate" 
            href = "events.rss"></link>
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