<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
		$this->output->set_header('Pragma: no-cache');
		//$this->session->set_userdata('isLogged', FALSE);

		if (($this->session->userdata('userid') == null) || ($this->session->userdata('userid') == "")) {
		} else {
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
		$userName = $this->input->post('email');

		if ($userName != "") {
			$res = $this->webmodel->checkLogin($userName);
			$rowCount = $res["rowCount"];
			$status = $res["status"];

			if ($rowCount == 1 && $status == "active") {
				$data["isError"] = FALSE;
				$data["msg"] = "Please check the email for OTP and enter otp here to login";
			} else {
				if ($status == "inactive") {
					$data["isError"] = TRUE;
					$data["msg"] = "Your Account is not activated.";
				} else {
					$data["isError"] = TRUE;
					$data["msg"] = "Email not found in records";
				}
			}
		} else {
			$data["isError"] = TRUE;
			$data["msg"] = "Please Fill All Details.";
		}
		echo json_encode($data);
	}

	public function checkotp()
	{
		$email = $this->input->post('email');
		$otp = $this->input->post('otp');
		$res = $this->webmodel->checkotpmodel($email, $otp);
		if ($res) {
			$data["isError"] = false;
			$data["msg"] = "Logged in successfully.";
		} else {
			$data["isError"] = true;
			$data["msg"] = "Otp not valid. Please try again";
		}
		echo json_encode($data);
	}

	public function registerCompany()
	{
		$company_name = $this->input->post('company_name');
		$contact_person = $this->input->post('contact_person');
		$company_email = $this->input->post('company_email');
		$company_number = $this->input->post('company_number');
		
		$useremailsubject = "ADSID - Company Registration";
        $useremailheading = "ADSID - Company Registration";
        $useremailmessage = 'Company Name: ' . $company_name . '<br>Contact Person Name: ' . $contact_person . '<br>Company Email: ' . $company_email . '<br>Company Number: ' . $company_number;

        $this->webmodel->sendemailtouserModel("contact@adsid.in", $useremailsubject, $useremailheading, $useremailmessage);

		$data["isError"] = false;
		$data["msg"] = "Company registered successfully!. We will contact you soon.";
		echo json_encode($data);
		return;
	}

	public function testemail()
	{
		$useremailsubject = "ADSID - Test";
        $useremailheading = "ADSID - Test";
        $useremailmessage = 'Test email';

        $this->webmodel->sendemailtouserModel("kashokarun@gmail.com", $useremailsubject, $useremailheading, $useremailmessage, true);
	}
}
