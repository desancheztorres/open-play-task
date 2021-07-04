<?php

declare(strict_types=1);

namespace Src\Member\Infrastructure\Repositories;

use App\Models\MemberModel as EloquentMemberModel;
use Illuminate\Database\Eloquent\Collection;
use Src\Member\Domain\Contracts\MemberRepository;
use Src\Member\Domain\ValueObjects\MemberId;

final class EloquentMemberRepository implements MemberRepository
{

    /**
     * @var \App\Models\MemberModel
     */
    private EloquentMemberModel $eloquentMemberModel;

    /**
     * EloquentMemberRepository constructor.
     */
    public function __construct()
    {
        $this->eloquentMemberModel = new EloquentMemberModel;
    }

    public function all(): ?Collection
    {
        return $this->eloquentMemberModel->get();
    }


    /**
     * @param \Src\Member\Domain\ValueObjects\MemberId $id
     *
     * @return mixed
     */
    public function find(MemberId $id)
    {
        return $this->eloquentMemberModel->findOrFail($id->value());
    }

}
