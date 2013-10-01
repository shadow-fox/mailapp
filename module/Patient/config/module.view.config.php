<?php

return array(
	'view_manager' => array(
        'template_map' => array(
            'patient/layout'  =>  __DIR__ . '/../view/layout/layout.phtml',
            'patient/index/index'  =>  __DIR__ . '/../view/patient/index/index.phtml',
            'patient/index/get-list'  =>  __DIR__ . '/../view/patient/index/get-list.phtml',
            'patient/index/get'  =>  __DIR__ . '/../view/patient/index/get.phtml',
            'patient/mail/index'   =>  __DIR__ . '/../view/patient/mail/index.phtml',
            'patient/mail/mailform'  => __DIR__ . '/../view/patient/mail/mail-form.phtml',
            'mail/list'  => __DIR__ . '/../view/patient/mail/list.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
);
