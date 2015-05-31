<?php
namespace Market\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Market\Form\PostForm;
use Market\Controller\PostController;


/**
 *
 * @author Minello
 *        
 */
class PostFormFactory implements FactoryInterface {

	/**
	 * (non-PHPdoc)
	 *
	 * @see \Zend\ServiceManager\FactoryInterface::createService()
	 *
	 */
	public function createService(ServiceLocatorInterface $serviceManager) {
		$categories = $serviceManager->get('categories');
		
		$form = new PostForm();
		$form->setCategories($categories);		
		$form->buildForm();
		$form->setInputFilter($serviceManager->get('market-post-filter'));
		
		return $form;
	}
}