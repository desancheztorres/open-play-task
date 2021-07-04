<?php

declare(strict_types=1);

namespace Src\Member\Domain\ValueObjects;

use DateTime;

final class MemberDateOfBirth
{
    private DateTime $value;

    public function __construct(DateTime $dateOfBirth)
    {
        $this->value = $dateOfBirth;
    }

    public function value(): DateTime
    {
        return $this->value;
    }
}
