<?php

namespace spec\HHPnet\Core\Application\Services\Groups;

use PhpSpec\ObjectBehavior;
use HHPnet\Core\Domain\Groups\GroupRepository;
use HHPnet\Core\Domain\Groups\GroupFactory;
use HHPnet\Core\Domain\Groups\Group;
use HHPnet\Core\Application\Services\Groups\SaveGroupRequest;

class SaveGroupServiceSpec extends ObjectBehavior
{
    /**
     * @var HHPnet\Core\Domain\Groups\GroupRepository
     */
    private $repository;

    /**
     * @var HHPnet\Core\Domain\Groups\GroupFactory
     */
    private $factory;

    /**
     * @param HHPnet\Core\Domain\Groups\GroupRepository $repository
     * @param HHPnet\Core\Domain\Groups\GroupFactory    $factory
     */
    public function let(GroupRepository $repository, GroupFactory $factory)
    {
        $this->factory = $factory;
        $this->repository = $repository;

        $this->beConstructedWith($this->repository, $this->factory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Application\Services\Groups\SaveGroupService');
    }

    /**
     * @param HHPnet\Core\Application\Services\Groups\SaveGroupRequest $request
     * @param HHPnet\Core\Domain\Groups\Group                          $group
     */
    public function it_is_possible_to_save_a_new_group(SaveGroupRequest $request, Group $group)
    {
        $request->name()->willReturn('name');
        $request->country()->willReturn('country');
        $request->bio()->willReturn('bio');

        $this->factory->getGroupEntity(null, 'name', 'country', 'bio')->willReturn($group);

        $this->repository->getByGroupByName('name')->willThrow('\UnexpectedValueException');
        $this->repository->save($group)->willReturn($group);

        $this->execute($request)->shouldHaveType('HHPnet\Core\Application\Services\Groups\SaveGroupResponse');
    }

    /**
     * @param HHPnet\Core\Application\Services\Groups\SaveGroupRequest $request
     */
    public function it_is_not_possible_to_register_a_given_group_twice(SaveGroupRequest $request)
    {
        $request->name()->willReturn('name');
        $request->country()->willReturn('country');
        $request->bio()->willReturn('bio');

        $this->factory->getGroupEntity(null, 'name', 'country', 'bio')->willReturn(true);

        $this->shouldThrow('\DomainException')->during('execute', array($request));
    }
}
