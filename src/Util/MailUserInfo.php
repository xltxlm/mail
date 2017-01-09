<?php
/**
 * Created by PhpStorm.
 * User: xialintai
 * Date: 2016/12/27
 * Time: 10:38.
 */

namespace xltxlm\mail\Util;

/**
 * Class UserInfo.
 */
class MailUserInfo
{
    /** @var string 邮箱地址 */
    protected $email = '';
    /** @var string 显示名称 */
    protected $nickname = '';

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return MailUserInfo
     */
    public function setEmail(string $email): MailUserInfo
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    /**
     * @param string $nickname
     *
     * @return MailUserInfo
     */
    public function setNickname(string $nickname): MailUserInfo
    {
        $this->nickname = $nickname;

        return $this;
    }
}
