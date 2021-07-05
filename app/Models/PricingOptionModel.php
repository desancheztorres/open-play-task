<?php

namespace App\Models;


use App\PricingOption;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTimestampAccessors;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * Class PricingOptionModel
 * @package App/Models
 * @property int $id
 * @property string $name
 * @property string $type
 * @property float $price
 * @property \DateTime|null $created_at
 * @property \DateTime|null $updated_at
 */
class PricingOptionModel extends Model implements PricingOption
{
    use HasTimestampAccessors, HasFactory;

    protected $table = 'pricing_options';

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
    public function getPrice(): float
    {
        return $this->price;
    }


    /**
     * @inheritDoc
     */
    public function getPricingModifiers(): Collection
    {
        return $this->pricingModifiers;
    }

    /**
     * @inheritDoc
     */
    public function getCurrentPricingModifiers(): Collection
    {
        return $this->currentPricingModifiers;
    }

    /**
     * @return BelongsToMany
     */
    public function pricingModifiers(): BelongsToMany
    {
        return $this->belongsToMany(PricingModifierModel::class,
            'pricing_option_pricing_modifiers',
            'pricing_option_id',
            'pricing_modifier_id'
        )
            ->using(PricingOptionPricingModifierPivot::class)
            ->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */
    public function currentPricingModifiers(): BelongsToMany
    {
        return $this->pricingModifiers()
            ->where('active', '=', 1)
            ->where('valid_from', '<=', Carbon::now())
            ->where(function($query){
                $query->where('valid_to', '>=', Carbon::now());
                $query->orWhereNull('valid_to');
            });
    }

    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(ProductModel::class, 'pricing_option_id');
    }

    /**
     * @inheritDoc
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

}
