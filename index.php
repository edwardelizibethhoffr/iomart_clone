<?php 
include_once "header.php"; 
include_once "inc/get_events.php";
?>

<div id="content">
	<div class = "inner">
		<h1>Melbourne Server Hosting</h1>
		<p class="meta">
			Any information regarding active issues or planned maintenance will be made available here.
		</p>

		<!-- SOME PHP HERE TO GET ALL UNRESOLVED EVENTS  - RSS?? -->
		

		<?php
		//display all the resolved events paginated - 5 per page 
		$e = new Event($db);
		$result = $e->loadUnresolvedEvents();
		$results_per_page = 5;
		$total_rows = $result->rowCount();
		$total_pages  = ceil($total_rows /$results_per_page);
		$show_page = 1;

		if(isset($_GET['page'])){
			$show_page = $_GET['page'];
			if($show_page > 0 && $show_page <= $total_pages){
				$start = ($show_page - 1) * $results_per_page;
				$end = $start + $results_per_page;
			}
			else{
				$start = 0;
				$end = $results_per_page;
			}
		}
		else{
			$start = 0;
			$end = $results_per_page;
		}
		if(isset($_GET['page'])){
			$page = intval($_GET['page']);
		}
		else{
			$page = 1;
		}
		$tpages = $total_pages;
		if($page <= 0){
			$page = 1;
		}

		$reload = $_SERVER['PHP_SELF'] . "?tpages=" . $tpages;
		$result_array = $result -> fetchAll();
		if($result->rowCount()!= NULL){
    		echo "<h3 class = 'future'> Upcoming Events</h3><ul class='events resolved'>";
    		 for($i = $start; $i < $end; $i++){  //while($row = $result->fetch()){
    			if($i == $total_rows){
    				break;
    			}
    			$row = $result_array[$i];
    			$title = $row['title'];
    			$id = $row['event_id'];
    			$scheduled = date("F j, Y,g:1 a",strtotime(date($row['scheduled_to_occur'])));
    			echo "<li class = 'event' style=''><h4 style=''><a style='' href = 'event.php?event_id=". $id."'>"
    					.$title."</a></h4>
    					<p class = 'date'>Scheduled To Occur At " .$scheduled."</p></li>";
    		}
    		echo "</ul>";

    		//pagination bar at bottom of list
    		echo "<div class = 'pagination'>";
				if($total_pages > 1){
			echo paginate($reload, $show_page, $total_pages);
		}
		echo "</div>";

    	}
    	else{
    		echo "<p class='no-events'>No Current Issues</p><br>";
    	}

	?>

		<p class="contact-support"> 
			For support, please submit a ticket through our <a href = "https://support.melbourne.co.uk">support centre</a>.
		</p>
	</div>
</div>

<?php include_once "footer.php"; ?>