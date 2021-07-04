<?php

declare(strict_types=1);

namespace Src\Member\Application\get;

use Illuminate\Database\Eloquent\Collection;
use Src\Member\Domain\Contracts\MemberRepository;

final class GetAllMembers
{

    private MemberRepository $repository;


    /**
     * GetAllMembers constructor.
     *
     * @param \Src\Member\Domain\Contracts\MemberRepository $repository
     */
    public function __construct(MemberRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function __invoke(): ?Collection
    {
        return $this->repository->all();
    }

}
