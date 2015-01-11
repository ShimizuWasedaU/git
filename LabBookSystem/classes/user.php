<?php
include('password.php');
class User {

    private $_db;

    function __construct($db){
    
    	$this->_db = $db;
    }

	private function get_user_hash($username){	
	
			$stmt ="SELECT password FROM user WHERE user_name = '$username'";
			$result= $this->_db->query($stmt);
			
			$row = $result->fetch_assoc();
			return $row['password'];
	}

	public function login($username,$password){

		$hashed = $this->get_user_hash($username);
		
		if($hashed==$password&&$username!=""){
		    
		    $_SESSION['loggedin'] = true;
			$_SESSION['username'] = $username;
		    
			//read user profile
		    $result = $this->_db->query("SELECT * FROM user WHERE user_name = '$username'");
		    $row = $result->fetch_assoc();
			$_SESSION['userid']=$row['user_id'];
			$_SESSION['password']=$row['password'];
			$_SESSION['email']=$row['email'];
			$_SESSION['identity']=$row['identity'];
			$_SESSION['authority']=$row['authority'];

		    return true;
		} 	
	}
		
	public function logout(){
		session_destroy();
	}

	public function is_logged_in(){
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
			return true;
		}		
	}
	
	public function is_admin(){
		if(isset($_SESSION['authority']) && $_SESSION['authority'] == admin){
			return true;
		}	
	}
	
}


?>