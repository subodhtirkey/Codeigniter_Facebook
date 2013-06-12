<?php 

include(APPPATH.'libraries/facebook/facebook.php');

class Fbconnect extends Facebook{


	//Declaring the public variables

	public $user = NULL;
	public $user_id = NULL;
	public $fb = false;
	public $fbSession = false;
	public $appkey  = 0;
	
	public function Fbconnect()
	{

		//echo APPPATH.'libraries/facebook/facebook.php';

		$this->ci =& get_instance();
		
		$this->ci->config->load('facebook',TRUE);
		
		$config = $this->ci->config->item('facebook');

		parent::__construct($config); //1
		
		$this->user_id = $this->getUser();

		$me = null;

		if($this->user_id){
			try{
				$me = $this->api('/me');
				$this->user = $me;

			}catch(FacebookApiException $e){
				error_log($e);
			}
		}

	}

	
	/*public function send_back($value)
	{
		return $value;
	}

	public function test()
	{

		$ci =& get_instance();

		$ci->load->helper('url');

		echo base_url();
	}
*/
	
}

