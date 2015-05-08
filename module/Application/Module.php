<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        
        // escutar / listenes: "dispatch" event
        // context: $this
        // handler / callback / metodo: onDispatch()
        // prioridade: 100
        $eventManager->attach(MvcEvent::EVENT_DISPATCH, array($this, 'onDispatch'), 100);
        
        $ZfcTwigRenderer = $e->getApplication()->getServiceManager()->get('ZfcTwigRenderer');
        
//        var_dump($ZfcTwigRenderer);
    }
    
    public function onDispatch(MvcEvent $e)
    {
        $sm = $e->getApplication()->getServiceManager();
        $categories = $sm->get('categories');
        
        $vm = $e->getViewModel();
        $vm->setVariable('categories', $categories);
    }
    
    public function getServiceConfig()
    {
        return array(
            'invokables' => array(
                'ExemploService' => 'Application\Service\ExemploService'
            )
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
