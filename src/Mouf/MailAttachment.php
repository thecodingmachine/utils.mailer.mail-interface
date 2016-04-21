<?php

namespace Mouf\Utils\Mailer;

/**
 * This class represents an attachement in a mail.
 */
class MailAttachment implements MailAttachmentInterface
{
    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $fileName;

    /**
     * @var string
     */
    private $mimeType = 'application/octet-stream';

    /**
     * @var string
     */
    private $encoding = 'ENCODING_BASE64';

    /**
     * @var string
     */
    private $attachmentDisposition = 'attachment';

    /**
     * @var string
     */
    private $contentId;

    /**
     * Returns the content of the file to attach, as an octet stream.
     *
     * @return string
     */
    public function getFileContent():string
    {
        return $this->content;
    }

    /**
     * The content of the file to attach, as an octet stream.
     *
     * @Property
     * @Compulsory
     *
     * @param string $content
     */
    public function setFileContent(string $content)
    {
        $this->content = $content;
    }

    /**
     * Returns the name of the file in the mail.
     *
     * @return string
     */
    public function getFileName():string
    {
        return $this->fileName;
    }

    /**
     * The name of the file in the mail.
     *
     * @Property
     * @Compulsory
     *
     * @param string $fileName
     */
    public function setFileName(string $fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * Returns the mime-type of the attachement.
     *
     * @return string
     */
    public function getMimeType():string
    {
        return $this->mimeType;
    }

    /**
     * The mime-type of the attachement.
     *
     * @Property
     * @Compulsory
     *
     * @param string $mimeType
     */
    public function setMimeType(string $mimeType)
    {
        $this->mimeType = $mimeType;
    }

    /**
     * Returns the encoding.
     * Can be one of: "ENCODING_7BIT", "ENCODING_8BIT", "ENCODING_QUOTEDPRINTABLE", "ENCODING_BASE64".
     *
     * @return string
     */
    public function getEncoding():string
    {
        return $this->encoding;
    }

    /**
     * The encoding of the attachement.
     *
     * @Property
     * @Compulsory
     * @OneOf("ENCODING_7BIT", "ENCODING_8BIT", "ENCODING_QUOTEDPRINTABLE", "ENCODING_BASE64")
     *
     * @param string $encoding
     */
    public function setEncoding(string $encoding)
    {
        $this->encoding = $encoding;
    }

    /**
     * Returns the attachement disposition.
     * Can be one of: "attachment", "inline".
     *
     * @return string
     */
    public function getAttachmentDisposition():string
    {
        return $this->attachmentDisposition;
    }

    /**
     * The encoding of the attachement.
     *
     * @Property
     * @Compulsory
     * @OneOf("attachment", "inline")
     *
     * @param string $attachmentDisposition
     */
    public function setAttachmentDisposition(string $attachmentDisposition)
    {
        $this->attachmentDisposition = $attachmentDisposition;
    }

    /**
     * Returns the content-id of the mail attachment.
     * The content-id is required if you want to embed an image in a mail.
     * If so, you will use the syntax: <img src="cid:XXX" /> to display the image.
     *
     * @return string
     */
    public function getContentId():string
    {
        return $this->contentId;
    }

    /**
     * The content-id of the mail attachment.
     * The content-id is required if you want to embed an image in a mail.
     * If so, you will use the syntax: <img src="cid:XXX" /> to display the image.
     *
     * @Property
     * @Compulsory
     *
     * @param string $contentId
     */
    public function setContentId(string $contentId)
    {
        $this->contentId = $contentId;
    }
}
