<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Domain\Groups;

use IteratorAggregate;
use ArrayIterator;

class Group implements IteratorAggregate
{
    /**
     * @var HHPnet\Core\Domain\Groups\GroupId
     */
    private $group_id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $bio;

    /**
     * @param HHPnet\Core\Domain\Groups\GroupId $group_id
     * @param string                            $name
     * @param string                            $country
     * @param string                            $bio
     */
    public function __construct(GroupId $group_id, $name, $country, $bio)
    {
        $this->group_id = $group_id;
        $this->name = $name;
        $this->country = $country;
        $this->bio = $bio;
    }

    /**
     * @return HHPnet\Core\Domain\Groups\GroupId
     */
    public function getId()
    {
        return $this->group_id->getId();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator([
            'id' => $this->getId(),
            'name' => $this->getName(),
            'country' => $this->getCountry(),
            'bio' => $this->getBio(),
        ]);
    }
}
