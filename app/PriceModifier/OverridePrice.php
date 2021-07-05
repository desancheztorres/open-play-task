<?php

namespace App\PriceModifier;

class OverridePrice extends PriceModifier
{

    public function modify()
    {
        return $this->data['price'];
    }

}
