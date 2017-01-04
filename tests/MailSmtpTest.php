<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-01-03
 * Time: 下午 11:20
 */

namespace tests\redis;

use PHPUnit\Framework\TestCase;
use xltxlm\mail\MailSmtp;
use xltxlm\mail\tests\Mail;
use xltxlm\mail\Util\MailUserInfo;

class MailSmtpTest extends TestCase
{

    public function test()
    {
        (new MailSmtp())
            ->setMailConfig(new Mail())
            ->setTitle('测试邮件')
            ->setBody(date('Y-m-d H:i:s'))
            ->setTo((new MailUserInfo())->setEmail('xltxlm@qq.com')->setNickname('夏琳泰'))
            ->setTo((new MailUserInfo())->setEmail('95141373@qq.com')->setNickname('夏琳泰2'))
            ->__invoke();
    }
}