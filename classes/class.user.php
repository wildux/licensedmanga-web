<?php

include('class.password.php');

class User extends Password{

    private $db;
	
	function __construct($db){
		parent::__construct();
	
		$this->_db = $db;
	}

	public function is_logged_in(){
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
			return true;
		}		
	}
	
	public function is_admin(){
		return (is_logged_in && $_SESSION['user']['type'] > 1);
	}
	
	public function is_superuser(){
		return (is_logged_in && $_SESSION['user']['type'] == 3);
	}

	private function get_user_hash($username){	

		try {

			$stmt = $this->_db->prepare('SELECT id,username,password,type FROM blog_members WHERE username = :username');
			$stmt->execute(array('username' => $username));
			
			$row = $stmt->fetch();
			return $row;

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}
	}

	
	public function login($username,$password){	

		$row = $this->get_user_hash($username);
		$hashed = $row['password'];
		
		if($this->password_verify($password,$hashed) == 1){
		    
		    $_SESSION['loggedin'] = true;
		                 
            // STORE USER DATA IN SESSION
            unset($row['password']);
            $_SESSION['user'] = $row; 
		    return true;
		}		
	}
	
		
	public function logout(){
		session_destroy();
	}
	
}


?>
