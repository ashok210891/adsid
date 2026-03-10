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
        $cooldownDays = 10;

        $users = $this->webmodel->getInactiveUsersForReminder($inactiveDays, $cooldownDays);
        $sent = 0;
        $errors = 0;

        foreach ($users as $user) {
            $name = !empty($user->name) ? $user->name : 'User';

            if ($user->otp === 0 || $user->otp === null) {
                // User has never logged in
                $subject = 'ADSID - First Login Reminder';
                $heading = 'ADSID - First Login Reminder';

                $message = $this->load->view(
                    'email/never_login_reminder',
                    array(
                        'name' => $name,
                    ),
                    true
                );
            } else {
                // User logged in before but inactive for N days
                $subject = 'ADSID - Inactive Account Reminder';
                $heading = 'ADSID - Inactive Account Reminder';

                $message = $this->load->view(
                    'email/inactive_reminder',
                    array(
                        'name' => $name,
                        'inactiveDays' => $inactiveDays,
                    ),
                    true
                );
            }

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
