<?php

class Event{
	private $_db;

	public function __construct($db=NULL)
    {
        if(is_object($db))
        {
            $this->_db = $db;
        }
        else
        {
            $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
            $this->_db = new PDO($dsn, DB_USER, DB_PASS);
        }
    }

    //function loads all unresolved events form db
    public function loadUnresolvedEvents(){
    	$sql = "SELECT event.event_id, event.title, event.content, event.last_updated, event.scheduled_to_occur, status.colour, status.name 
    			FROM event 
    			JOIN status 
    			WHERE event.status_id_fk = status.status_id 
    			AND status.resolved = 0; ";

    	$stmt = $this->_db->prepare($sql);
    	$stmt->execute();
    	if($stmt->rowCount()>0){
    		echo "<ul class = 'event'>" ;
    		while($row = $stmt->fetch()){
    			$event_id = $row['event_id'];
    			$event_title = $row['title'];
    			echo $this->formatListItems($row);
    		}
    		echo "</ul>";
    		$stmt->closeCursor();	
    	}
    	else{
    			echo "<p class='no-events'>No Current Events</p>";

    		}
    }
    //<div class='current' style='background-colour:". $colour."'>".$name."</div>
    public function formatListItems($row){
    	$title = $row['title'];
    	$colour = $row['colour'];
    	$name = $row['name'];
    	$content = $row['content'];
    	echo "<li > ".$title."	
    			<p class = 'desc'>" . $content . "</p>
    			<p></p>
    			</li>";
    }

    public function loadResolvedEvents(){
    	$sql = "SELECT event.event_id, event.title, event.content, event.last_updated, event.resolved_date, status.colour, status.name 
    			FROM event 
    			JOIN status 
    			WHERE event.status_id_fk = status.status_id 
    			AND status.resolved = 1; ";

    	$stmt = $this->_db->prepare($sql);
    	$stmt->execute();
    	if($stmt->rowCount()!= NULL){
    		echo "<h3 class = 'future'> Resolved Events</h3><ul class='events resolved'>";
    		while($row = $stmt->fetch()){
    			$title = $row['title'];
    			$resolved = date("F j, Y,g:1 a",strtotime(date($row['resolved_date'])));
    			echo "<li class = 'event' style=''><h4 style=''><a style='' href = ''>"
    					.$title."</a></h4>
    					<p class = 'date'>Resolved At " .$resolved."</p></li>";
    		}
    		echo "</ul>";
    	}
    	else{
    		echo "<p class='no-events'>No Unresolved Events</p><br>";
    	}
    }
}

?>