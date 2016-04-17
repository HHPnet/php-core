<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Domain\Shared;

use Ramsey\Uuid\Uuid;

abstract class EntityId
{
    /**
     * @var string
     */
    protected $entity_id;

    /**
     * @param string $entity_id
     */
    public function __construct($entity_id = null)
    {
        if (is_null($entity_id) || false === Uuid::isValid($entity_id)) {
            $entity_id = Uuid::uuid4();
        }

        $this->entity_id = $entity_id;
    }

    /**
     * @return Ramsey\Uuid\Uuid
     */
    public function getId()
    {
        return $this->entity_id;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getId();
    }
}
