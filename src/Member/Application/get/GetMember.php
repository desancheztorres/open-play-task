<?php

declare(strict_types=1);

namespace Src\Member\Application\get;

use Src\Member\Domain\Contracts\MemberRepository;
use Src\Member\Domain\ValueObjects\MemberId;

class GetMember
{

    private MemberRepository $repository;

    /**
     * @param \Src\Member\Domain\Contracts\MemberRepository $repository
     */
    public function __construct(MemberRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param int $memberId
     *
     * @return mixed
     */
    public function __invoke(int $memberId)
    {
        $id = new MemberId($memberId);

        return $this->repository->find($id);

    }

}
