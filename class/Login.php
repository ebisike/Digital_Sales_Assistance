<?php

require 'DB.php';
/**
* 
*/
class Login extends DB
{
	public function userlogin($user_id,$pwd){
		$sql = "SELECT * FROM user WHERE email='$user_id' AND password='$pwd'";
		$stmt = DB::DBInstance()->query($sql);
			if($stmt->ifExist()==1) {
				$result = $stmt->getResults();
				if($pwd == $result['password']) {
					return $result;
				}else{
					echo "<script>alert('Usernam and Password do not match')</script>";
					return false;
				}
			}else{
				echo "<script>alert('Login Details does not Exist')</script>";
				return false;
			}
	}

	public function loggedin(){
		if(isset($_SESSION['id'])){
			return true;
		}else{
			return false;
		}
	}

	public function isSessionExpired(){
		$sessionDuration = 10;
		if(isset($_SESSION['time']) && isset($_SESSION['id'])){
			if((time() - $_SESSION['time'])>$sessionDuration){
				return true;
			}
			return false;
		}else{
			echo "Not Logged In!";
		}
	}

	public function expired(){
		if((time()-$_SESSION['time'])>$_SESSION['expire_time']){
			return true;
		}else{
			$_SESSION['last_activity']=time();
		}
	}

	public function setSessionId($id){
		$_SESSION['id'] = $id;
		$_SESSION['time'] = time();
	}

	public function checkIfLogin(){
		if(isset($_SESSION['id'])){
			//if($this->expired()){
			//	header("Location: /sunesismobile/logout.php");
			//}else{
				return true;
			//}
		}else{
			header("Location: /sunesismobile/index.php");
		}
	}
}