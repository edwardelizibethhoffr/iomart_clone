<?php
	include_once "header.php";
	include_once "inc/event.php";
	//include_once "db.php";
?>

<div id = "content">
<div class = "inner">
	<h1>Melbourne Server Hosting</h1>
	<p class="meta">
			Any information regarding active issues or planned maintenance will be made available here.
		</p>
		
	<?php
		$e = new Event($db);
		$e->loadResolvedEvents();
	?>
</div>
</div>

<?php 
	include_once "footer.php";
?>