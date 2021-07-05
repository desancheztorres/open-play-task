<?php

namespace App\PriceModifier;

class BasicMultiplier extends PriceModifier
{

    public function modify()
    {
        return $this->basePrice * $this->data['multiplier'];
    }

}
