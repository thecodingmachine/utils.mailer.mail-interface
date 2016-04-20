<?php

namespace Mouf\Utils\Mailer;

/**
 * This interface must be implemented by mails to be sent using a class extending the MailerInterface interface.
 */
interface MailInterface
{
    /**
     * Returns the mail text body.
     *
     * @return string
     */
    public function getBodyText():string;

    /**
     * Returns the mail html body.
     *
     * @return string
     */
    public function getBodyHtml():string;

    /**
     * Returns the mail title.
     *
     * @return string
     */
    public function getTitle():string;

    /**
     * Returns the "From" email address.
     *
     * @return MailAddressInterface
     */
    public function getFrom():MailAddressInterface;

    /**
     * Returns an array containing the recipients.
     *
     * @return array<MailAddressInterface>
     */
    public function getToRecipients():array;

    /**
     * Returns an array containing the recipients in Cc.
     *
     * @return array<MailAddressInterface>
     */
    public function getCcRecipients():array;

    /**
     * Returns an array containing the recipients in Bcc.
     *
     * @return array<MailAddressInterface>
     */
    public function getBccRecipients():array;

    /**
     * Returns an array of attachements for that mail.
     *
     * @return array<MailAttachmentInterface>
     */
    public function getAttachements():array;

    /**
     * Returns the encoding of the mail.
     *
     * @return string
     */
    public function getEncoding():string;
}
