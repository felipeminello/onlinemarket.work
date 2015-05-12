<?php
namespace Market\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Market\Controller\PostController;

/**
 *
 * @author Minello
 *        
 */
class PostControllerFactory implements FactoryInterface
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
        
        $categories = $serviceLocator->get('categories');
        
        $postController = new PostController();
        $postController->setCategorires($categories);
        
        return $postController;
    }
}
