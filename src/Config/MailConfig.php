<?php
/**
 * Created by PhpStorm.
 * User: xialintai
 * Date: 2016/12/27
 * Time: 9:39.
 */

namespace xltxlm\mail\Config;

/**
 * SMTP账户配置
 * Class MailConfig.
 */
abstract class MailConfig
{
    protected $host = '';
    protected $userName = '';
    /** @var string 账户显示的名称 */
    protected $nickName = '';
    /** @var string 密码 */
    protected $password = '';
    protected $port = '';

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return MailConfig
     */
    public function setPassword(string $password): MailConfig
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getNickName(): string
    {
        return $this->nickName;
    }

    /**
     * @param string $nickName
     *
     * @return MailConfig
     */
    final public function setNickName(string $nickName)
    {
        $this->nickName = $nickName;

        return $this;
    }

    /**
     * @return string
     */
    final public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @param string $host
     *
     * @return $this
     */
    final public function setHost(string $host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * @return string
     */
    final public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     *
     * @return $this
     */
    final public function setUserName(string $userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * @return string
     */
    final public function getPort(): string
    {
        return $this->port;
    }

    /**
     * @param string $port
     *
     * @return $this
     */
    final public function setPort(string $port)
    {
        $this->port = $port;

        return $this;
    }
}
