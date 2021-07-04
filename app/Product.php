<?php

namespace App;


/**
 * Interface Products
 * @package OpenPlay\Pricing\Products
 */
interface Product
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return string|null
     */
    public function getDescription(): ?string;

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime;

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt(): ?\DateTime;

    /**
     * @return PricingOption
     */
    public function getPricingOption(): PricingOption;

    /**
     * @return int
     */
    public function getPricingOptionId(): int;

}
