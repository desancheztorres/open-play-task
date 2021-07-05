<?php

namespace App\PriceModifier;

class BasicAdjustment extends PriceModifier
{

    public function modify()
    {
        return $this->basePrice + $this->data['adjustment'];
    }

}
