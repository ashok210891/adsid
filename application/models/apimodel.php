<?php
if (! defined('BASEPATH')) {
	exit('No direct script access allowed');
}
class Apimodel extends CI_Model
{
/**
* Index Page for this controller.
*
* Maps to the following URL
* 		http://example.com/index.php/welcome
*	- or -
* 		http://example.com/index.php/welcome/index
*	- or -
* Since this controller is set as the default controller in
* config/routes.php, it's displayed at http://example.com/
*
* So any other public methods not prefixed with an underscore will
* map to /index.php/welcome/<method_name>
* @see http://codeigniter.com/user_guide/general/urls.html
*/


public function getQrCode($qrCode)
{
	$sql = "SELECT * FROM qr_codes WHERE qr_code ='".$qrCode."'";
	$res = $this->db->query($sql);
	$res = $res->result();
	return $res[0]->qr_id;
}
public function saveData($qrCode, $user_id)
{
	$sql = "SELECT * FROM qr_scan WHERE qr_id ='".$qrCode."' and userid = '".$user_id."'";
	$res = $this->db->query($sql);
	if ($res->num_rows() > 0)
		return FALSE;
	
	$sqlinsert = "insert into qr_scan SET qr_id = '".$qrCode."',userid = '".$user_id."'";
	$res = $this->db->query($sqlinsert);
	return TRUE;
}
public function checkUser($mobileNo, $age = 0)
{
	$sql = "SELECT * FROM qr_user WHERE mobile_no ='".$mobileNo."'";
	$res = $this->db->query($sql);
	if ($res->num_rows() > 0)
	{
		$res = $res->result();
		$data['userid'] = $res[0]->userid;
		$data['newuser'] = FALSE;
		$data['age'] = $res[0]->age;
		return $data;
	}else{
		if ($age < 21) {
			$data['userid'] = 0;
			$data['newuser'] = FALSE;
		}else{
			$sql = "insert into qr_user SET mobile_no = '".$mobileNo."',age =".$age;
			$res = $this->db->query($sql);
			$data['userid'] = $this->db->insert_id();
			$data['newuser'] = TRUE;
		}
		return $data;
	}
}
public function saveReference($userid, $refUserId)
{
	$sql = "insert into qr_reference set ref_userid = '".$refUserId."',userid = ".$userid;
	$res = $this->db->query($sql);
	
}

}
