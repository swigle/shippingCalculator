<?php
namespace swigle\shippingCalculator;

class ShippingCalculator {
	private $shippingSettings;
	public function setSettings(ShippingSettings $settings) {
		$this->shippingSettings = $settings;
	}
	
	public function getShippingCosts($total, $country, $discountRate = 0) {
		if(!isset($this->shippingSettings[strtolower($country)]) || sizeof($this->shippingSettings[strtolower($country)]) == 0)
			throw Exception('Country not defined');
		 
		$tierPrices = $this->shippingSettings[strtolower($country)];
		$matchingTierPrices = [];
		
		foreach(array_keys($tierPrices) as $tierPrice) {
			if($total >= floatval($tierPrice))
				$matchingTierPrices[] = $tierPrices[$tierPrice];
		}
		
		$selectedPrice = end($matchingTierPrices);
		 
		$discountRate = self::getCustomerDiscountPercentage();
		if($discountRate > 0)
			$finalPrice = $selectedPrice - (($selectedPrice / 100) * $discountRate);
			
		return (isset($finalPrice)) ? $finalPrice : $selectedPrice;
	}
	
}