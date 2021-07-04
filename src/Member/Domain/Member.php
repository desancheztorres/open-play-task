<?php

declare(strict_types=1);

namespace Src\Member\Domain;


use Src\Member\Domain\ValueObjects\MemberDateOfBirth;
use Src\Member\Domain\ValueObjects\MemberMembershipType;
use Src\Member\Domain\ValueObjects\MemberName;

final class Member
{

    private MemberName $name;
    private MemberMembershipType $membershipType;
    private MemberDateOfBirth $dateOfBirth;


    /**
     * Member constructor.
     *
     * @param \Src\Member\Domain\ValueObjects\MemberName           $name
     * @param \Src\Member\Domain\ValueObjects\MemberMembershipType $membershipType
     * @param \Src\Member\Domain\ValueObjects\MemberDateOfBirth    $dateOfBirth
     */
    public function __construct(
        MemberName $name,
        MemberMembershipType $membershipType,
        MemberDateOfBirth $dateOfBirth
    ) {
        $this->name           = $name;
        $this->membershipType = $membershipType;
        $this->dateOfBirth    = $dateOfBirth;
    }


    /**
     * @return \Src\Member\Domain\ValueObjects\MemberName
     */
    public function name(): MemberName
    {
        return $this->name;
    }

    /**
     * @return \Src\Member\Domain\ValueObjects\MemberMembershipType
     */
    public function membershipType(): MemberMembershipType
    {
        return $this->membershipType;
    }

    public function dateOfBirth(): MemberDateOfBirth
    {
        return $this->dateOfBirth;
    }


    /**
     * @param \Src\Member\Domain\ValueObjects\MemberName           $name
     * @param \Src\Member\Domain\ValueObjects\MemberMembershipType $membershipType
     * @param \Src\Member\Domain\ValueObjects\MemberDateOfBirth    $dateOfBirth
     *
     * @return \Src\Member\Domain\Member
     */
    public static function create(
        MemberName $name,
        MemberMembershipType $membershipType,
        MemberDateOfBirth $dateOfBirth
    ): Member {
        return new self($name, $membershipType, $dateOfBirth);
    }

}
