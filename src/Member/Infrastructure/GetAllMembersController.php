<?php

declare(strict_types=1);

namespace Src\Member\Infrastructure;

use Illuminate\Database\Eloquent\Collection;
use Src\Member\Application\get\GetAllMembers;
use Src\Member\Infrastructure\Repositories\EloquentMemberRepository;

final class GetAllMembersController
{

    private EloquentMemberRepository $repository;

    /**
     * GetAllMembersController constructor.
     *
     * @param \Src\Member\Infrastructure\Repositories\EloquentMemberRepository $repository
     */
    public function __construct(EloquentMemberRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function __invoke(): ?Collection
    {
        $getAllMembers = new GetAllMembers($this->repository);

        return $getAllMembers->__invoke();
    }

}
