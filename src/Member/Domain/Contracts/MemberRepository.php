<?php

declare(strict_types=1);

namespace Src\Member\Domain\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Src\Member\Domain\ValueObjects\MemberId;

interface MemberRepository
{

    public function all(): ?Collection;

    public function find(MemberId $id);

}
