<?php

namespace App\Models;

use App\PricingOption;
use App\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTimestampAccessors;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ProductModel
 * @package App/Models
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string|null $description
 * @property int pricing_option_id
 * @property \DateTime|null $created_at
 * @property \DateTime|null $updated_at
 */
class ProductModel extends Model implements Product
{
    use HasTimestampAccessors, HasFactory;
    

    /**
     * @var string
     */
    protected $table = 'products';

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
    public function getStockCount(): int
    {
        return $this->stock_count;
    }

    /**
     * @inheritDoc
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @inheritDoc
     */
    public function getPricingOptionId(): int
    {
        return $this->pricing_option_id;
    }

    /**
     * @inheritDoc
     */
    public function getPricingOption(): PricingOption
    {
        return $this->pricingOption;
    }

    /**
     * @return BelongsTo
     */
    public function pricingOption(): BelongsTo
    {
        return $this->belongsTo(PricingOptionModel::class);
    }
}
