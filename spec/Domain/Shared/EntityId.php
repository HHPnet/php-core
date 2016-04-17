<?php

namespace spec\HHPnet\Core\Domain\Shared;

use PhpSpec\ObjectBehavior;
use Ramsey\Uuid\Uuid;

abstract class EntityId extends ObjectBehavior
{
    public function it_generates_an_id_when_null_is_given()
    {
        $this->getId()->shouldBeValidUUID();
    }

    public function it_generates_an_id_when_given_id_is_invalid()
    {
        $this->beConstructedWith('invalid-uuid');

        $this->getId()->shouldBeValidUUID();
    }

    public function it_set_a_valid_uuid_when_given()
    {
        $uuid = '61eb558e-53ee-477e-95aa-0836c3c1c5ff';
        $this->beConstructedWith($uuid);

        $this->getId()->shouldBeValidUUID();
        $this->getId()->shouldBeEqualUUID($uuid);
    }

    public function getMatchers()
    {
        return [
            'beValidUUID' => function ($uuid) {
                return Uuid::isValid($uuid);
            },
            'beEqualUUID' => function ($uuid, $value) {
                return Uuid::fromString($uuid)->equals(Uuid::fromString($uuid));
            },
        ];
    }
}
