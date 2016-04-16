<?php
//class handles queries to database for resolved and unresolved events
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
    			AND status.resolved = 0 ORDER BY scheduled_to_occur ASC; ";

    	$stmt = $this->_db->prepare($sql);
    	$stmt->execute();
    	return $stmt;
    }

    
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

    public function getResolvedEvents(){
    	$sql = "SELECT event.event_id, event.title, event.content, event.last_updated, event.resolved_date, status.colour, status.name 
    			FROM event 
    			JOIN status 
    			WHERE event.status_id_fk = status.status_id 
    			AND status.resolved = 1 ORDER BY resolved_date DESC; ";

    	$stmt = $this->_db->prepare($sql);
    	$stmt->execute();
    	return $stmt;
    }

    //function returns event row from table by id
    public function getEvent($id){
        $sql = "SELECT *
                FROM event
                JOIN status
                WHERE event_id = ".$id."
                AND status.status_id = event.status_id_fk;";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

    //returns all comments for a given event id
    public function getComments($id){
        $sql = "SELECT *
                FROM comment
                WHERE event_id=".$id."
                ORDER BY date_added DESC;";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        return $stmt ->fetchAll();       
    }

    //function posts new comment to database
    public function postComment($comment,$id){
        $date = date("Y-m-d H:i:s");
        $sql = "INSERT INTO comment(event_id, date_added, content) 
                VALUES (".$id.",'".$date."','".$comment."');";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        
    }

    //function to edit comment
    public function editComment($id,$comment,$event_id){
    
        $date =  date("Y-m-d H:i:s");
        $sql = "UPDATE comment
                SET content='".$comment."', date_added='".$date."'
                WHERE comment_id ='".$id."';
                UPDATE event
                SET last_updated=".$date."
                WHERE event_id=".$event_id.";";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
    }

    public function eventResolved($id){
        $date =  date("Y-m-d H:i:s");
        $sql = "UPDATE event
                SET status_id_fk = 1, resolved_date='".$date."'
                WHERE event_id=".$id.";";
        echo $sql;
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
    }
}

?>