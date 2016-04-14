<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Melbourne Service Status</title>
    <link rel="stylesheet" type="text/css" href = "reset.css"></link>
    <link rel="stylesheet" type="text/css" href = "application.css"></link>
    <link rel="stylesheet" type="text/css" href = "afm.css"></link>

    <script type='text/javascript' src='//ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js?ver=1.3.2'></script>
</head>

<body>

        <div id="header">
            <div class = "inner">
            <ul>
            <li><a href = "/mel">Home</li>
            <li><a href = "resolved">Resolved Events</a></li>
            <li><a href = "http://www.melbourne.co.uk">Website</a></li>
            <li><a href = "http://www.twitter.com/melbournehost">Twitter</a></li>
            <li><a href = "http://support.melbourne.co.uk">Support</a></li>
            <?php 
                if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Useremail']) && $_SESSION['LoggedIn']==1):
            ?>
            <li><a href = "logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href = "login.php">Login</a></li>
        <?php endif; ?>    
        </ul>
        </div>

        </div>