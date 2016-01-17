<?php
App::uses('AppModel', 'Model');

class Currency extends AppModel {

	/**
    *@param array $abbr the currency abbreviation
    *@return array the first row matching the currency abbreviation
    **/
	public function getCurrencyByAbbreviation($abbr){
		return $this->find('first',array('conditions'=>array('Currency.abbreviation'=>$abbr)));
	}


}