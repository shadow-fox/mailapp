<?php

return array(
	'router' => array(
        'routes' => array(
            'patient' => array(
                'type'    => 'segment',
                'options' => array(
                    'route' => '/patient[/:id]',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller'    => 'Patient\Controller\Index',
                    ),
                ),
            ),
            'email' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/mail',
                    'constraints' => array(
                    ),
                    'defaults' => array(
                        'controller'    => 'Patient\Controller\Email',
                        'action'        => 'index',
                    ),
                ),
            ),
            'send' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/mail/send',
                    'constraints' => array(
                    ),
                    'defaults' => array(
                        'controller'    => 'Patient\Controller\Email',
                        'action'        => 'send',
                    ),
                ),
            ),
            'lists' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/mail/list',
                    'constraints' => array(
                    ),
                    'defaults' => array(
                        'controller'    => 'Patient\Controller\Email',
                        'action'        => 'list',
                    ),
                ),
            ),
        ),
    )
);
