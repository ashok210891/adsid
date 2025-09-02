<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Smtpemail
{
	function send($from, $fromname = "", $to, $subject, $message,$attachment="", $cc = "", $bcc = "", $send_emails = TRUE)
    {
    	$mail_msg = "";
        $CI =& get_instance();
        $CI->load->library('email');
        $smtp_config = array();  

        $smtp_config['protocol']  = $CI->config->item('protocol');
        $smtp_config['smtp_host'] = $CI->config->item('smtp_host');
        $smtp_config['smtp_user'] = $CI->config->item('smtp_user');
        $smtp_config['smtp_pass'] = $CI->config->item('smtp_pass');
        $smtp_config['smtp_port'] = $CI->config->item('smtp_port');
        $smtp_config['mailpath'] = '/usr/sbin/sendmail';
        //$smtp_config['smtp_crypto']    = $CI->config->item('smtp_crypto');
        $smtp_config['crlf']         = $CI->config->item('crlf');
        $smtp_config['newline']      = $CI->config->item('newline');
        $smtp_config['charset']     = 'iso-8859-1';
        $smtp_config['mailtype']     = $CI->config->item('mailtype');

        $from = $CI->config->item('admin_email_id');
        $fromname = $CI->config->item('admin_name');
        

        $CI->email->initialize($smtp_config);
        $CI->email->from($from,$fromname);
        $CI->email->to($to);
        $CI->email->cc($cc);
        $CI->email->bcc($bcc);
        $CI->email->subject($subject);
        if($attachment != "")
        $CI->email->attach($attachment);
        $mail_msg .= $message;
        
        $CI->email->message($mail_msg);
        
        if($CI->config->item('send_emails')){
            if($CI->email->send()) {
                log_message('debug', "Email to $to sent with subject $subject <br/> $mail_msg ");
                log_message('debug', "Content is $message");
                return true;
            } else {
                $error = $CI->email->print_debugger();
                print_r($error);
                log_message('error', "send email false\n".$error);
                return false;
            }
        }
        else{
            return true;
        }
    }
}
?>