<?php

namespace App\PriceModifier;

class MemberAgeMultiplier extends PriceModifier
{

    public function modify()
    {
        if ($this->model->getMyAge() > $this->data['age_range']['from'] and
            $this->model->getMyAge() < $this->data['age_range']['to']) {
            return $this->basePrice * $this->data['multiplier'];
        }

        return $this->basePrice;
    }



}
