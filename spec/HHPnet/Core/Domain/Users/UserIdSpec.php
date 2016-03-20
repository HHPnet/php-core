<?php

namespace spec\HHPnet\Core\Domain\Users;

use PhpSpec\ObjectBehavior;
use Ramsey\Uuid\Uuid;

class UserIdSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Domain\Users\UserId');
    }

    public function it_generates_an_id_when_null_is_given()
    {
        $this->beConstructedWith(null);

        $id = $this->getId();

        $id->shouldBeString();
        $id->shouldBeValidUUID();

    }

    public function it_generates_an_id_when_given_id_is_invalid()
    {
        $this->beConstructedWith('invalid-uuid');

        $id = $this->getId();

        $id->shouldBeString();
        $id->shouldBeValidUUID();
    }

    public function it_set_a_valid_uuid_when_given()
    {
        $uuid = '61eb558e-53ee-477e-95aa-0836c3c1c5ff';
        $this->beConstructedWith($uuid);

        $this->getId()->shouldBe($uuid);
    }

    public function getMatchers()
    {
        return [
            'beValidUUID' => function ($uuid) {
                return Uuid::isValid($uuid);
            }
        ];
    }
}
