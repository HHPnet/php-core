<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core)
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Infrastructure\MongoDB;

use HHPnet\Core\Domain\Videos\VideoRepository as VideoRepositoryInterface;
use HHPnet\Core\Domain\Videos\Video;
use HHPnet\Core\Domain\Videos\VideoFactory;
use MongoDB\Database;
use DomainException;

class VideoRepository implements VideoRepositoryInterface
{
    /**
     * @var  MongoDB\Collection
     */
    private $collection;

    /**
     * @var HHPnet\Core\Domain\Videos\VideoFactory
     */
    private $factory;

    /**
     * @param MongoDB\Database                       $mongo_db
     * @param HHPnet\Core\Domain\Videos\VideoFactory $factory
     */
    public function __construct(Database $mongo_db, VideoFactory $factory)
    {
        $this->collection = $mongo_db->selectCollection('videos');
        $this->factory = $factory;
    }

    /**
     * @param  Video                           $video
     * @return HHPnet\Core\Domain\Videos\Video
     */
    public function save(Video $video)
    {
        $video_data = iterator_to_array($video);
        $video_data['_id'] = $video_data['id'];
        unset($video_data['id']);

        $result = $this->collection->updateOne(['_id' => $video_data['_id']], $video_data, ['upsert' => true]);

        if (1 !== $result->getUpsertedCount()) {
            throw new DomainException('Video data could not be saved into database');
        }

        return $video;
    }

    /**
     * @param  Video   $video
     * @return boolean
     */
    public function remove(Video $video)
    {
        return 1 === $this->collection->deleteOne(['_id'  => $video->getId()])->getDeletedCount();
    }

    /**
     * @param  string                          $video_id
     * @return HHPnet\Core\Domain\Videos\Video
     */
    public function getById($video_id)
    {
        $video = $this->collection->findOne(['_id'   => $video_id]);

        return $this->getVideoInstance($video);
    }

    /**
     * @param  string                          $video_service_id
     * @param  string                          $video_service
     * @return HHPnet\Core\Domain\Videos\Video
     */
    public function getByVideoServiceId($video_service_id, $video_service)
    {
        $video = $this->collection->findOne([
            'video_service_id'      => $video_service_id,
            'video_service'         => $video_service
        ]);

        return $this->getVideoInstance($video);
    }

    private function getVideoInstance($video_data)
    {
        if (is_null($video_data)) {
            throw new \UnexpectedValueException('Video not found in database');
        }

        return $this->factory->getVideoEntity(
            $video_data['_id'],
            $video_data['video_service_id'],
            $video_data['video_service'],
            $video_data['title'],
            $video_data['description']
        );
    }
}
