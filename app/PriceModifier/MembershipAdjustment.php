<?php

namespace App\PriceModifier;

class MembershipAdjustment extends PriceModifier
{

    public function modify()
    {
        if (in_array($this->model->getMembershipType(), $this->data['membership_types'])) {
            if (array_key_exists('adjustment', $this->data)) {
                return $this->basePrice + $this->data['adjustment'];
            };

            if (array_key_exists('price', $this->data) and $this->model->getMembershipType() === 'platinum') {
                return 0;
            };
        }

        return $this->basePrice;
    }

}
