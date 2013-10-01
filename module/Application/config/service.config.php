<?php

return array(
        'invokables' => array(
            /*Mapper for the Database.*/
            'Mapper:Mail' => 'Application\Model\Mapper\Mail'
        ),
        'factories' => array(
        	'Zend\Session\SessionManager' => function ($sm) {
                $config = $sm->get('config');
                if (isset($config['session'])) {
                    $session = $config['session'];

                    $sessionConfig = null;
                    if (isset($session['config'])) {
                        $class = isset($session['config']['class'])  ? $session['config']['class'] : 'Zend\Session\Config\SessionConfig';
                        $options = isset($session['config']['options']) ? $session['config']['options'] : array();
                        $sessionConfig = new $class();
                        $sessionConfig->setOptions($options);
                    }

                    $sessionStorage = null;
                    if (isset($session['storage'])) {
                        $class = $session['storage'];
                        $sessionStorage = new $class();
                    }

                    $sessionSaveHandler = null;
                    if (isset($session['save_handler'])) {
                        // class should be fetched from service manager since it will require constructor arguments
                        $sessionSaveHandler = $sm->get($session['save_handler']);
                    }

                    $sessionManager = new Zend\Session\SessionManager($sessionConfig, $sessionStorage, $sessionSaveHandler);

                    if (isset($session['validator'])) {
                        $chain = $sessionManager->getValidatorChain();
                        foreach ($session['validator'] as $validator) {
                            $validator = new $validator();
                            $chain->attach('session.validate', array($validator, 'isValid'));

                        }
                    }
                } else {
                    $sessionManager = new SessionManager();
                }
                Zend\Session\Container::setDefaultManager($sessionManager);
                return $sessionManager;
            },
            /* Models Start */
            'Model:MailTable' =>  function($sm) {
                $table = new Application\Model\MailTable($sm->get('GetAdapter'));
                return $table;
            },
            'GetAdapter' => function ($sm) {
                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                return $dbAdapter;
            },
            /* Models End */
            'Date\Now\AsiaKolkata' => function($sm) {
                return new \DateTime("now", new \DateTimeZone("Asia/Kolkata"));
            }
        ),
        'shared' => array(
            'Date\Now\AsiaKolkata' => false,
        ),
    );