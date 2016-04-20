<?php

namespace Mouf\Utils\Mailer;

/**
 * This interface must be implemented by all kinds of classes that can send mails.
 */
interface MailServiceInterface
{
    /**
     * Sends the mail passed in parameter.
     *
     * @param MailInterface $mail The mail to send.
     */
    public function send(MailInterface $mail);
}
