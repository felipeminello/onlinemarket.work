<?php
namespace Market\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Market\Controller\PostController;
use Market\Form\PostFormFilter;


/**
 *
 * @author Minello
 *        
 */
class PostFormFilterFactory implements FactoryInterface {

	/**
	 * (non-PHPdoc)
	 *
	 * @see \Zend\ServiceManager\FactoryInterface::createService()
	 *
	 */
	public function createService(ServiceLocatorInterface $serviceManager) {
		$categories = $serviceManager->get('categories');
		
		$filer = new PostFormFilter();
		$filer->setCategories($categories);		
		$filer->buildFilter();
		
		return $filer;
	}
}
