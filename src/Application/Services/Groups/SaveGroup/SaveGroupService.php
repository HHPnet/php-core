<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Application\Services\Groups\SaveGroup;

use HHPnet\Core\Domain\Groups\GroupRepositoryInterface;
use HHPnet\Core\Domain\Groups\GroupFactory;

class SaveGroupService
{
    /**
     * @var HHPnet\Core\Domain\Groups\GroupRepositoryInterface
     */
    private $repository;

    /**
     * @var HHPnet\Core\Domain\Groups\GroupFactory
     */
    private $factory;

    /**
     * @param HHPnet\Core\Domain\Groups\GroupRepositoryInterface $repository
     * @param HHPnet\Core\Domain\Groups\GroupFactory             $factory
     */
    public function __construct(GroupRepositoryInterface $repository, GroupFactory $factory)
    {
        $this->repository = $repository;
        $this->factory = $factory;
    }

    /**
     * @param HHPnet\Core\Application\Services\Groups\SaveGroupRequest $request
     *
     * @return HHPnet\Core\Application\Services\Groups\SaveGroupResponse
     */
    public function execute(SaveGroupRequest $request)
    {
        try {
            $this->repository->getByGroupByName($request->name());
            throw new \DomainException('Given group has been registered in our database');
        } catch (\UnexpectedValueException $e) {
        }

        $group = $this->repository->save(
            $this->factory->getGroupEntity(
                null,
                $request->name(),
                $request->country(),
                $request->bio()
            )
        );

        return new SaveGroupResponse($group);
    }
}
