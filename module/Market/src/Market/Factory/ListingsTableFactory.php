<?php
namespace Market\Factory;

use Zend\ServiceManager\FactoryInterface;
use Market\Model\ListingsTable;
use Zend\ServiceManager\ServiceLocatorInterface;

class ListingsTableFactory implements FactoryInterface {
	public function createService(ServiceLocatorInterface $sm) {
		$adapter = $sm->get('general-adapter');
		
		return new ListingsTable(ListingsTable::$tableName, $adapter);
	}
}
