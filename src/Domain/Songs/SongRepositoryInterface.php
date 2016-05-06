<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Domain\Songs;

use HHPnet\Core\Domain\Albums\AlbumId;

interface SongRepositoryInterface
{
    /**
     * @param Song $song
     *
     * @return HHPnet\Core\Domain\Songs\Song
     */
    public function save(Song $song);

    /**
     * @param Song $song
     *
     * @return bool
     */
    public function remove(Song $song);

    /**
     * @param string $song_id
     *
     * @return HHPnet\Core\Domain\Songs\Song
     */
    public function getById($song_id);

    /**
     * @param HHPnet\Core\Domain\Albums\AlbumId $song_id
     * @param string                            $name
     *
     * @return HHPnet\Core\Domain\Songs\Song
     */
    public function getBySongByName(AlbumId $album_id, $name);

    /**
     * @return SongId
     */
    public function nextIdentity();
}
