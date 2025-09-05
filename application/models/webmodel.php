<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Webmodel extends CI_Model
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


    public function checkLogin($userName)
    {
        $sql = "SELECT * FROM users WHERE email = '" . $userName . "'";
        $res = $this->db->query($sql);

        $otpnumber = random_int(100000, 999999);
        $status = '';
        if ($res->num_rows() > 0) {
            foreach ($res->result() as $row) {
                $status = $row->status;

                if ($status == "active") {

                    $updatarr = array(
                        'user_last_activity' => date('Y-m-d h:i:s'),
                        'otp' => $otpnumber,
                    );
                    $wherearr = array(
                        'id' => $row->id,
                    );
                    $this->db->update('users', $updatarr, $wherearr);

                    $useremailsubject = "ADSID - OTP";
                    $useremailheading = "ADSID - Your login OTP details to access our website";
                    $useremailmessage = 'Your login OTP is: ' . $otpnumber . '<br>
                        <br><br><br>
                        -ADSID Team';

                    $this->sendemailtouserModel($row->email, $useremailsubject, $useremailheading, $useremailmessage);
                }
            }
        }
        $resArr["rowCount"] = $res->num_rows();
        $resArr["status"] = $status;
        return $resArr;
    }

    public function sendemailtouserModel($email, $useremailsubject, $useremailheading, $useremailmessage, $tempview = "")
    {
        $from = $this->config->item('admin_email_id');
        $fromname = $this->config->item('admin_name');
        $messagearr = array();
        $messagearr["subject"] = $useremailsubject;
        $messagearr["heading"] = $useremailheading;
        $messagearr["message"] = $useremailmessage;
        $messagearr["email"] = $email;
        $msg = $this->load->view('email/useremail', $messagearr, true);
        $this->smtpemail->send($from, $fromname, $email, $useremailsubject, $msg);
        //echo $this->email->print_debugger();
    }

    public function checkotpmodel($email, $otp)
    {
        $sql = "SELECT * FROM users WHERE email = ? and otp = ?";
        $tempresult = $this->db->query($sql, [$email, $otp]);
        $user = $tempresult->result();
        $userCount = count($user);
        $user = isset($user[0]) ? $user[0] : array();

        if ($userCount > 0) {
            $status = $user->status;

            if ($status == "active") {

                $userData = array(
                    'userid' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'status' => $user->status,
                    'usertype' => 'user',
                    'loggedin' => true
                );
                $this->session->set_userdata($userData);
                return TRUE;
            }
        } else {
            return FALSE;
        }
    }

    public function getCompanies($id="")
    {
        $sql = "SELECT * from companies where 1 = 1 ";

        if ($id !== "") {
            $sql .= " and id=".$id;
        }
        
        $result = $this->db->query($sql);
        $res = $result->result();
        return $res;
    }

    public function getColumns($tablename)
    {
        $unwanted_fields = ["uu_id", "country_code"];
        $columns = $this->db->list_fields($tablename);
        $res = [];
        foreach ($columns as $col) {
            if (!in_array($col, $unwanted_fields, true)) {
                array_push($res, $col);
            }
        }
        return $res;
    }

    public function getEditColumns($tablename)
    {
        $unwanted_fields = ["uu_id", "mobilenumber", "name", "gender", "country_code", "timestamp"];
        $columns = $this->db->list_fields($tablename);
        $res = [];
        foreach ($columns as $col) {
            if (!in_array($col, $unwanted_fields, true)) {
                array_push($res, $col);
            }
        }
        return $res;
    }

    public function getUserDetails($userId = '')
    {
        $sql = "SELECT * FROM users WHERE status <> 'inactive'";
        if ($userId > 0) {
            $sql .= " AND userid = $userId";
        }
        $res = $this->db->query($sql);
        return $res->result();
    }

    public function updatePassword($userId, $password)
    {
        $sql = "UPDATE users SET password = md5('" . $password . "')
			WHERE userid = $userId";
        $this->db->query($sql);
    }


    public function getTotalUser($days)
    {
        $botname = $this->session->userdata('botname');
        $whr = "";
        if ($days && $days !== null && $days !== 0) {
            $whr = " where (timestamp > DATE_SUB(now(), INTERVAL " . $days . " DAY))";
        }

        $sql = "SELECT COUNT(DISTINCT(mobilenumber)) as totaluser FROM {$botname} " . $whr;
        $result = $this->db->query($sql);
        $res = $result->result();
        if (count($res) > 0) {
            return $res[0]->totaluser;
        } else {
            return 0;
        }
    }

    public function getLatestEnquiry()
    {
        $botname = $this->session->userdata('botname');
        $sql = "SELECT id, timestamp, mobilenumber, country_code, name
      FROM {$botname} where nodeid = 'node1' or nodeid = 'mainmenu' order by timestamp desc limit 10";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getLatestUsers()
    {
        $botname = $this->session->userdata('botname');
        $sql = "SELECT id, timestamp, mobilenumber, country_code, name
      FROM {$botname} group by mobilenumber order by timestamp desc limit 10";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getcurrentmonthusers()
    {
        $botname = $this->session->userdata('botname');
        $sql = "SELECT COUNT(DISTINCT mobilenumber) AS countdata,DAY(TIMESTAMP) AS entrydate FROM {$botname} WHERE YEAR(TIMESTAMP) = YEAR(CURRENT_DATE()) AND MONTH(TIMESTAMP) = MONTH(CURRENT_DATE()) GROUP BY DAY(TIMESTAMP)";
        $result = $this->db->query($sql);
        return $result->result();
    }


    public function getTotalEnquiry($days, $iscount = true)
    {
        $botname = $this->session->userdata('botname');
        $whr = " where nodeid = 'node1' or nodeid = 'mainmenu'";
        if ($days && $days !== null && $days !== 0) {
            $whr .= " and (timestamp > DATE_SUB(now(), INTERVAL " . $days . " DAY))";
        }

        $fields = "COUNT(*) as totalenquiry";
        if ($iscount === false) {
            $fields = " id, timestamp, mobilenumber, country_code, name ";
        }

        $sql = "SELECT " . $fields . " FROM {$botname}" . $whr;

        $result = $this->db->query($sql);
        $res = $result->result();
        if ($iscount === false) {
            return $res;
        }

        if (count($res) > 0) {
            return $res[0]->totalenquiry;
        } else {
            return 0;
        }
    }

    public function industryClasification($days)
    {
        $inputArray = [
            "Real Estate & Building Services",
            "ECommerce",
            "Manufacturing",
            "IT & Telecommunication",
            "Educational Institutions",
            "Banking & Financial Sectors",
            "Agriculture",
            "Retail Shops",
            "Restaurants & Hospitality",
            "Travel & Tourism"
        ];

        $res = [];

        for ($i = 0; $i < count($inputArray); $i++) {
            $res[$inputArray[$i]] = $this->getUserCountByMessage('industry', $inputArray[$i], $days);
        }
        return $res;
    }

    public function businessType($days)
    {
        $inputArray = [
            "B2C",
            "B2B",
            "Both"
        ];

        $res = [];

        for ($i = 0; $i < count($inputArray); $i++) {
            $res[$inputArray[$i]] = $this->getUserCountByMessage('business_type', $inputArray[$i], $days);
        }
        return $res;
    }

    public function ourServices($days)
    {
        $inputArray = [
            "Digital Marketing",
            "Lead Generation",
            "Product Launch",
            "Dealers or Distributors Appointment",
            "Distributor Management System (B2B eCom)",
            "ECommerce Sales",
            "WhatApp Chatbot (oohoo, Todook is delighted to serve you)",
            "Search Engine Optimization",
            "Website Development/Revamp",
            "ERP & CRM Services"
        ];

        $res = [];

        for ($i = 0; $i < count($inputArray); $i++) {
            $res[$inputArray[$i]] = $this->getUserCountByMessage('services', $inputArray[$i], $days);
        }
        return $res;
    }

    public function getUserCountByMessage($fieldname, $message, $days)
    {
        $sql = "select count(distinct mobilenumber) as userCount from whatsappbot.todook_process
	where $fieldname = " . $this->db->escape($message) . "
	and (timestamp > DATE_SUB(now(), INTERVAL " . $days . " DAY))";
        $result = $this->db->query($sql);
        $res = $result->result();
        if (count($res) > 0) {
            return $res[0]->userCount;
        } else {
            return 0;
        }
    }

    public function getThirtyDayUser()
    {
        $sql = "SELECT DATE_FORMAT(TIMESTAMP, '%Y-%m-%d') AS YYYYMMDD,
			COUNT(DISTINCT(mobilenumber)) AS newuser
			FROM whatsappbot.todook_process
			WHERE (TIMESTAMP > DATE_SUB(NOW(), INTERVAL 30 DAY))
			GROUP BY YYYYMMDD";
        $result = $this->db->query($sql);
        $res = $result->result();
        if (count($res) > 0) {
            return $res;
        } else {
            return 0;
        }
    }


    public function getIndiamapdetails()
    {
        $botname = $this->session->userdata('botname');
        $sql = "SELECT COUNT(*) as datacount,ROUND(((COUNT(*)/tc.datacount)*100),2) AS percent,p.statecode as code,p.statename as name FROM {$botname} tp INNER JOIN pincode p ON p.pincode = tp.pincode LEFT JOIN (SELECT COUNT(*) AS datacount FROM {$botname} tp INNER JOIN pincode p ON p.pincode = tp.pincode) tc ON 1=1 GROUP BY p.statecode order by datacount desc";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getWorldmapdetails()
    {
        $botname = $this->session->userdata('botname');
        $sql = "SELECT COUNT(*) as datacount,c.code,c.name,ROUND(((COUNT(*)/tc.datacount)*100),2) AS percent FROM {$botname} tp INNER JOIN country c ON c.dialcode = tp.country_code and (tp.nodeid = 'node1' or tp.nodeid = 'mainmenu') LEFT JOIN (SELECT COUNT(*) AS datacount FROM {$botname} tp INNER JOIN country c ON c.dialcode = tp.country_code and (tp.nodeid = 'node1' or tp.nodeid = 'mainmenu')) tc ON 1=1 GROUP BY c.dialcode ";
        $result = $this->db->query($sql);
        return $result->result();
    }
}
