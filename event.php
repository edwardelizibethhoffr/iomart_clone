<?php
include_once "header.php";
include_once "inc/get_events.php";

?>

<div id = "content">
	<div class="inner">
		<?php
			$e = new Event($db);

			//if post with update_comment is not null we update the given comment
			if($_POST!=NULL && isset($_GET['update_comment']) != NULL){
				$e->editComment($_GET['update_comment'], $_POST['comment'],$_GET['event_id']);
			
			}
			elseif(isset($_GET['r']) == 1){ //mark event as resolved
				$e->eventResolved($_GET['event_id']);
			}
			elseif($_POST!=NULL){
				//if post not null - add new comment
				$e->postComment($_POST['comment'], $_GET['event_id']);
			
			}

			$event_id = $_GET['event_id'];
			$event_array = $e -> getEvent($event_id);
			$resolved = $event_array['resolved'];
			$resolved_date = date("F j, Y,g:1 a",strtotime(date($event_array['resolved_date'])));
			$scheduled_date = date("F j, Y,g:1 a",strtotime(date($event_array['scheduled_to_occur']))); 
			$status_colour = $event_array['colour'];
			$status_name = $event_array['name'];
			$comments = $e->getComments($event_id);

		?>
		<div class="current" style=<?php echo "\"" ?> background-color:<?php echo $status_colour . "\""; ?> > <?php echo $status_name;?> </div>
		<h1><?php echo $event_array['title'];?></h1>
		
		<?php 
			if($resolved){
		?>
		
		<p class = "meta">Resolved At <?php echo $resolved_date; ?></p>
		
		<?php 
			}
			else{
		?>

		<p class = "meta">Scheduled for <?php echo $scheduled_date; ?></p>
		<a href= <?php echo "\"event.php?event_id=".$event_id."&r=1\""?> >Mark As Resolved</a>
		<?php 
			}
		?>	
		
		<p></p>
		<div class = "afm cfm">
			<p><?php echo $event_array['content']; ?></p> 

		</div>
		<p></p>

		<?php 
			if($comments != NULL){
				$latest = $comments[0];
				$comment_id = $latest['comment_id'];
            	$latest_date = date("F j, Y,g:1 a",strtotime(date($latest['date_added'])));
            	$latest_content = $latest['content'];
		?> 
				<div id = 'comments'>
					  <h2>Latest Update</h2>
					  <div class='comment'>
					  <h4><div class='meta'>Updated at <?php echo $latest_date; ?> </div></h4>
					  <div class='afm cfm'>
					  	<p><?php echo $latest_content; ?></p>

					  </div>
					  
					  <?php //if logged in can edit/delete comment
					  	if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Useremail'])){
					  ?>
					  <div>
					  <a href="javascript:toggleEdit()">Edit</a>   <a style="position:relative;left:25px;" class ='delete' >Delete</a>
					  
					  <div id= 'hidden_edit' style="display:none;">

					  		<form method="post" action= <?php echo "\"event.php?event_id=".$event_id."&update_comment=".$comment_id."\"" ?> ><dl><dd>
							<textarea name = "comment"><?php echo $latest_content ?> </textarea>
							<dd>
							<dd class="submit">
							<input name="commit" value="Add Comment" type="submit">
							</dd>
							</dl>
							</form>
					  </div>
					  
					  <br><br>
					  </div>
					  <?php
					  	}
					  ?>

					  </div>

			<?php  //OPEN IF
				if(count($comments)>1){
					$num_comments = count($comments)-1;

			?>
				
				<h2>Previous Updates (<?php echo $num_comments; ?>) - 
					<a id="expand_comments" href = "javascript:toggleVisible('hidden_comments')" >Show</a>
				</h2>
				<div id="hidden_comments" style="display: none;">
					  	 
				<?php //START FOR
					for($i=1 ;$i < count($comments); $i++){
					  	$comment = $comments[$i];
					  	$id = $comment['comment_id'];
					  	$date = date("F j, Y,g:1 a",strtotime(date($comment['date_added'])));
					  	$content = $comment['content'];
				?>

				<div class='comment'>
					<h4><div class='meta'>Updated at <?php echo $date; ?> </h4>
					
					<div class='afm cfm'><p><?php echo $content; ?></p></div>
				</div>

				<?php //END FOR
					  }
				?>

				</div>
				</div>

			<?php
					} //CLOSE IF
				}
				 //if user is logged in enable add comment
				if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Useremail'])){
			?>

			<div class="add comment"> 
				<form method="post" action= <?php echo "\"event.php?event_id=".$event_id."\"" ?> ><dl><dd>
				<textarea name = "comment" onfocus="clearContents(this);">Add comment...</textarea>
				<dd>
				<dd class="submit">
					<input name="commit" value="Add Comment" type="submit">
				</dd>
				</dl>
				</form>
				<p></p>

			</div>

			<?php
				} 
			?>
	</div>

</div>

<?php
	include_once "footer.php";
?>