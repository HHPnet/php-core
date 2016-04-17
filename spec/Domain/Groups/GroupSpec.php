<?php

namespace spec\HHPnet\Core\Domain\Groups;

use PhpSpec\ObjectBehavior;
use HHPnet\Core\Domain\Groups\GroupId;
use ArrayIterator;

class GroupSpec extends ObjectBehavior
{
    const GROUP_ID = '61eb558e-53ee-477e-95aa-0836c3c1c5ff';

    /**
     * @param \HHPnet\Core\Domain\Groups\GroupId $group_id
     */
    public function let(GroupId $group_id)
    {
        $group_id->getId()->willReturn(self::GROUP_ID);

        $this->beConstructedWith($group_id, 'group', 'country', 'bio');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Domain\Groups\Group');
    }

    public function it_is_possible_to_get_group_id()
    {
        $this->getId()->shouldBe(self::GROUP_ID);
    }

    public function it_is_possible_to_get_groupname()
    {
        $this->getName()->shouldBe('group');
    }

    public function it_is_possible_to_get_country()
    {
        $this->getCountry()->shouldBe('country');
    }

    public function it_is_possible_to_get_bio()
    {
        $this->getBio()->shouldBe('bio');
    }

    public function it_is_possible_to_convert_group_to_array()
    {
        $this->getIterator()->shouldBeLike(new ArrayIterator([
            'id' => self::GROUP_ID,
            'name' => 'group',
            'country' => 'country',
            'bio' => 'bio',
        ]));
    }
}
