<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Domain\Albums;

use HHPnet\Core\Domain\Groups\GroupId;
use IteratorAggregate;
use ArrayIterator;

class Album implements IteratorAggregate
{
    /**
     * @var HHPnet\Core\Domain\Albums\AlbumId
     */
    private $id;

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
    private $description;

    /**
     * @var int
     */
    private $release_year;

    /**
     * Class Constructor.
     *
     * @param HHPnet\Core\Domain\Albums\AlbumId $id
     * @param HHPnet\Core\Domain\Groups\GroupId $group_id
     * @param string                            $name
     * @param string                            $description
     * @param int                               $release_year
     */
    public function __construct(AlbumId $id, GroupId $group_id, $name, $description, $release_year)
    {
        $this->id = $id;
        $this->group_id = $group_id;
        $this->name = $name;
        $this->description = $description;
        $this->release_year = $release_year;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id->getId();
    }

    /**
     * @return HHPnet\Core\Domain\Groups\GroupId
     */
    public function getGroupId()
    {
        return $this->group_id;
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getReleaseYear()
    {
        return $this->release_year;
    }

    /**
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator([
            'id' => $this->getId(),
            'group_id' => $this->getGroupId()->getId(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'release_year' => $this->getReleaseYear(),
        ]);
    }
}
