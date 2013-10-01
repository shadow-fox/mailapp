<?php

return array(
    'router' => array(
        'routes' => array(
            'application' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller'    => 'Application\Controller\Index',
                        'action'        => 'index',
                    ),
                ),
            )
        ),
    )
);
