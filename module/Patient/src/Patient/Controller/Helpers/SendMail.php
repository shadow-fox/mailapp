<?php
/**
 * Created by JetBrains PhpStorm.
 * User: shafox
 * To change this template use File | Settings | File Templates.
 */

namespace Patient\Controller\Helpers;
use Application\Model\Mapper\Mail AS MailMapper;
use Application\Model\MailTable;
use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;
use Zend\Mail\Transport\SmtpOptions;

class SendMail {

    private static $_from = "Pranaya Behera<behera.pranaya@gmail.com>";

    private static $_Email = "Pranaya Behera<behera.pranaya@gmail.com>";
    private static $_baseLink = "http://practo.com";

    public static function send($to, $subject, $msg) {
        $source = self::$_from;
        $m = new Message();
        $m->addTo($to);
        $m->addFrom($source);
        $m->setSubject($subject);
        //var_dump($msg);exit;
        $transport = new SmtpTransport();
        $options = new SmtpOptions(array(
            'host' => 'smtp.gmail.com',
            'connection_class' => 'login',
            'connection_config' => array(
                'ssl' => 'tls',
                'username' => 'yourgmailusername',
                'password' => 'yourgmailpassword'
            ),
            'port' => 587,
        ));



        $m->setBody($msg);
        $transport->setOptions($options);
        $transport->send($m);
    }
}