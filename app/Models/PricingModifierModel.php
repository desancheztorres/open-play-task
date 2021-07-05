<?php

namespace App\Models;


use App\PricingModifier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTimestampAccessors;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

/**
 * Class PricingModifierModel
 * @package App/Models
 * @property int $id
 * @property string $name
 * @property string $type
 * @property array $settings
 * @property \DateTime|null $created_at
 * @property \DateTime|null $updated_at
 */
class PricingModifierModel extends Model implements PricingModifier
{
    use HasTimestampAccessors, HasFactory;

    /**
     * @var string
     */
    protected $table = 'pricing_modifiers';

    /**
     * @var array
     */
    protected $casts = ['settings' => 'array'];

    /**
     * @inheritDoc
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @inheritDoc
     */
    public function getSettings(): array
    {
        return $this->settings;
    }

    /**
     * @inheritDoc
     */
    public function getPricingOptions(): Collection
    {
        return $this->pricingOptions;
    }

    /**
     * @return BelongsToMany
     */
    public function pricingOptions() : BelongsToMany
    {
        return $this->belongsToMany(PricingOptionModel::class)
            ->using(PricingOptionPricingModifierPivot::class);
    }

}
