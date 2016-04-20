<?php

namespace Mouf\Utils\Mailer;

use Pelago\Emogrifier;

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
     * @var string
     */
    protected $bodyHtml;

    /**
     * @var string
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
        if ($this->bodyText != null) {
            return $this->bodyText;
        } elseif ($this->autocreateMissingText == true) {
            return $this->removeHtml($this->getBodyHtml());
        }
    }

    /**
     * The mail text body.
     *
     * @Property
     *
     * @param string $bodyText
     */
    public function setBodyText($bodyText) :string
    {
        $this->bodyText = $bodyText;
    }

    /**
     * Returns the HTML text before "emogrification".
     * This method can be overwritten by subclasses to overwrite the mail body and still applying "emogrification".
     *
     * @return string
     */
    protected function getBodyHtmlBeforeEmogrify() :string
    {
        return $this->bodyHtml;
    }

    /**
     * Returns the mail html body.
     *
     * @return string
     */
    public function getBodyHtml():string
    {
        if ($this->css) {
            $emogrifier = new Emogrifier($this->getBodyHtmlBeforeEmogrify(), $this->css);
            $finalHtml = $emogrifier->emogrify();
        } else {
            $finalHtml = $this->getBodyHtmlBeforeEmogrify();
        }

        return $finalHtml;
    }

    /**
     * The mail html body.
     *
     * @param string $bodyHtml
     */
    public function setBodyHtml($bodyHtml):string
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
        return $this->title;
    }

    /**
     * The mail title.
     *
     * @param string $title
     */
    public function setTitle($title) :string
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
     * @Property
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

    /**
     * If no body text is set for that mail, and if autoCreateBodyText is set to true, this object will create the body text from the body HTML text,
     * by removing any tags.
     *
     * @param bool $autoCreate
     */
    public function autoCreateBodyText($autoCreate)
    {
        $this->autocreateMissingText = $autoCreate;
    }

    /**
     * Removes the HTML tags from the text.
     *
     * @param string $s
     * @param string $keep   The list of tags to keep
     * @param string $expand The list of tags to remove completely, along their content
     *
     * @return string
     */
    private function removeHtml($s, $keep = '', $expand = 'script|style|noframes|select|option'):string
    {
        /**///prep the string
        $s = ' '.$s;

        /**///initialize keep tag logic
        if (strlen($keep) > 0) {
            $k = explode('|', $keep);
            for ($i = 0;$i < count($k);$i++) {
                $s = str_replace('<'.$k[$i], '[{('.$k[$i], $s);
                $s = str_replace('</'.$k[$i], '[{(/'.$k[$i], $s);
            }
        }

        $pos = array();
        $len = array();

        //begin removal
        /**///remove comment blocks
        while (stripos($s, '<!--') > 0) {
            $pos[1] = stripos($s, '<!--');
            $pos[2] = stripos($s, '-->', $pos[1]);
            $len[1] = $pos[2] - $pos[1] + 3;
            $x = substr($s, $pos[1], $len[1]);
            $s = str_replace($x, '', $s);
        }

        /**///remove tags with content between them
        if (strlen($expand) > 0) {
            $e = explode('|', $expand);
            for ($i = 0;$i < count($e);$i++) {
                while (stripos($s, '<'.$e[$i]) > 0) {
                    $len[1] = strlen('<'.$e[$i]);
                    $pos[1] = stripos($s, '<'.$e[$i]);
                    $pos[2] = stripos($s, $e[$i].'>', $pos[1] + $len[1]);
                    $len[2] = $pos[2] - $pos[1] + $len[1];
                    $x = substr($s, $pos[1], $len[2]);
                    $s = str_replace($x, '', $s);
                }
            }
        }

        /**///remove remaining tags
        while (stripos($s, '<') > 0) {
            $pos[1] = stripos($s, '<');
            $pos[2] = stripos($s, '>', $pos[1]);
            $len[1] = $pos[2] - $pos[1] + 1;
            $x = substr($s, $pos[1], $len[1]);
            $s = str_replace($x, '', $s);
        }

        /**///finalize keep tag
        if (isset($k)) {
            for ($i = 0;$i < count($k);$i++) {
                $s = str_replace('[{('.$k[$i], '<'.$k[$i], $s);
                $s = str_replace('[{(/'.$k[$i], '</'.$k[$i], $s);
            }
        }

        return trim($s);
    }

    /**
     * Registers some CSS to be applied to the HTML.
     * When sending the mail, the CSS will be DIRECTLY applied to the HTML, resulting in some HTML with inline CSS.
     *
     * CSS is inlined using the Emogrifier library.
     *
     * @param string $css The CSS to apply.
     */
    public function addCssText($css)
    {
        $this->css .= $css;
    }

    /**
     * Registers a CSS file to be applied to the HTML.
     * When sending the mail, the CSS will be DIRECTLY applied to the HTML, resulting in some HTML with inline CSS.
     *
     * CSS is inlined using the Emogrifier library.
     *
     * @param string $file The CSS file to apply.
     */
    public function addCssFile($file)
    {
        $this->css .= file_get_contents($file);
    }
}
