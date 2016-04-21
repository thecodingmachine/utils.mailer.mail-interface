<?php

namespace Mouf\Utils\Mailer;

use Mouf\Html\HtmlElement\HtmlElementInterface;

/**
 * This class represents a mail to be sent using a Mailer class extending the MailerInterface.
 * + it has special features to add a text mail for any HTML mail that has not been provided the text mail.
 *
 * Note: default encoding for the mail is UTF-8 if not specified.
 *
 * @Component
 */
class Mail implements MailInterface
{
    /**
     * @var string
     */
    protected $bodyText;

    /**
     * @var HtmlElementInterface
     */
    protected $bodyHtml;

    /**
     * @var HtmlElementInterface
     */
    protected $title;

    /**
     * @var MailAddressInterface
     */
    protected $from;

    /**
     * @var MailAddressInterface[]
     */
    protected $toRecipients = array();

    /**
     * @var MailAddressInterface[]
     */
    protected $ccRecipients = array();

    /**
     * @var MailAddressInterface[]
     */
    protected $bccRecipients = array();

    /**
     * @var MailAttachmentInterface[]
     */
    protected $attachements = array();

    /**
     * @var string
     */
    protected $encoding = 'utf-8';

    /**
     * @var bool
     */
    protected $autocreateMissingText = true;

    /**
     * @var string
     */
    protected $css;

    public function __construct(string $title, string $bodyText = null)
    {
        $this->title = $title;
        $this->bodyText = $bodyText;
    }

    /**
     * Returns the mail text body.
     *
     * @return string
     */
    public function getBodyText() :string
    {
        return $this->bodyText;
    }

    /**
     * The mail text body.
     *
     * @Property
     *
     * @param string $bodyText
     */
    public function setBodyText(string $bodyText) :string
    {
        $this->bodyText = $bodyText;
    }

    /**
     * Returns the mail html body.
     *
     * @return string
     */
    public function getBodyHtml():string
    {
        return $this->bodyHtml->getHtml();
    }

    /**
     * The mail html body.
     *
     * @param HtmlElementInterface $bodyHtml
     */
    public function setBodyHtml(HtmlElementInterface $bodyHtml)
    {
        $this->bodyHtml = $bodyHtml;
    }

    /**
     * Returns the mail title.
     *
     * @return string
     */
    public function getTitle():string
    {
        return $this->title->getHtml();
    }

    /**
     * The mail title.
     *
     * @param string $title
     */
    public function setTitle(HtmlElementInterface $title)
    {
        $this->title = $title;
    }

    /**
     * Returns the "From" email address.
     *
     * @return MailAddressInterface The first element is the email address, the second the name to display.
     */
    public function getFrom():MailAddressInterface
    {
        return $this->from;
    }

    /**
     * The mail from address.
     *
     * @param MailAddressInterface $from
     */
    public function setFrom(MailAddressInterface $from)
    {
        $this->from = $from;
    }

    /**
     * Returns an array containing the recipients.
     *
     * @return MailAddressInterface[]
     */
    public function getToRecipients(): array
    {
        return $this->toRecipients;
    }

    /**
     * An array containing the recipients.
     *
     * @param MailAddressInterface[] $toRecipients
     */
    public function setToRecipients(array $toRecipients)
    {
        $this->toRecipients = $toRecipients;
    }

    /**
     * Adss a recipient.
     *
     * @param MailAddressInterface $toRecipient
     */
    public function addToRecipient(MailAddressInterface $toRecipient)
    {
        $this->toRecipients[] = $toRecipient;
    }

    /**
     * Returns an array containing the recipients in Cc.
     *
     * @return MailAddressInterface[]
     */
    public function getCcRecipients(): array
    {
        return $this->ccRecipients;
    }

    /**
     * An array containing the recipients.
     *
     *
     * @param MailAddressInterface[]$ccRecipients
     */
    public function setCcRecipients(array $ccRecipients)
    {
        $this->ccRecipients = $ccRecipients;
    }

    /**
     * Adds a recipient.
     *
     * @param MailAddressInterface $ccRecipient
     */
    public function addCcRecipient(MailAddressInterface $ccRecipient)
    {
        $this->ccRecipients[] = $ccRecipient;
    }

    /**
     * Returns an array containing the recipients in Bcc.
     *
     * @return MailAddressInterface[]
     */
    public function getBccRecipients():array
    {
        return $this->bccRecipients;
    }

    /**
     * An array containing the recipients.
     *
     * @param MailAddressInterface[] $bccRecipients
     */
    public function setBccRecipients(array $bccRecipients)
    {
        $this->bccRecipients = $bccRecipients;
    }

    /**
     * Adds a recipient.
     *
     * @param MailAddressInterface $bccRecipient
     */
    public function addBccRecipient(MailAddressInterface $bccRecipient)
    {
        $this->bccRecipients[] = $bccRecipient;
    }

    /**
     * Returns an array of attachements for that mail.
     *
     * @return MailAttachmentInterface[]
     */
    public function getAttachements():array
    {
        return $this->attachements;
    }

    /**
     * An array containing the attachments.
     *
     * @param array<MailAttachmentInterface> $attachements
     */
    public function setAttachements(array $attachements)
    {
        $this->attachements = $attachements;
    }

    /**
     * Adds an attachment.
     *
     * @param MailAttachmentInterface $attachement
     */
    public function addAttachement(MailAttachmentInterface $attachement)
    {
        $this->attachements[] = $attachement;
    }

    /**
     * Returns the encoding of the mail.
     *
     * @return string
     */
    public function getEncoding():string
    {
        return $this->encoding;
    }

    /**
     * The mail encoding. Defaults to utf-8.
     *
     * @param string $encoding
     */
    public function setEncoding($encoding)
    {
        $this->encoding = $encoding;
    }

}
