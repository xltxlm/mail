<?php
/**
 * Created by PhpStorm.
 * User: xialintai
 * Date: 2016/12/27
 * Time: 9:39.
 */

namespace xltxlm\mail;

use xltxlm\logger\Operation\Action\MailLog;
use xltxlm\mail\Config\MailConfig;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;
use xltxlm\mail\Util\MailUserInfo;

/**
 * 发送邮件
 * Class MailSmtp.
 */
final class MailSmtp
{
    /** @var MailConfig 邮件服务器配置 */
    protected $mailConfig;
    protected $title;
    protected $body = '';
    /** @var MailUserInfo[] */
    protected $to = [];
    /** @var MailUserInfo[] 抄送的人 */
    protected $cc = [];

    /** @var string 指定的回复人 */
    protected $ReplyTo = "";

    /**
     * @return MailUserInfo[]
     */
    public function getCc(): array
    {
        return $this->cc;
    }

    /**
     * @param MailUserInfo[] $cc
     * @return MailSmtp
     */
    public function setCc(array $cc): MailSmtp
    {
        $this->cc = $cc;
        return $this;
    }


    /**
     * @return string
     */
    public function getReplyTo(): string
    {
        return $this->ReplyTo;
    }

    /**
     * @param string $ReplyTo
     * @return MailSmtp
     */
    public function setReplyTo(string $ReplyTo): MailSmtp
    {
        $this->ReplyTo = $ReplyTo;
        return $this;
    }


    /**
     * @return MailConfig
     */
    public function getMailConfig(): MailConfig
    {
        return $this->mailConfig;
    }

    /**
     * @param MailConfig $mailConfig
     *
     * @return MailSmtp
     */
    public function setMailConfig(MailConfig $mailConfig): MailSmtp
    {
        $this->mailConfig = $mailConfig;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     *
     * @return MailSmtp
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     *
     * @return MailSmtp
     */
    public function setBody(string $body): MailSmtp
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return MailUserInfo[]
     */
    public function getTo(): array
    {
        return $this->to;
    }

    /**
     * @param MailUserInfo $to
     *
     * @return MailSmtp
     */
    public function setTo(MailUserInfo $to): MailSmtp
    {
        $this->to[] = $to;

        return $this;
    }

    /**
     * 发送邮件.
     */
    public function __invoke()
    {
        $start = microtime(true);
        // Create the Transport
        $transport = (new Swift_SmtpTransport($this->getMailConfig()->getHost(), $this->getMailConfig()->getPort(), $this->getMailConfig()->isSsl() ? 'ssl' : ($this->getMailConfig()->isTls() ? 'tls' : '')))
            ->setUsername($this->getMailConfig()->getUserName())
            ->setPassword($this->getMailConfig()->getPassword());
        $mailer = new Swift_Mailer($transport);

        // Create the message
        $message = new Swift_Message();
        $mailUserInfos = $this->getTo();
        $mailUserInfo = array_shift($mailUserInfos);
        $message->setTo([$mailUserInfo->getEmail() => $mailUserInfo->getNickname()]);
        $message
            // Give the message a subject
            ->setSubject($this->getTitle())
            // Set the From address with an associative array
            ->setFrom([$this->getMailConfig()->getUserName() => $mailUserInfo->getFromUserName() ?: $this->getMailConfig
            ()->getNickName()]);
        foreach ($mailUserInfos as $to) {
            // Set the To addresses with an associative array
            $message->addCc($to->getEmail(), $to->getNickname());
        };
        foreach ($this->getCc() as $email=>$username) {
            // Set the To addresses with an associative array
            $message->addCc($email, $username);
        };
        if ($this->getReplyTo()) {
            $message->setReplyTo($this->getReplyTo());
        }
        // Give it a body
        $message->setBody($this->getBody(), 'text/html');
        $mailer->send($message);
        $time = sprintf('%.4f', microtime(true) - $start);
        (new MailLog)->setRunTime($time)();
    }
}
