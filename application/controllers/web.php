<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Web extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper('url');

        $this->load->library('grocery_CRUD');

        $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');

        if (($this->session->userdata('userid') == null) || ($this->session->userdata('userid') == "")) {
            redirect(base_url().'login');
        }
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
    }

    public function index()
    {
        redirect(base_url().'dashboard');
    }

    public function dashboard()
    {
        $data['companies'] = $this->webmodel->getCompanies();
        $data['title'] = 'Dashboard';
        $this->load->view('header', $data);
        $this->load->view('dashboard');
        $this->load->view('footer');
    }

    public function report($report_name)
    {
        try {
            $botname = $this->session->userdata('botname');
            $crud = new grocery_CRUD();
            //$crud->set_theme('bootstrap-v4');
            $report_display_name = ucwords(str_replace('_', ' ', $report_name));
            $crud->set_subject($report_display_name);
            $tablename = $botname . '_' . $report_name;
            $crud->set_table($tablename);
            $crud->unset_add();
            $crud->columns($this->webmodel->getColumns($tablename));
            $crud->fields($this->webmodel->getColumns($tablename));
            $crud->edit_fields($this->webmodel->getEditColumns($tablename));
            $output = (array)$crud->render();
            $output['report_display_name'] = $report_display_name;

            $this->load->view('header', $output);
            $this->load->view('crud', $output);
            $this->load->view('footer');
        } catch (Exception $e) {
          echo $e->message;
        }
    }

    public function reports()
    {
        $botname = $this->session->userdata('botname');
        $botpath = $this->config->item('bot_home') . 'bot/' . $botname . '.json';
        $bot = file_get_contents($botpath);
        $bot = json_decode($bot, TRUE);
        $reports = [];

        foreach ($bot as $node) {
          foreach ($node as $k=>$v) {
            if($k === 'tablename') {
              $isExist = array_search($v, $reports);
              if($isExist === FALSE) {
                array_push($reports, $v);
              }
            }
          }
        }

        $data['reports'] = $reports;

        $this->load->view('header');
        $this->load->view('reports', $data);
        $this->load->view('footer');
    }
    public function userWidget()
    {
        $data['totaluser'] = $this->webmodel->getTotalUser(0);
        $data['day'] = $this->webmodel->getTotalUser(1);
        $data['week'] = $this->webmodel->getTotalUser(7);
        $data['month'] = $this->webmodel->getTotalUser(30);
        echo json_encode($data);
    }

    public function enquiryWidget()
    {
        $data['totalenquiry'] = $this->webmodel->getTotalEnquiry(0);
        $data['enquiry_day'] = $this->webmodel->getTotalEnquiry(1);
        $data['enquiry_week'] = $this->webmodel->getTotalEnquiry(7);
        $data['enquiry_month'] = $this->webmodel->getTotalEnquiry(30);
        echo json_encode($data);
    }

    public function latestEnquiry()
    {
        echo json_encode($this->webmodel->getLatestEnquiry());
    }

    public function latestUsers()
    {
        echo json_encode($this->webmodel->getLatestUsers());
    }

    public function industryClasification($days)
    {
        echo json_encode($this->webmodel->industryClasification($days));
    }

    public function businessType($days = 1)
    {
        echo json_encode($this->webmodel->businessType($days));
    }

    public function ourServices($days = 1)
    {
        echo json_encode($this->webmodel->ourServices($days));
    }

    public function thirtyDayUserWidget()
    {
        $data['thirtyDayUserlist'] = $this->webmodel->getThirtyDayUser(0);
        echo json_encode($data);
    }

    public function countryData()
    {
        $data = $this->webmodel->getWorldmapdetails();
        echo json_encode($data);
    }

    public function stateData()
    {
        $data = $this->webmodel->getIndiamapdetails();
        echo json_encode($data);
    }

    public function currentmonthusers()
    {
        $data = $this->webmodel->getcurrentmonthusers();
        echo json_encode($data);
    }

    public function userslist()
    {
        $data['title'] = 'Users List';
        $this->load->view('header');
        $this->load->view('userslist', $data);
        $this->load->view('footer');
    }

    public function logout()
    {
        $userdata = array();
        $this->session->set_userdata($userdata);
        $this->session->sess_destroy();
        $this->load->helper('cookie');
        delete_cookie('ci_todook');
        redirect(base_url().'login');
    }

    public function changepassword()
    {
        $this->load->view('changepassword');
    }

    public function updatePassword()
    {
        $userId = $this->session->userdata('userid');
        $oldPassword = $this->input->post('oldPassword');
        $newPassword = $this->input->post('newPassword');

        $result = $this->webmodel->getUserDetails($userId);
        foreach ($result as $row) {
            $checkPassword = $row->password;
        }
        if ($checkPassword != md5($oldPassword)) {
            $data["isError"] = true;
            $data["msg"] = "Your Old Password is Wrong. Please Check.";
        } else {
            $this->webmodel->updatePassword($userId, $newPassword);

            $data["isError"] = false;
            $data["msg"] = "Password Updated Successfully...";
        }
        echo json_encode($data);
    }


    /* Heatmap dashboard */

    public function getTodookProcess()
    {
        $result["draw"] = 1;
        $result["recordsTotal"] = 1;
        $result["recordsFiltered"] = 1;
        $result["data"] = $this->webmodel->getTodookProcessData();
        echo json_encode($result);
    }

    public function account()
    {
        $data['title'] = 'Manage Subscription';
        $this->load->view('header');
        $this->load->view('account', $data);
        $this->load->view('footer');
    }
}
