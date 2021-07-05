<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Traits\HasTimestampAccessors;

/**
 * Class ProductPricingModifierModel
 * @package App/Models
 * @property int $pricing_modifier_id
 * @property int $pricing_option_id
 * @property \DateTime valid_from
 * @property \DateTime|null valid_to
 * @property bool active
 * @property \DateTime|null $created_at
 * @property \DateTime|null $updated_at
 */
class PricingOptionPricingModifierPivot extends Pivot
{
    use HasTimestampAccessors, HasFactory;

    /**
     * @var string
     */
    protected $table = 'pricing_option_pricing_modifiers';

    /**
     * @var array
     */
    protected $casts = ['active' => 'boolean'];

    /**
     * @var array
     */
    protected $dates = ['valid_from', 'valid_to'];

    /**
     * @return int
     */
    public function getPricingModifierId(): int
    {
        return $this->pricing_modifier_id;
    }

    /**
     * @return int
     */
    public function getPricingOptionId(): int
    {
        return $this->pricing_option_id;
    }

    /**
     * @return \DateTime
     */
    public function getValidFrom(): \DateTime
    {
        return $this->valid_from;
    }

    /**
     * @return \DateTime|null
     */
    public function getValidTo(): ?\DateTime
    {
        return $this->valid_to;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }


}
