<?php
namespace Market\Controller;

use Market\Model\ListingsTable;

trait ListingsTableTrait {
    protected $listingsTable;	
	/**
	 * @return the $listingsTable
	 */
	public function getListingsTable() {
		return $this->listingsTable;
	}

	/**
	 * @param ListingsTable $listingsTable
	 */
	public function setListingsTable(ListingsTable $listingsTable) {
		$this->listingsTable = $listingsTable;
	}
	
}