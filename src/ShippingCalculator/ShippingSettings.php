<?php
namespace Swigle\ShippingCalculator;

class ShippingSettings {
	private $deliveryCosts;

	public function addCountries($costs) {
		$this->deliveryCosts = $costs;
	}
	
	public function addCountry($code, $costs = [])  {
		if(isset($deliveryCosts))
			throw Exception('Country allready exists');
		
		$this->deliveryCosts[$code] = [];
		
		if($costs)
			$this->addCosts($costs, $country);
	}
	
	public function addCosts(array $costs, $country) {
		if(!$this->deliveryCosts[$country])
			throw Exception('Country not yet created. Use addCountry instead');
		
		$this->deliveryCosts[$country] = $costs;
	}
	
	public function getDeliveryCostSettings($country = false) {
		if($country && isset($this->deliveryCosts[$country]))
			return $this->deliveryCosts[$country];
		else if($country)
			throw Exception('No settings known for given country \''.$country.'\'');

		return $this->deliveryCosts;
	}
}
