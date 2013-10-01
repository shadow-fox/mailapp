<?php

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\ModuleManager\ModuleManager;
use Zend\Stdlib\CallbackHandler;
use Zend\Session\Container;

class Module {
	public function init(ModuleManager $moduleManager) {
		$sharedEvents = $moduleManager->getEventManager()->getSharedManager();
        $sharedEvents->attach(__NAMESPACE__, 'dispatch', function($e) {
            // This event will only be fired when an ActionController under the MyModule namespace is dispatched.
            $controller = $e->getTarget();
            $controller->layout('application/layout');
        }, 100);
    }  
	
	public function preDispatchEvent($e) {
        $matches    = $e->getRouteMatch();
		$controller = $matches->getParam('controller');
    }
	
    public function onBootstrap($e) {
       $this->_bootstrapSession($e);
    }

    public function getConfig() {
    	return array_merge(require __DIR__ . '/config/module.config.php', require __DIR__ . '/config/module.route.config.php', 
        					require __DIR__ . '/config/module.view.config.php');
    }

    public function getAutoloaderConfig() {
    	return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                            __DIR__ . '/autoload_classmap.php',
                        ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
	
	public function getServiceConfig() {
    	return require __DIR__ . '/config/service.config.php';
    }
	
	private function _bootstrapSession($e) {
		$sessionManager = $e->getApplication()
                     ->getServiceManager()
                     ->get('Zend\Session\SessionManager');
        $sessionManager->start();

        $container = new Container('initialized');
		if (!isset($container->init)) {
             $sessionManager->regenerateId(true);
             $container->init = 1;
        }
	}
}