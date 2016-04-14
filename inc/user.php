<?php 

class User {

	private $_db;

	//check for db object create on if none found
	public function __construct($db = null){
		if(is_object($db)){
			$this->_db = $db;
		}
		else{
			$dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
			$this->_db  = new PDO($dsn, DB_USER, DB_PASS);
			
		}
	}

	//check login and logs user in
	public function accountLogin(){
		$sql = "SELECT email 
				FROM user 
				WHERE email =:user_email
				AND password = :pass
				LIMIT 1";

		try{
			if($this->_db == NULL){
				echo "db is null!";
			}
			$stmt = $this->_db->prepare($sql);
			$stmt -> bindParam(':user_email', $_POST['user_email'], PDO::PARAM_STR);
			$stmt -> bindParam(':pass', $_POST['user_password'], PDO::PARAM_STR);
			$stmt->execute();
			if($stmt->rowCount()==1){
				$_SESSION['Useremail'] = htmlentities($_POST['user_email'], ENT_QUOTES);
				$_SESSION['LoggedIn'] = 1;
				return TRUE;
			}
			else{
				return FALSE;
			}

		}
		catch(PDOException $e){
			return FALSE;
		}
	}


}


?>