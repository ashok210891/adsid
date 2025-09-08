<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
class Contact extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        //$this->session->set_userdata('isLogged', FALSE);
    }

    public function index()
    {
        $this->load->view('contact');
    }

    public function submitcontact()
    {
        $name = $this->input->post("name");
        $email = $this->input->post("email");
        $mobileNumber = $this->input->post("mobileNumber");

        list($ok, $msg) = $this->isAllowedBusinessEmail($email);
        if (!$ok) {
            $data = array();
            $data['isError'] = true;
            $data['msg'] = $msg;

            echo json_encode($data);
            exit;
        }

        $this->webmodel->insertContact($name,$email,$mobileNumber);

        $useremailsubject = "ADSID - Contact Form Details";
        $useremailheading = "ADSID - Below are the details we get from contact page";
        $useremailmessage = '<strong>Name</strong>: ' . $name . '<br>';
        $useremailmessage .= '<strong>Email</strong>: ' . $email . '<br>';
        $useremailmessage .= '<strong>Mobile Number</strong>: ' . $mobileNumber . '<br>';
        $useremailmessage .= '<br><br><br>
            -ADSID Team';

        $this->webmodel->sendemailtouserModel("contact@adsid.in", $useremailsubject, $useremailheading, $useremailmessage);

        $data = array();
        $data['isError'] = false;
        $data['msg'] = 'Thank you for contacting us. We will get back to you soon.';

        echo json_encode($data);
        exit;
    }

    function isAllowedBusinessEmail(string $email, bool $checkMx = false): array
    {
        // 1) Basic format check
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return [false, "Invalid email format."];
        }

        // 2) Split local + domain
        [$local, $domain] = explode('@', $email, 2);

        // 3) Normalize domain (IDN -> ASCII) if extension is available
        if (function_exists('idn_to_ascii')) {
            $ascii = idn_to_ascii($domain, IDNA_DEFAULT, INTL_IDNA_VARIANT_UTS46);
            if ($ascii !== false) {
                $domain = $ascii;
            }
        }

        // 4) Blacklist patterns (add/remove as needed)
        // Covers common free-mail domains + their TLD variants
        $blockedPatterns = [
            '/(^|\.)gmail\.com$/i',
            '/(^|\.)googlemail\.com$/i',

            '/(^|\.)yahoo\.[a-z.]+$/i',     // yahoo.com, yahoo.co.in, yahoo.de, ...
            '/(^|\.)ymail\.com$/i',
            '/(^|\.)rocketmail\.com$/i',

            '/(^|\.)hotmail\.[a-z.]+$/i',   // hotmail.com, hotmail.co.uk, ...
            '/(^|\.)outlook\.[a-z.]+$/i',   // outlook.com, outlook.in, ...
            '/(^|\.)live\.[a-z.]+$/i',      // live.com, live.co.uk, ...
            '/(^|\.)msn\.com$/i',
        ];

        foreach ($blockedPatterns as $pattern) {
            if (preg_match($pattern, $domain)) {
                return [false, "Please use a non-freemail (work/organization) email address."];
            }
        }

        // 5) Optional: MX record check for deliverability
        if ($checkMx && !checkdnsrr($domain, 'MX')) {
            return [false, "Email domain appears to have no MX records."];
        }

        return [true, "OK"];
    }
}
