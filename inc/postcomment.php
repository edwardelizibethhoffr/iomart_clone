<?php
include_once "dbconstants.php";
include_once "db.php";

try{
	$sql = "INSERT INTO comment(event_id, date_added, content) VALUES ()";
	$db->exec($sql);
}

?>