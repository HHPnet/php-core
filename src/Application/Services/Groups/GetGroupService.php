<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Application\Services\Groups;

use HHPnet\Core\Domain\Groups\GroupRepositoryInterface;

class GetGroupService
{
    /**
     * @var HHPnet\Core\Domain\Groups\GroupRepositoryInterface
     */
    private $repository;

    /**
     * @param HHPnet\Core\Domain\Groups\GroupRepositoryInterface $repository
     */
    public function __construct(GroupRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param HHPnet\Core\Application\Services\Groups\GetGroupRequest $request
     *
     * @return HHPnet\Core\Application\Services\Groups\GetGroupResponse
     */
    public function execute(GetGroupRequest $request)
    {
        return new GetGroupResponse($this->repository->getById($request->id()));
    }
}
