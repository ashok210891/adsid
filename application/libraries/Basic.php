<?php (! defined('BASEPATH')) and exit('No direct script access allowed');

class Basic
{
public function __construct()
{
	$this->_ci = & get_instance();
	$this->_ci->load->database();
	$this->_ci->load->library("recaptcha");
	$this->_ci->config->load("config");
}

public function contactform($formdata,$table,$captcha="yes")
{
	if(empty($formdata))
	{
		$data["iserror"] = TRUE;
		$data["message"] = "There is some field missing";
		return json_encode($data);
	}
	if($captcha == "yes")
	{
		if (!empty($formdata["g-recaptcha-response"])) 
		{
	        $response = $this->_ci->recaptcha->verifyResponse($formdata["g-recaptcha-response"]);
	        if (!isset($response['success']) && !$response['success'] === true) {
	            $data["iserror"] = TRUE;
				$data["message"] = "Captcha error";
				return json_encode($data);
	        }
	    }
	    else
	    {
			$data["iserror"] = TRUE;
			$data["message"] = "Captcha error";
			return json_encode($data);
		}
		array_pop($formdata);
	}
	$saveusers = FALSE;
	$sql = "insert into ".$table." set ";
	foreach($formdata as $key=>$value)
	{
		$sql .= $key ." = '".$value."'";
		if (end(array_keys($formdata)) != $key)
		$sql .= ",";
	}
	$this->_ci->db->query($sql);
	$adminemail = $this->sendemailtoadmin($formdata);
	$useremail = $this->sendemailtouser($formdata);
	if($adminemail && $useremail)
	{
		$data["iserror"] = FALSE;
		$data["message"] = "Your details sent successfully";
	}
	else
	{
		$data["iserror"] = TRUE;
		$data["message"] = "There is some problem in sending your details";
	}
	return json_encode($data);
}
	
public function sendemailtoadmin($formdata)
{
	$to = $this->_ci->config->item('adminemail');
	$this->_ci->load->library('email');
	$this->_ci->email->from($formdata["email"]);
	$this->_ci->email->to($to);
	$this->_ci->email->set_mailtype("html");
	$this->_ci->email->subject("Email From ".$this->_ci->config->item('sitename'));
	$msg = "<table style='border-collapse:collapse;width: 600px' border>";
	$msg .= "<tbody>";
	foreach($formdata as $key=>$value)
	{
		$msg .= "<tr>";
		$msg .= "<td>".$key."</td>";
		$msg .= "<td>".$value."</td>";
		$msg .= "</tr>";
	}
	$msg .= "</tbody>";
	$msg .= "</table>";
	$this->_ci->email->message($msg);
	$this->_ci->email->send();
	return TRUE;
	//echo $this->_ci->email->print_debugger();
}

public function sendemailtouser($formdata)
{
	$from = $this->_ci->config->item('adminemail');
	$this->_ci->load->library('email');
	$this->_ci->email->from($from);
	$this->_ci->email->to($formdata["email"]);
	$this->_ci->email->set_mailtype("html");
	$this->_ci->email->subject("From ".$this->_ci->config->item('sitename'));
	foreach($formdata as $key=>$value)
	{
		break;
	}
	$name = $value;
	$msg = "Dear ".$name.",<br/><br/>Thank you for visiting our website and for your message.<br/>We will revert to you at the earliest.<br/><br/>Best Regards,<br/>Team ".$this->_ci->config->item('sitename')."<br/>";
	$this->_ci->email->message($msg);
	$this->_ci->email->send();
	return TRUE;
	//echo $this->_ci->email->print_debugger();
}

public function sendemail($from,$to,$subject,$message)
{
	if($from == "" || $to == "" || $subject == "" || $message == "")
	{
		$data["iserror"] = TRUE;
		$data["message"] = "There is some field missing";
		return json_encode($data);
	}
	$this->_ci->load->library('email');
	$this->_ci->email->from($from);
	$this->_ci->email->to($to);
	$this->_ci->email->set_mailtype("html");
	$this->_ci->email->subject($subject);
	$this->_ci->email->message($message);
	$this->_ci->email->send();
	$data["iserror"] = TRUE;
	$data["message"] = "Your mail sent successfully";
	return json_encode($data);
}

}
