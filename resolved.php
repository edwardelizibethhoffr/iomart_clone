<?php
	include_once "header.php";
	include_once "inc/get_events.php";
	include_once "inc/paginate.php";	
?>

<div id = "content">
<div class = "inner">
	<h1>Melbourne Server Hosting</h1>
	<p class="meta">
			Any information regarding active issues or planned maintenance will be made available here.
	</p>

	<?php
		//display all the resolved events paginated - 5 per page 
		$e = new Event($db);
		$result = $e->getResolvedEvents();
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
    		echo "<h3 class = 'future'> Resolved Events</h3><ul class='events resolved'>";
    		 for($i = $start; $i < $end; $i++){  //while($row = $result->fetch()){
    			if($i == $total_rows){
    				break;
    			}
    			$row = $result_array[$i];
    			$title = $row['title'];
    			$id = $row['event_id'];
    			$resolved = date("F j, Y,g:1 a",strtotime(date($row['resolved_date'])));
    			echo "<li class = 'event' style=''><h4 style=''><a style='' href = 'event.php?event_id=". $id."'>"
    					.$title."</a></h4>
    					<p class = 'date'>Resolved At " .$resolved."</p></li>";
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
    		echo "<p class='no-events'>No Unresolved Events</p><br>";
    	}

	?>
</div>
</div>

<?php 
	include_once "footer.php";
?>