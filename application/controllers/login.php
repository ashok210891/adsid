<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		//$this->session->set_userdata('isLogged', FALSE);

		if(($this->session->userdata('userid') == null) || ($this->session->userdata('userid') == ""))
		{

		}
		else
		{
			redirect(base_url());
		}
	}


/*Login Starts*/

public function index()
{
	$this->load->view('login');
}

public function checkLogin()
{
	$userName = $this->input->post('userName');
	$password = $this->input->post('password');

	if($userName != "" && $password != "")
	{
		$res = $this->webmodel->checkLogin($userName, $password);
		$rowCount = $res["rowCount"];
		$status = $res["status"];

		if($rowCount == 1 && $status == "active")
		{
			$data["isError"] = FALSE;
			$data["msg"] = "You Are Logged In Successfully.";
		}
		else
		{
			if($status == "inactive")
			{
				$data["isError"] = TRUE;
				$data["msg"] = "Your Account is not activated.";
			}
			else
			{
				$data["isError"] = TRUE;
				$data["msg"] = "Email Or Password Is Not Matched.";
			}
		}
	}
	else
	{
		$data["isError"] = TRUE;
		$data["msg"] = "Please Fill All Details.";
	}
	echo json_encode($data);
}

/* login Ends*/

}
