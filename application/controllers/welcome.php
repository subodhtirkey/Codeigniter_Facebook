<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {


	public function index()
	{
		$this->login();
	}

	public function login()
	{
		$this->load->library('fbconnect');

		$this->load->view('login');
	}

	public function members(){

		
		//$data = $this->session->all_user_data();
		//$this->load->view('members');
		
		if($this->session->userdata('is_logged_in')){
			$data = $this->session->all_userdata();
			$this->load->view('members',$data);
		}
		else
		{
			redirect(base_url().'welcome/login');
		}
		
	}


	public function facebook_request()
	{
		$this->load->library('fbconnect');
		$data = array(
			'redirect_uri' => base_url('welcome/handle_facebook_login') ,
			'scope' => 'email,user_groups',
		 
			);

		redirect($this->fbconnect->getLoginUrl($data));
		
	}


	public function handle_facebook_login()
	{
			$this->load->library('fbconnect');
			
			$this->load->model('users');

			$facebook_user = $this->fbconnect->user;

			if($this->fbconnect->user)
			{

				//echo "Sam";
					
				if($this->users->is_member($facebook_user))
				{
					$this->users->log_in($facebook_user);
					redirect(base_url().'welcome/members');
				}
				else
				{
					$this->users->sign_up_from_facebook($facebook_user);
					$this->users->log_in($facebook_user);
					redirect(base_url().'welcome/members');
				}

				
			}
			else
			{
				echo "Could Not Log In";
			}
	}


	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url().'welcome/login');
	}

}


