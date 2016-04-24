<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Infrastructure\MongoDB;

use HHPnet\Core\Domain\Songs\SongRepositoryInterface;
use HHPnet\Core\Domain\Songs\Song;
use HHPnet\Core\Domain\Songs\SongId;
use HHPnet\Core\Domain\Songs\SongFactory;
use HHPnet\Core\Domain\Albums\AlbumId;
use MongoDB\Database;
use DomainException;

class SongRepository implements SongRepositoryInterface
{
    /**
     * @var MongoDB\Collection
     */
    private $collection;

    /**
     * @var HHPnet\Core\Domain\Songs\SongFactory
     */
    private $factory;

    /**
     * @param MongoDB\Database                     $mongo_db
     * @param HHPnet\Core\Domain\Songs\SongFactory $factory
     */
    public function __construct(Database $mongo_db, SongFactory $factory)
    {
        $this->collection = $mongo_db->selectCollection('songs');
        $this->factory = $factory;
    }

    /**
     * @param Song $song
     *
     * @return HHPnet\Core\Domain\Songs\Song
     */
    public function save(Song $song)
    {
        $song_data = iterator_to_array($song);
        $song_data['_id'] = $song_data['id'];
        unset($song_data['id']);

        $result = $this->collection->updateOne(['_id' => $song_data['_id']], $song_data, ['upsert' => true]);

        if (1 !== $result->getUpsertedCount()) {
            throw new DomainException('Song data could not be saved into database');
        }

        return $song;
    }

    /**
     * @param Song $song
     *
     * @return bool
     */
    public function remove(Song $song)
    {
        return 1 === $this->collection->deleteOne(['_id' => $song->getId()])->getDeletedCount();
    }

    /**
     * @param string $song_id
     *
     * @return HHPnet\Core\Domain\Songs\Song
     */
    public function getById($song_id)
    {
        $song = $this->collection->findOne(['_id' => $song_id]);

        return $this->getSongInstance($song);
    }

    /**
     * @param HHPnet\Core\Domain\Albums\AlbumId $song_id
     * @param string                            $name
     *
     * @return HHPnet\Core\Domain\Songs\Song
     */
    public function getBySongByName(AlbumId $album_id, $name)
    {
        $song = $this->collection->findOne(['album_id' => $album_id, 'name' => $name]);

        return $this->getSongInstance($song);
    }

    /**
     * @return SongId
     */
    public function nextIdentity()
    {
        return new SongId();
    }

    private function getSongInstance($song_data)
    {
        if (is_null($song_data)) {
            throw new \UnexpectedValueException('Song not found in database');
        }

        return $this->factory->getSongEntity(
            $song_data['_id'],
            new AlbumId($song_data['album_id']),
            $song_data['name'],
            $song_data['type'],
            $song_data['path']
        );
    }
}
