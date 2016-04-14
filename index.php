<?php 
include_once "header.php"; 
include_once "inc/event.php";
?>

<div id="content">
	<div class = "inner">
		<h1>Melbourne Server Hosting</h1>
		<p class="meta">
			Any information regarding active issues or planned maintenance will be made available here.
		</p>

		<!-- SOME PHP HERE TO GET ALL UNRESOLVED EVENTS  - RSS?? -->
		<?php 
			$e = new Event($db);
			$e->loadUnresolvedEvents();
		?>
		
		<p class="contact-support"> 
			For support, please submit a ticket through our <a href = "https://support.melbourne.co.uk">support centre</a>.
		</p>
	</div>
</div>

<?php include_once "footer.php"; ?>