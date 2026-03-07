<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Cron controller - run only from command line (e.g. cron job).
 * Methods send reminder emails to inactive users.
 */
class Cron extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->input->is_cli_request()) {
            show_404();
            return;
        }
        $this->load->model('webmodel');
    }

    /**
     * Send "we miss you" email to users inactive for 10+ days.
     * Run daily via: php index.php cron send_inactive_reminders
     */
    public function send_inactive_reminders()
    {
        $inactiveDays = 10;
        $cooldownDays = 30;

        $users = $this->webmodel->getInactiveUsersForReminder($inactiveDays, $cooldownDays);
        $sent = 0;
        $errors = 0;

        foreach ($users as $user) {
            $name = !empty($user->name) ? $user->name : 'User';
            $subject = 'ADSID - We miss you!';
            $heading = 'ADSID - You haven’t logged in for a while';
            $message = 'Hi ' . htmlspecialchars($name) . ',<br><br>';
            $message .= 'You have not logged into your ADSID account for more than ' . $inactiveDays . ' days.<br><br>';
            $message .= 'We’d love to see you back. Log in anytime to access your account.<br><br>';
            $message .= '<a href="' . base_url() . '">Log in to ADSID</a><br><br>';
            $message .= '- ADSID Team';

            try {
                $this->webmodel->sendemailtouserModel($user->email, $subject, $heading, $message);
                $this->webmodel->updateInactiveReminderSentAt($user->id);
                $sent++;
                echo "Sent inactive reminder to: " . $user->email . "\n";
            } catch (Exception $e) {
                $errors++;
                echo "Error sending to " . $user->email . ": " . $e->getMessage() . "\n";
            }
        }

        echo "Done. Sent: $sent, Errors: $errors\n";
    }
}
