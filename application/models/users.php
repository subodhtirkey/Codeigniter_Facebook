<?php  


class Users extends CI_Model {
	
	public function is_member($facebook_user){

		$this->db->where('email',$facebook_user['email']);

		$query = $this->db->get('myusers');

		if($query->num_rows()==1){

			return true;
		}
		else
		{
			return false;
		}
		

	}

	public function log_in($facebook_user){

		echo $facebook_user['name'];

		$data = array(
			'is_logged_in' => 1 ,
			'email' => $facebook_user['email'],
			'name' =>$facebook_user['name'] 
			);
		$this->session->set_userdata($data);

	

	}
	public function sign_up_from_facebook($facebook_user){

		//Data Taken

		$first_name = $facebook_user['first_name'];
		$last_name = $facebook_user['last_name'];
		$facebook_id = $facebook_user['id'];
		$email = $facebook_user['email'];
		
		$data = array(
			'first_name' => $first_name,
			'last_name' => $last_name,
			'facebook_id' => $facebook_id,
			'email' => $email 
			);

		$this->db->insert('myusers', $data);

		
		
	}
	
	

}