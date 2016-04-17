<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Domain\Albums;

use HHPnet\Core\Domain\Groups\GroupId;

interface AlbumRepositoryInterface
{
    /**
     * @param Album $group
     *
     * @return HHPnet\Core\Domain\Albums\Album
     */
    public function save(Album $group);

    /**
     * @param Album $group
     *
     * @return bool
     */
    public function remove(Album $group);

    /**
     * @param string $group_id
     *
     * @return HHPnet\Core\Domain\Albums\Album
     */
    public function getById($group_id);

    /**
     * @param HHPnet\Core\Domain\Groups\GroupId $group_id
     * @param string                            $name
     *
     * @return HHPnet\Core\Domain\Albums\Album
     */
    public function getByAlbumByName(GroupId $group_id, $name);
}
