<?php
class UserModel extends Model{
	public function register(){
		// Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		if($post['submit']){
			//encrypt password
			$password = md5($post['password']);

			if($post['fullname'] == '' || $post['email'] == '' || $post['password']){
				Messages::setMessage('Please fill in all fields', 'error');
				return;
			}
			// Insert into MySQL
			$this->query('INSERT INTO user_list (fullname, email, password) VALUES(:fullname, :email, :password)');
			$this->bind(':fullname', $post['fullname']);
			$this->bind(':email', $post['email']);
			$this->bind(':password', $password);
			$this->execute();
			// Verify
			if($this->lastInsertId()){
				// Redirect
				header('Location: '.ROOT_URL.'users/login');
			}
		}
		return;
	}

	public function login()
	{

		// Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		if($post['submit']){
			//die('logged in');
		//encrypt password
		$password = md5($post['password']);

		// Compare Login
		$this->query('SELECT * FROM user_list WHERE email = :email AND password = :password');
		//bind values, also look to do attempted number of logins
		$this->bind(':email', $post['email']);
		$this->bind(':password', $password);
		$row = $this->single();

		if($row){
			//creating the session to gather information
			$_SESSION['is_logged_in'] = true;
			$_SESSION['user_data'] = array(
				//here we are capturing the users input
				"id" => $row['id'],
				"fullname" => $row['fullname'],
				"email" => $row['email'],
			);
			//capture the session values then redirect to shares
			header('Location: '.ROOT_URL.'shares');
		} else {
			//static methods, no need for instantiation, passing two arguments to the method
			Messages::setMessage('Incorrect Login', 'error');
		}

	}
	return;
	}


	// public function logout()
	// {

	// 	if($post['logout']){
	// 		$_SESSION['is_logged_in'] = false;
	// 		$_SESSION['is_logged_out'] = true;
	// 		session_abort();
	// 		header('Location: '.ROOT_URL.'login');
	// 	}
	// }
}