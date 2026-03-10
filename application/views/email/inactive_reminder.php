<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/** @var string $name */
/** @var int    $inactiveDays */
?>

<div style="font-size:14px; color:#333333; line-height:1.7;">
    <p style="margin:0 0 14px 0;">Dear <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>,</p>

    <p style="margin:0 0 12px 0;">Hope you are doing well.</p>

    <p style="margin:0 0 12px 0;">This is from A&amp;D Market Reports.</p>

    <p style="margin:0 0 12px 0;">
        We would like to acknowledge that you have successfully logged in to the ADSID (Aerospace &amp; Defence
        Supplier Identification Dashboard). However, our records indicate that it has been
        <?php echo (int) $inactiveDays; ?> days since you last accessed the portal.
    </p>

    <p style="margin:0 0 12px 0;">
        The ADSID platform offers several valuable opportunities and resources that we believe will be beneficial for
        you. We kindly encourage you to log in at your earliest convenience and explore the available features and
        opportunities.
    </p>

    <p style="margin:0 0 12px 0;">
        If you need any assistance in navigating the portal or accessing your account, our support team will be happy
        to assist you.
    </p>

    <p style="margin:0 0 18px 0;">
        Thank you for your attention, and we look forward to your active engagement on the platform.
    </p>

    <div style="margin-top:18px; padding-top:14px; border-top:1px solid #dddddd;">
        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;">
            <tr>
                <td style="vertical-align:top; padding:0; margin:0;">
                    <p style="margin:0 0 4px 0;"><strong>Junita S</strong></p>
                    <p style="margin:0 0 10px 0;">Research Analyst</p>
                </td>
                <td style="vertical-align:top; text-align:right; padding:0; margin:0;">
                    <!-- Optional logo area; keep empty or place small logos here if needed -->
                </td>
            </tr>
        </table>

        <p style="margin:10px 0 4px 0;"><strong>Aviation and Defense Market Reports (A&amp;D Market Reports)</strong></p>
        <p style="margin:0 0 4px 0;">Global Aviation and Defense Market Intelligence Solution Provider</p>
        <p style="margin:0 0 4px 0;">390+ Global Reports | 5000+ Country Reports | Defense Decision Dashboard</p>
        <p style="margin:0 0 4px 0;">Market Intelligence | Consulting | Strategy | Procurement</p>
        <p style="margin:0 0 4px 0;">
            t: US: +1-717-742-4488 | EU: +44-20-81336688 | APAC: +91-22-41226006<br>
            m: +91 9004276376<br>
            e: <a href="mailto:junita.c@andmarketreports.com" style="color:#16A751; text-decoration:none;">junita.c@andmarketreports.com</a>
        </p>

        <p style="margin:6px 0 4px 0;">
            <a href="https://www.aviationanddefensemarketreports.com" target="_blank" style="color:#16A751; text-decoration:none; font-weight:bold;">
                www.aviationanddefensemarketreports.com
            </a>
        </p>
        <p style="margin:0 0 10px 0;">LinkedIn | Twitter | Instagram</p>

        <p style="margin:10px 0 0 0; font-size:12px; color:#666666;">
            The content of this email is confidential and intended for the recipient specified in message only. It is
            strictly forbidden to share any part of this message with any third party, without a written consent of the
            sender. If you received this message by mistake, please reply to this message and follow with its deletion,
            so that we can ensure such a mistake does not occur in the future.
        </p>
    </div>
</div>
