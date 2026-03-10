<?php

/**
 * Class developed to send mails using Wordpress
 *
 * @author Euclécio Josias Rodrigues <eucjosias@gmail.com>
 *
 * @version 1.0
 *
 */
$autoload_candidates = array(
    ABSPATH . '../vendor/autoload.php',
    ABSPATH . 'vendor/autoload.php',
);

foreach ($autoload_candidates as $autoload_file) {
    if (file_exists($autoload_file)) {
        require_once $autoload_file;
        break;
    }
}

if (!class_exists('PHPMailer\\PHPMailer\\PHPMailer')) {
    require_once ABSPATH . WPINC . '/PHPMailer/PHPMailer.php';
    require_once ABSPATH . WPINC . '/PHPMailer/SMTP.php';
    require_once ABSPATH . WPINC . '/PHPMailer/Exception.php';
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Mail
{
    /**
     * @param string
     *
     * Path for template of email
     *
     */
    private $template;

    /**
     * @param string
     *
     */
    private $from;

    /**
     * @param string
     *
     */
    private $fromName;

    /**
     * @param string
     *
     */
    private $subject;

    /**
     * @param array
     *
     * Array of recipients
     *
     */
    private $recipients = array();

    /**
     * @param array
     *
     * Array of attachments
     *
     */
    private $attachments = array();

    /**
     * @param array
     *
     * Array of attributes
     *
     */
    private $attributes = array();

    /**
     * Gets the value of template.
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Sets the value of template.
     *
     * @param mixed $template the template
     *
     * @return self
     */
    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Gets the value of from.
     *
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Sets the value of fromName.
     *
     * @param mixed $fromName the fromName
     *
     * @return self
     */
    public function setFromName($fromName)
    {
        $this->fromName = $fromName;

        return $this;
    }

    /**
     * Gets the value of fromName.
     *
     * @return string
     */
    public function getFromName()
    {
        return $this->fromName;
    }

    /**
     * Sets the value of from.
     *
     * @param mixed $from the from
     *
     * @return self
     */
    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Gets the value of subject.
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Sets the value of subject.
     *
     * @param mixed $subject the subject
     *
     * @return self
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Gets the value of recipients.
     *
     * @return array
     */
    public function getRecipients()
    {
        return $this->recipients;
    }

    /**
     * Sets the value of recipients.
     *
     * @param mixed $recipients the recipients
     *
     * @return self
     */
    public function setRecipients(array $recipients)
    {
        $this->recipients = $recipients;

        return $this;
    }

    /**
     * Add value in recipients array.
     *
     * @param $key => $value in recipients array
     *
     * @return self
     */
    public function addTo($to)
    {
        $this->recipients[] = $to;

        return $this;
    }

    /**
     * Gets the value of attachments.
     *
     * @return array
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * Sets the value of attachments.
     *
     * @param mixed $attachments the attachments
     *
     * @return self
     */
    public function setAttachments(array $attachments)
    {
        $this->attachments = $attachments;

        return $this;
    }

    /**
     * Add value in attachments array.
     *
     * @param $key => $value in attachments array
     *
     * @return self
     */
    public function addAttachment($attachment)
    {
        $this->attachments[] = $attachment;

        return $this;
    }

    /**
     * Gets the value of attributes.
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Sets the value of attributes.
     *
     * @param mixed $attributes the attributes
     *
     * @return self
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * Add value in attributes array.
     *
     * @param $key => $value in attributes array
     *
     * @return self
     */
    public function addAttribute($key, $value)
    {
        $this->attributes[$key] = $value;

        return $this;
    }

    /**
     * This function reads the recipients array and send emails
     *
     * @param $redirecTo string
     *
     */
    public function send()
    {
        $mail = new PHPMailer();

        /* SMTP Config */
        $mail->IsSMTP();
        $mail->Host       = MAILSERVER_URL;
        $mail->SMTPAuth   = true;
        $mail->Username   = MAILSERVER_LOGIN;
        $mail->Password   = MAILSERVER_PASS;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->CharSet    = 'UTF-8';

        /* From vars */
        $mail->From     = $this->from;
        $mail->FromName = $this->fromName;
        $mail->AddReplyTo($this->attributes['email'], $this->fromName);

        /* Add recipients */
        foreach ($this->recipients as $to)
            $mail->AddAddress($to);

        $mail->WordWrap = 50;

        /* Add attachments */
        if (count($this->attachments)) {
            foreach ($this->attachments as $filePath)
                $mail->AddAttachment($filePath);
        }

        /* HTML content */
        $mail->IsHTML(true);

        /* Email Body */
        $message       = $this->replaceTemplateKeys();
        $mail->Subject = $this->subject;
        $mail->Body    = $message;
        $mail->AltBody = strip_tags($message);

        /* Send */
        if (!$mail->Send()) {
            echo "Message could not be sent. <p>";
            echo "Mailer Error: " . $mail->ErrorInfo;
            exit;
        }
    }

    /**
     * This function replaces keys in template
     *
     * @param array $attributes
     *
     * @return string
     */
    public function replaceTemplateKeys()
    {
        if (ini_get('allow_url_fopen')) {
            $content = file_get_contents($this->template);
        } else {
            $content = wp_remote_retrieve_body(wp_remote_get($this->template));
        }
        foreach ($this->attributes as $key => $value)
            $content = str_replace('{{' . $key . '}}', $value, $content);
        $logo = get_site_icon_url();
        $base64 = '';
        if (!empty($logo)) {
            $base64 = base64_encode(file_get_contents($logo));
        } else {
            $base64 = "iVBORw0KGgoAAAANSUhEUgAAAlgAAAJYCAIAAAAxBA+LAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyFpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMTQ1IDc5LjE2MzQ5OSwgMjAxOC8wOC8xMy0xNjo0MDoyMiAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6QzY5RjMyNzdFQTA2MTFFOTgzNkFEMjYwNzQ5MjZDOUYiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6QzY5RjMyNzZFQTA2MTFFOTgzNkFEMjYwNzQ5MjZDOUYiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIChXaW5kb3dzKSI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjRERkY5QTQ5MTdENTExRThCMUI4QzFERDQzNkUyNEE3IiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjRERkY5QTRBMTdENTExRThCMUI4QzFERDQzNkUyNEE3Ii8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+7hhVMwAAKzRJREFUeNrs3Ul3XOd1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";
            $content = str_replace('##logo##', 'data:image/png;base64,' . $base64, $content);
        }
        return $content;
    }
}
