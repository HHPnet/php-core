<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Infrastructure\MongoDB;

use HHPnet\Core\Domain\Albums\AlbumRepositoryInterface;
use HHPnet\Core\Domain\Albums\Album;
use HHPnet\Core\Domain\Albums\AlbumFactory;
use HHPnet\Core\Domain\Groups\GroupId;
use MongoDB\Database;
use DomainException;

class AlbumRepository implements AlbumRepositoryInterface
{
    /**
     * @var MongoDB\Collection
     */
    private $collection;

    /**
     * @var HHPnet\Core\Domain\Albums\AlbumFactory
     */
    private $factory;

    /**
     * @param MongoDB\Database                       $mongo_db
     * @param HHPnet\Core\Domain\Albums\AlbumFactory $factory
     */
    public function __construct(Database $mongo_db, AlbumFactory $factory)
    {
        $this->collection = $mongo_db->selectCollection('albums');
        $this->factory = $factory;
    }

    /**
     * @param Album $album
     *
     * @return HHPnet\Core\Domain\Albums\Album
     */
    public function save(Album $album)
    {
        $album_data = iterator_to_array($album);
        $album_data['_id'] = $album_data['id'];
        unset($album_data['id']);

        $result = $this->collection->updateOne(['_id' => $album_data['_id']], $album_data, ['upsert' => true]);

        if (1 !== $result->getUpsertedCount()) {
            throw new DomainException('Album data could not be saved into database');
        }

        return $album;
    }

    /**
     * @param Album $album
     *
     * @return bool
     */
    public function remove(Album $album)
    {
        return 1 === $this->collection->deleteOne(['_id' => $album->getId()])->getDeletedCount();
    }

    /**
     * @param string $album_id
     *
     * @return HHPnet\Core\Domain\Albums\Album
     */
    public function getById($album_id)
    {
        $album = $this->collection->findOne(['_id' => $album_id]);

        return $this->getAlbumInstance($album);
    }

    /**
     * @param HHPnet\Core\Domain\Groups\GroupId $group_id
     * @param string                            $name
     *
     * @return HHPnet\Core\Domain\Albums\Album
     */
    public function getAlbumByName(GroupId $group_id, $name)
    {
        $album = $this->collection->findOne(['group_id' => $group_id, 'name' => $name]);

        return $this->getAlbumInstance($album);
    }

    private function getAlbumInstance($album_data)
    {
        if (is_null($album_data)) {
            throw new \UnexpectedValueException('Album not found in database');
        }

        return $this->factory->getAlbumEntity(
            $album_data['_id'],
            new GroupId($album_data['group_id']),
            $album_data['name'],
            $album_data['description'],
            $album_data['release_year']
        );
    }
}
