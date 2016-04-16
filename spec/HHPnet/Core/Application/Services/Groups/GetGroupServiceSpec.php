<?php

namespace spec\HHPnet\Core\Application\Services\Groups;

use PhpSpec\ObjectBehavior;
use HHPnet\Core\Domain\Groups\GroupRepositoryInterface;
use HHPnet\Core\Domain\Groups\Group;
use HHPnet\Core\Application\Services\Groups\GetGroupRequest;

class GetGroupServiceSpec extends ObjectBehavior
{
    /**
     * @var HHPnet\Core\Domain\Groups\GroupRepositoryInterface
     */
    private $repository;

    /**
     * @param HHPnet\Core\Domain\Groups\GroupRepositoryInterface $repository
     */
    public function let(GroupRepositoryInterface $repository)
    {
        $this->repository = $repository;

        $this->beConstructedWith($this->repository);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Application\Services\Groups\GetGroupService');
    }

    /**
     * @param HHPnet\Core\Application\Services\Groups\GetGroupRequest $request
     * @param HHPnet\Core\Domain\Groups\Group                         $group
     */
    public function it_is_possible_to_get_an_existing_group(GetGroupRequest $request, Group $group)
    {
        $request->id()->willReturn(1);

        $this->repository->getById(1)->willReturn($group);

        $this->execute($request)->shouldHaveType('HHPnet\Core\Application\Services\Groups\GetGroupResponse');
    }

    /**
     * @param HHPnet\Core\Application\Services\Groups\GetGroupRequest $request
     */
    public function it_is_not_possible_to_get_a_non_existing_group(GetGroupRequest $request)
    {
        $request->id()->willReturn(1);

        $this->repository->getById(1)->willThrow('\UnexpectedValueException');

        $this->shouldThrow('\UnexpectedValueException')->during('execute', array($request));
    }
}
