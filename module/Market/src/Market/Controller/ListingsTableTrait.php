<?php
namespace Market\Controller;

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
	public function setListingsTable($listingsTable) {
		$this->listingsTable = $listingsTable;
	}
	
}