<?php
/**
 * Local Configuration Override
 *
 * This configuration override file is for overriding environment-specific and
 * security-sensitive configuration information. Copy this file without the
 * .dist extension at the end and populate values as needed.
 *
 * @NOTE: This file is ignored from Git by default with the .gitignore included
 * in ZendSkeletonApplication. This is a good practice, as it prevents sensitive
 * credentials from accidentally being comitted into version control.
 */

return array(
    'db' => array(
        'username' => 'root',
        'password' => '123',
    ),
    'session' => array(
        'config' => array(
            'class' => 'Zend\Session\Config\SessionConfig',
            'options' => array(
                'name' => 'mailapp',
                /* 'cookie_domain' => '127.0.0.1', */
                'cookie_httponly' => true,
                'cookie_path' => '/mailapp',
                'hash_function' => 'sha1',
                'use_cookies' => true,
                'remember_me_seconds' => 3600,
                //'cookie_lifetime' => 3600, 
            ),
        ),
        //'storage' => 'Zend\Session\Storage\ArrayStorage',
        'validators' => array(
            array(
                'Zend\Session\Validator\RemoteAddr',
                'Zend\Session\Validator\HttpUserAgent',
            ),
        ),
    ),
);
