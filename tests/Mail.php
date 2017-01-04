<?php
/**
 * Created by PhpStorm.
 * User: xialintai
 * Date: 2016/12/27
 * Time: 10:32
 */

namespace xltxlm\mail\tests;


use xltxlm\mail\Config\MailConfig;

class Mail extends MailConfig
{
    protected $host = 'smtp.exmail.qq.com';
    protected $port = 25;
    protected $userName = 'xialintai@kuaigeng.com';
    protected $nickName = '服务器监控';
    protected $password = '1qaz!QAZ';
}