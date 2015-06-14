<?php
namespace Market\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Market\Controller\IndexController;

/**
 *
 * @author Minello
 *        
 */
class IndexControllerFactory implements FactoryInterface
{

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        $serviceLocator = $controllerManager->getServiceLocator();
        
        $indexController = new IndexController();
        $indexController->setListingsTable($serviceLocator->get('listings-table'));
        
        return $indexController;
    }
}
