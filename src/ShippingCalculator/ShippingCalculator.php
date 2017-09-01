<?php
namespace Swigle\ShippingCalculator;

class ShippingCalculator {
	private $shippingSettings;
	
	function __construct(ShippingSettings $settings) {
		$this->setSettings($settings);
	}

	public function setSettings(ShippingSettings $settings) {
		$this->shippingSettings = $settings;
	}
	
	public function getShippingCosts($total, $country, $discountRate = 0) {
		$shippingSettings = $this->shippingSettings->getDeliveryCostSettings();
		if(!isset($shippingSettings[strtolower($country)]) || sizeof($shippingSettings[strtolower($country)]) == 0)
			throw Exception('Country not defined');
		 
		$tierPrices = $shippingSettings[strtolower($country)];
		$matchingTierPrices = [];
		
		foreach(array_keys($tierPrices) as $tierPrice) {
			if($total >= floatval($tierPrice))
				$matchingTierPrices[] = $tierPrices[$tierPrice];
		}
		
		$selectedPrice = end($matchingTierPrices);
		 
		if($discountRate > 0)
			$finalPrice = $selectedPrice - (($selectedPrice / 100) * $discountRate);
			
		return (isset($finalPrice)) ? $finalPrice : $selectedPrice;
	}
	
}
