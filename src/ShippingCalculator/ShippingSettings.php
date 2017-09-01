<?php
namespace swigle\shippingCalculator;

class ShippingSettings {
	private $deliveryCosts;
	
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
	
	public function getDeliveryCostSettings() {
		return $this->deliveryCosts;
	}
}