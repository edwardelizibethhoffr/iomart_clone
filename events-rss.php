
<rss version="2.0">
<channel>
    <item>
    <title>Melbourne Hosting Status</title>
    <link>localhost:81/mel/index.php</link>
    <description>All Scheduled Events </description>
    </item>

<?php
	include_once "db.php";
	include_once "inc/get_events.php";

    $url = "http://localhost:81/mel/";
    
	$e = new Event($db);
	$result = $e->loadUnresolvedEvents();

	while($row = $result->fetch()){
		$title = $row['title'];
		$id = $row['event_id'];
    	$scheduled = date("F j, Y,g:1 a",strtotime(date($row['scheduled_to_occur'])));
    	echo "<item>
    			<title>".$title."</title> 
    			<link>".$url."event.php?event_id=".$id."</link>
                <description>Scheduled to occur ".$scheduled."</description>
              </item>";
    		}
?>

</channel>
</rss>