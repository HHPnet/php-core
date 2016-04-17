<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Domain\Songs;

use HHPnet\Core\Domain\Albums\AlbumId;

class SongFactory
{
    /**
     * @param string                            $song_id
     * @param HHPnet\Core\Domain\Albums\AlbumId $album_id
     * @param string                            $name
     * @param string                            $type
     * @param string                            $path
     *
     * @return HHPnet\Core\Domain\Songs\Song
     */
    public function getSongEntity($song_id, AlbumId $album_id, $name, $type, $path)
    {
        return new Song(new SongId($song_id), $album_id, $name, $type, $path);
    }
}
