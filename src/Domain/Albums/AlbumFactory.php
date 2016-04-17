<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Domain\Albums;

use HHPnet\Core\Domain\Groups\GroupId;
use Ramsey\Uuid\UuidFactory;

class AlbumFactory
{
    /**
     * @param string                            $album_id
     * @param HHPnet\Core\Domain\Groups\GroupId $group_id
     * @param string                            $name
     * @param string                            $description
     * @param string                            $release_year
     *
     * @return HHPnet\Core\Domain\Albums\Album
     */
    public function getAlbumEntity($album_id, GroupId $group_id, $name, $description, $release_year)
    {
        return new Album(new AlbumId($album_id, new UuidFactory()), $group_id, $name, $description, $release_year);
    }
}
