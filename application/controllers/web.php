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

        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');

        if (($this->session->userdata('userid') == null) || ($this->session->userdata('userid') == "")) {
            redirect(base_url() . 'login');
        }
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
    }

    public function index()
    {
        if ($this->session->userdata('user_type') == 'buyer') {
            redirect(base_url() . 'dashboard');
        } else {
            redirect(base_url() . 'editCompany');
        }
    }

    public function dashboard()
    {
        $data['companies'] = $this->webmodel->getCompanies();
        $data['title'] = 'Dashboard';
        $this->load->view('header', $data);
        $this->load->view('dashboard');
        $this->load->view('footer');
    }

    public function company($id)
    {
        try {
            $companyData = $this->webmodel->getCompanies($id);
            $data['company'] = $companyData[0];
            $data['title'] = $data['company']->company_name;
            $this->load->view('header', $data);
            $this->load->view('company_detail');
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
            foreach ($node as $k => $v) {
                if ($k === 'tablename') {
                    $isExist = array_search($v, $reports);
                    if ($isExist === FALSE) {
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
        redirect(base_url() . 'login');
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

    public function emailTemplates()
    {
        try {
            $crud = new grocery_CRUD();

            $crud->set_table('email_templates');
            $crud->set_subject('Email Template');

            $crud->columns('template_name', 'email_subject', 'file', 'status', 'created_on', 'created_by');
            $crud->fields('template_name', 'email_subject', 'template_content', 'file', 'status');
            $crud->required_fields('template_name', 'email_subject', 'template_content', 'status');

            $crud->display_as('template_name', 'Template Name')
                ->display_as('email_subject', 'Email Subject')
                ->display_as('template_content', 'Template Content')
                ->display_as('file', 'Attachment')
                ->display_as('status', 'Status')
                ->display_as('created_on', 'Created On')
                ->display_as('created_by', 'Created By');

            $crud->set_field_upload('file', 'assets/uploads/files');
            $crud->set_field_type('status', 'dropdown', array('active' => 'active', 'inactive' => 'inactive'));

            // Enable rich text editor for template content if available
            if (method_exists($crud, 'set_texteditor')) {
                $crud->set_texteditor('template_content');
            }

            $crud->callback_before_insert(function ($post_array) {
                $post_array['created_by'] = (int)$this->session->userdata('userid') ?: 0;
                return $post_array;
            });

            // Protect system-managed fields from manual editing
            $crud->change_field_type('created_on', 'invisible');
            $crud->change_field_type('created_by', 'invisible');

            $output = $crud->render();

            $data = (array)$output;
            $data['report_display_name'] = 'Email Templates';

            $this->load->view('header', $data);
            $this->load->view('crud', $data);
            $this->load->view('footer');
        } catch (Exception $e) {
            show_error($e->getMessage() . ' — ' . $e->getTraceAsString());
        }
    }

    public function emailTemplate()
    {
        $userId = (int)$this->session->userdata('userid');

        // Fetch or create the user's single template record
        $query = $this->db->get_where('email_templates', array('created_by' => $userId), 1);
        $template = $query->row_array();

        if (!$template) {
            $insertData = array(
                'template_name' => 'Default Template',
                'template_content' => '',
                'email_subject' => '',
                'file' => '',
                'status' => 'active',
                'created_by' => $userId,
            );
            $this->db->insert('email_templates', $insertData);
            $templateId = $this->db->insert_id();
            $template = $this->db->get_where('email_templates', array('id' => $templateId))->row_array();
        }

        $data['title'] = 'My Email Template';
        $data['template'] = $template;

        $this->load->view('header');
        $this->load->view('email_template', $data);
        $this->load->view('footer');
    }

    public function saveEmailTemplate()
    {
        $userId = (int)$this->session->userdata('userid');

        // Find the user's record id
        $template = $this->db->get_where('email_templates', array('created_by' => $userId), 1)->row_array();
        if (!$template) {
            show_error('Template not found for user.');
            return;
        }

        $update = array(
            'template_name' => $this->input->post('template_name'),
            'email_subject' => $this->input->post('email_subject'),
            'template_content' => $this->input->post('template_content'),
        );

        // Handle optional file upload
        if (!empty($_FILES['file']['name'])) {
            $config['upload_path'] = FCPATH . 'assets/uploads/files/';
            $config['allowed_types'] = '*';
            $config['max_size'] = 0; // no limit
            $config['overwrite'] = false;
            $config['encrypt_name'] = true;

            if (!is_dir($config['upload_path'])) {
                @mkdir($config['upload_path'], 0755, true);
            }

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file')) {
                $uploadData = $this->upload->data();
                $update['file'] = $uploadData['file_name'];
            } else {
                $data['error'] = $this->upload->display_errors('', '');
                $data['template'] = $template;
                $data['title'] = 'My Email Template';
                $this->load->view('header');
                $this->load->view('email_template', $data);
                $this->load->view('footer');
                return;
            }
        }

        $this->db->where('id', (int)$template['id']);
        $result = $this->db->update('email_templates', $update);

        if ($result) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => true,
                    'message' => 'Email template updated successfully.'
                ]));
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => false,
                    'message' => 'Error updating email template.'
                ]));
        }
    }

    public function editCompany()
    {
        $companyId = $this->session->userdata('company_id');
        $query = $this->db->get_where('companies', array('id' => $companyId), 1);
        $company = $query->row_array();

        if (!$company) {
            show_error('Company not found.');
            return;
        }

        $data['title'] = 'Edit Company - ' . $company['company_name'];
        $data['company'] = $company;

        $this->load->view('header');
        $this->load->view('edit_company', $data);
        $this->load->view('footer');
    }

    public function saveEditCompany()
    {
        $companyId = $this->input->post('company_id');
        if (!$companyId) {
            show_error('Company ID is required.');
            return;
        }

        // Verify company exists
        $company = $this->db->get_where('companies', array('id' => $companyId), 1)->row_array();
        if (!$company) {
            show_error('Company not found.');
            return;
        }

        // Process tags fields (convert arrays to comma-separated strings)
        $tagsFields = ['capability_list', 'components', 'products', 'recent_project', 'key_projects', 'clients', 'export_to_countries', 'production_capability'];
        $processedTags = array();

        foreach ($tagsFields as $field) {
            $tagsData = $this->input->post($field);
            if (is_array($tagsData)) {
                // Filter out empty values and join with commas
                $filteredData = array_filter($tagsData, function ($value) {
                    return !empty($value) && trim($value) !== '';
                });
                $processedTags[$field] = implode(',', $filteredData);
            } else {
                // Handle string data - if it's already comma-separated, use it as is
                $processedTags[$field] = !empty($tagsData) ? trim($tagsData) : '';
            }
        }

        $update = array(
            'company_name' => $this->input->post('company_name'),
            'company_email' => $this->input->post('company_email'),
            'company_description' => $this->input->post('company_description'),
            'company_address' => $this->input->post('company_address'),
            'office_number' => $this->input->post('office_number'),
            'city' => $this->input->post('city'),
            'contact_person' => $this->input->post('contact_person'),
            'designation' => $this->input->post('designation'),
            'mobile_number' => $this->input->post('mobile_number'),
            'email_id' => $this->input->post('email_id'),
            'whatsapp_number' => $this->input->post('whatsapp_number'),
            'segment' => $this->input->post('segment'),
            'capability_list' => $processedTags['capability_list'],
            'components' => $processedTags['components'],
            'products' => $processedTags['products'],
            'recent_project' => $processedTags['recent_project'],
            'key_projects' => $processedTags['key_projects'],
            'clients' => $processedTags['clients'],
            'export_to_countries' => $processedTags['export_to_countries'],
            'latest_press_release' => $this->input->post('latest_press_release'),
            'production_capability' => $processedTags['production_capability'],
            'video_url' => $this->extractYouTubeId($this->input->post('video_url')),
            'register_under_msme' => $this->input->post('register_under_msme'),
            'working_with_indian_dpsu' => $this->input->post('working_with_indian_dpsu'),
            'aerospace_defense_industry' => $this->input->post('aerospace_defense_industry'),
            'near_term_capability_expansion' => $this->input->post('near_term_capability_expansion'),
        );

        // Handle optional company logo upload
        if (!empty($_FILES['company_logo']['name'])) {
            $config['upload_path'] = FCPATH . 'assets/uploads/companies/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 2048; // 2MB
            $config['overwrite'] = false;
            $config['encrypt_name'] = true;

            if (!is_dir($config['upload_path'])) {
                @mkdir($config['upload_path'], 0755, true);
            }

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('company_logo')) {
                $uploadData = $this->upload->data();
                $update['company_logo'] = $uploadData['file_name'];
            } else {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode([
                        'success' => false,
                        'message' => 'Error updating company logo.'
                    ]));
            }
        }

        $this->db->where('id', (int)$companyId);
        $result = $this->db->update('companies', $update);

        if ($result) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => true,
                    'message' => 'Company updated successfully.'
                ]));
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => false,
                    'message' => 'Error updating company.'
                ]));
        }
    }

    private function extractYouTubeId($url)
    {
        if (empty($url)) return '';

        // Extract YouTube ID from various YouTube URL formats
        $patterns = [
            '/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([a-zA-Z0-9_-]{11})/',
            '/youtube\.com\/watch\?.*v=([a-zA-Z0-9_-]{11})/'
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                return $matches[1];
            }
        }

        // If no pattern matches, return the original string (might be just an ID)
        return $url;
    }

    public function sendRfpToCompanies()
    {
        // Get JSON input
        $input = json_decode(file_get_contents('php://input'), true);
        $companyIds = $input['company_ids'] ?? [];

        if (empty($companyIds)) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => false,
                    'message' => 'No companies selected.'
                ]));
            return;
        }

        // Get user's email template
        $userId = (int)$this->session->userdata('userid');
        $template = $this->db->get_where('email_templates', array('created_by' => $userId), 1)->row_array();

        if (!$template) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => false,
                    'message' => 'No email template found. Please create an email template first.'
                ]));
            return;
        }

        // Get selected companies
        $this->db->where_in('id', $companyIds);
        $companies = $this->db->get('companies')->result();

        if (empty($companies)) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => false,
                    'message' => 'No companies found with selected IDs.'
                ]));
            return;
        }

        $sentCount = 0;
        $errors = [];

        // Load email library
        $this->load->library('Smtpemail');

        foreach ($companies as $company) {
            if (empty($company->company_email)) {
                $errors[] = "No email address for company: " . $company->company_name;
                continue;
            }

            // Prepare email content
            $subject = $template['email_subject'];
            $message = 'Hello ' . $company->contact_person . ',<br><br>';
            $message .= $template['template_content'] . '<br><br>';
            $message .= 'Regards,<br>';
            $message .= $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . '<br>';
            $message .= $this->session->userdata('email') . '<br>';

            // Prepare attachment if exists
            $attachment = '';
            if (!empty($template['file'])) {
                $attachment = FCPATH . 'assets/uploads/files/' . $template['file'];
                if (!file_exists($attachment)) {
                    $attachment = '';
                }
            }

            // Send email
            $emailSent = $this->smtpemail->send(
                $this->config->item('admin_email_id'),
                $this->config->item('admin_name'),
                $company->company_email,
                $subject,
                $message,
                $attachment
            );

            if ($emailSent) {
                $sentCount++;
            } else {
                $errors[] = "Failed to send email to: " . $company->company_name . " (" . $company->company_email . ")";
            }
        }

        // Prepare response
        $response = [
            'success' => $sentCount > 0,
            'sent_count' => $sentCount,
            'total_selected' => count($companies)
        ];

        if ($sentCount > 0) {
            $response['message'] = "RFP sent successfully to {$sentCount} companies.";
        } else {
            $response['message'] = "Failed to send RFP to any companies.";
        }

        if (!empty($errors)) {
            $response['errors'] = $errors;
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function submitHelpQuestion()
    {
        $helpQuestions = $this->input->post('helpQuestions');
        $otherQuestion = $this->input->post('otherQuestion');

        $useremailsubject = "ADSID - Help Question";
        $useremailheading = "ADSID - Help Question";
        $useremailmessage = 'Help Questions: ' . $helpQuestions;
        if ($otherQuestion) {
            $useremailmessage .= '<br>Other Question: ' . $otherQuestion;
        }
        
        $useremailmessage .= '<br>Email: ' . $this->session->userdata('email');
        $useremailmessage .= '<br>Name: ' . $this->session->userdata('name');
        $useremailmessage .= '<br>User Status: ' . $this->session->userdata('status');
        $useremailmessage .= '<br>User Type: ' . $this->session->userdata('user_type');
        $useremailmessage .= '<br>Company ID: ' . $this->session->userdata('company_id');


        $this->webmodel->sendemailtouserModel("contact@adsid.in", $useremailsubject, $useremailheading, $useremailmessage);

        $data["isError"] = false;
        $data["msg"] = "Help question submitted successfully. We will contact you soon!";
        echo json_encode($data);
        return;
    }
}
