<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
class Api extends CI_Controller
{
	public function __construct($config = 'rest')
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		parent::__construct();
	}
	public function addPoints()
	{
		$input = json_decode(file_get_contents('php://input'), true);

		$firstResponse = $input['firstResponse'];
		$mobileNo = $input['mobileNo'];
		$age = $input['age'];
		if (intval($age) < 21) {
			$data['status'] = 'Failed';
			$data['message'] = 'You are not eligible for participate in this contest';
			header('Content-Type: application/json');
			echo json_encode($data);
		} else {
			if (strlen($firstResponse) == 6) {
				$this->scanQrCode($firstResponse, $mobileNo, $age);
			} else if (strlen($firstResponse) == 10) {
				$this->reference($firstResponse, $mobileNo, $age);
			} else {
				$data['status'] = 'Failed';
				$data['message'] = 'Please enter the correct response';
				header('Content-Type: application/json');
				echo json_encode($data);
			}
		}
	}
	public function scanQrCode($qrCode, $mobileNo, $age)
	{
		if ($mobileNo == '' || strlen($mobileNo) < 10 || $qrCode == '') {
			$data['status'] = 'Failed';
			if ($qrCode == '')
				$data['message'] = 'Please enter valid Qrcode';
			else
				$data['message'] = 'Please enter valid mobile number';
		} else {
			$qrCode_id = $this->apimodel->getQrCode($qrCode);
			$user_id = $this->apimodel->checkUser($mobileNo, $age);
			$result = $this->apimodel->saveData($qrCode_id, $user_id['userid']);

			if ($result) {
				$data['status'] = 'Success';
				$data['message'] = 'Scaned Qr code value updated';
			} else {
				$data['status'] = 'Failed';
				$data['message'] = 'Already scaned this Qr code';
			}
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function reference($refMobile, $userMobile, $age)
	{
		$refUser = $this->apimodel->checkUser($refMobile);
		if ($refUser['userid'] == 0) {
			$data['status'] = 'Failed';
			$data['message'] = 'Reference user not exist';
				
		} else {
			$userData = $this->apimodel->checkUser($userMobile, $age);
			if(!$userData['newuser']){
				$data['status'] = 'Failed';
				$data['message'] = 'This user already exist';
			}else{
				$res = $this->apimodel->saveReference($userData['userid'], $refUser['userid']);
				$data['status'] = 'Success';
				$data['message'] = 'User created Successfully';
			}
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	public function checkUser()
	{
		$input = json_decode(file_get_contents('php://input'), true);

		$userMobile = $input['mobileNo'];
		$userData = $this->apimodel->checkUser($userMobile);

		if ($userData['userid'] == 0) {
			$data['userexist'] = 'false';
			$data['age'] = 0;
		} else {
			$data['userexist'] = 'true';
			$data['age'] = $userData['age'];
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}
}
