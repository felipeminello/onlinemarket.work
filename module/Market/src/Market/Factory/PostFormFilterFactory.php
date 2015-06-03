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
		
		$filter = new PostFormFilter();
		$filter->setCategories($categories);
		$filter->setExpireDays($serviceManager->get('expire_days'));
		$filter->buildFilter();
		
		return $filter;
	}
}
