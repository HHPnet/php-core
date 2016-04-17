<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Domain\Songs;

use HHPnet\Core\Domain\Albums\AlbumId;
use IteratorAggregate;
use ArrayIterator;

class Song implements IteratorAggregate
{
    /**
     * @var HHPnet\Core\Domain\Songs\SongId
     */
    private $song_id;

    /**
     * @var HHPnet\Core\Domain\Albums\AlbumId
     */
    private $album_id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $path;

    /**
     * @param HHPnet\Core\Domain\Songs\SongId   $song_id
     * @param HHPnet\Core\Domain\Albums\AlbumId $album_id
     * @param string                            $name
     * @param string                            $type
     * @param string                            $path
     */
    public function __construct(SongId $song_id, AlbumId $album_id, $name, $type, $path)
    {
        $this->song_id = $song_id;
        $this->album_id = $album_id;
        $this->name = $name;
        $this->type = $type;
        $this->path = $path;
    }

    /**
     * @return HHPnet\Core\Domain\Songs\SongId
     */
    public function getId()
    {
        return $this->song_id;
    }

    /**
     * @return HHPnet\Core\Domain\Albums\AlbumId
     */
    public function getAlbumId()
    {
        return $this->album_id;
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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator([
            'id' => $this->getId(),
            'album_id' => $this->getAlbumId(),
            'name' => $this->getName(),
            'type' => $this->getType(),
            'path' => $this->getPath(),
        ]);
    }
}
