<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Market for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Market;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module implements AutoloaderProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
		    // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/' , __NAMESPACE__),
                ),
            ),
        );
    }
    
    public function getServiceConfig() {
    	$expireDays = array(
    		'2015-05-21' => '21/05/2015',
    		'2015-05-22' => '22/05/2015',
    		'2015-05-23' => '23/05/2015'
    	);
    	
    	$captchaOptions = array(
    		'imgDir' => sys_get_temp_dir(),
	   		'imgDelete' => false,
    		'fontDir' => __DIR__.'/fonts/',
    		'font' => 'arial.ttf',
    		'width' => 250,
    		'height' => 100,
    		'dotNoiseLevel' => 40,
    		'lineNoiseLevel' => 3
        );
    	
    	return array(
    		'invokables' => array(
    			'ExemploService' => 'Application\Service\ExemploService'
    		),
    		'services' => array(
    			'expire_days' => $expireDays,
    			'captcha_options' => $captchaOptions
    		)
    	);
    }
    

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap(MvcEvent $e)
    {
        // You may not need to do this if you're doing it elsewhere in your
        // application
    	
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }
}
