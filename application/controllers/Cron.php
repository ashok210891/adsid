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

        $sent  = 0;
        $errors = 0;

        // 1) First‑time users (never logged in)
        $neverLoggedUsers = $this->webmodel->getNeverLoggedInUsersForReminder($cooldownDays);
        foreach ($neverLoggedUsers as $user) {
            $name    = !empty($user->name) ? $user->name : 'User';
            $subject = 'ADSID - First Login Reminder';
            $heading = 'ADSID - First Login Reminder';

            $message = $this->load->view(
                'email/never_login_reminder',
                array(
                    'name' => $name,
                ),
                true
            );

            try {
                $this->webmodel->sendemailtouserModel($user->email, $subject, $heading, $message);
                $this->webmodel->updateInactiveReminderSentAt($user->id);
                $sent++;
                echo "Sent first-login reminder to: " . $user->email . "\n";
            } catch (Exception $e) {
                $errors++;
                echo "Error sending first-login reminder to " . $user->email . ": " . $e->getMessage() . "\n";
            }
        }

        // 2) Users who have logged in before but are inactive for N+ days
        $inactiveUsers = $this->webmodel->getInactiveUsersForReminder($inactiveDays, $cooldownDays);
        foreach ($inactiveUsers as $user) {
            $name    = !empty($user->name) ? $user->name : 'User';
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

            try {
                $this->webmodel->sendemailtouserModel($user->email, $subject, $heading, $message);
                $this->webmodel->updateInactiveReminderSentAt($user->id);
                $sent++;
                echo "Sent inactive reminder to: " . $user->email . "\n";
            } catch (Exception $e) {
                $errors++;
                echo "Error sending inactive reminder to " . $user->email . ": " . $e->getMessage() . "\n";
            }
        }

        echo "Done. Sent: $sent, Errors: $errors\n";
    }
}
