<?php
class ShareModel extends Model{
	public function Index(){
		$this->query('SELECT * FROM share_board ORDER BY updated_at DESC');
		$rows = $this->resultSet();
		return $rows;
	}

	public function add(){
		// Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		if($post['submit']){

			if($post['title'] == '' || $post['body'] == '' || $post['link']){
				Messages::setMessage('Please fill in all fields', 'error');
				return;
			}
			// Insert into MySQL
			$this->query('INSERT INTO share_board (title, body, link, id) VALUES(:title, :body, :link, :id)');
			$this->bind(':title', $post['title']);
			$this->bind(':body', $post['body']);
			$this->bind(':link', $post['link']);
			$this->bind(':id', 1);
			$this->execute();
			// Verify
			if($this->lastInsertId()){
				// Redirect
				header('Location: '.ROOT_URL.'shares');
			}
		}
		return;
	}
}