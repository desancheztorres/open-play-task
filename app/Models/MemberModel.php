<?php

namespace App\Models;


use App\Member;
use App\Traits\HasTimestampAccessors;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MemberModel
 * @package App
 * @property int $id
 * @property string $name
 * @property string $membership_type
 * @property bool $active
 * @property \DateTime|null $created_at
 * @property \DateTime|null $updated_at
 */
class MemberModel extends Model implements Member
{
    use HasTimestampAccessors;

    /**
     * @inheritDoc
     */
    protected $table = 'members';

    protected $dates = ['date_of_birth'];

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
    public function getMembershipType(): string
    {
        return $this->membership_type;
    }

    /**
     * @inheritDoc
     */
    public function getDateOfBirth(): \DateTime
    {
        return $this->date_of_birth;
    }

    public function getMyAge(): int
    {
        return Carbon::parse($this->getDateOfBirth())->age;
    }

}
