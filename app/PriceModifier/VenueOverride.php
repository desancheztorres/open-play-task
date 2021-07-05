<?php

namespace App\PriceModifier;

class VenueOverride extends PriceModifier
{

    public function modify()
    {
        if ((in_array($this->model->getLocation(), $this->data['venue_locations']))) {
            if (array_key_exists('multiplier', $this->data)) {
                return $this->basePrice * $this->data['multiplier'];
            };

            if (array_key_exists('price', $this->data)) {
                return $this->data['price'];
            };
        }

        return $this->basePrice;
    }

}
