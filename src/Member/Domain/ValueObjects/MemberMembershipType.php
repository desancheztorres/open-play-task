<?php

declare(strict_types=1);

namespace Src\Member\Domain\ValueObjects;

final class MemberMembershipType
{

    private string $value;

    /**
     * ProductName constructor.
     *
     * @param string $membershipType
     */
    public function __construct(string $membershipType)
    {
        $this->value = $membershipType;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

}
