<?php

declare(strict_types=1);

namespace App;

class AddressFormatter
{
    public function __invoke(Address $address): string
    {
        $parts = [];
        $countryCode = $address->getCountryCode();
        $zipCode = $address->getZipCode();
        $city = $address->getCity();
        
        if ($countryCode !== null) {
            $parts[] = $countryCode . ' -';
        }
        
        if ($zipCode !== null) {
            $parts[] = $zipCode . ',';
        }

        if ($city !== null) {
            $parts[] = $city;
        }
        
        if (($countryCode !== null) && ($zipCode !== null) && ($city !== null)) {
            $parts[] = '(Adresse ist komplett)';
        }
        
        return rtrim(implode(' ', $parts), ' -,');
    }    
}