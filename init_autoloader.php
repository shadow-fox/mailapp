<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

/**
 * This autoloading setup is really more complicated than it needs to be for most
 * applications. The added complexity is simply to reduce the time it takes for
 * new developers to be productive with a fresh skeleton. It allows autoloading
 * to be correctly configured, regardless of the installation method and keeps
 * the use of composer completely optional. This setup should work fine for
 * most users, however, feel free to configure autoloading however you'd like.
 */

$zf2Path = false;

if (getenv('ZF2_PATH')) {	// .htaccess in public
    $zf2Path = getenv('ZF2_PATH');
} else {
	die("Plese define ZF2 Path");
}

if ($zf2Path) {
    /*
    include $zf2Path . '/Zend/Loader/AutoloaderFactory.php';
        Zend\Loader\AutoloaderFactory::factory(array(
            'Zend\Loader\StandardAutoloader' => array(
                //'autoregister_zf' => true //To auto assign ZF Library Path
                'namespaces' => array(
                    //'Zend'		=>			APPLICATION_PATH."/vendor/zf2/library/Zend"
                )
            )
        ));*/
    
    
    require_once $zf2Path.'/Zend/Loader/StandardAutoloader.php';
	$loader = new Zend\Loader\StandardAutoloader(array(
	    'autoregister_zf' => true,
	    'namespaces' => array(
	        'Zend'		=>			APPLICATION_PATH."/vendor/zf2/library/Zend"
	    )
	));
	
	// Register with spl_autoload:
	$loader->register();
}

if (!class_exists('Zend\Loader\AutoloaderFactory')) {
    throw new RuntimeException('Unable to load ZF2. Run `php composer.phar install` or define a ZF2_PATH environment variable.');
}
