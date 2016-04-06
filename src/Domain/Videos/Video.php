<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core)
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Domain\Videos;

use IteratorAggregate;
use ArrayIterator;

class Video implements IteratorAggregate
{
    /**
     * @var HHPnet\Core\Domain\Videos\VideoId
     */
    private $id;

    /**
     * @var string
     */
    private $video_service_id;

    /**
     * @var string
     */
    private $video_service;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @param HHPnet\Core\Domain\Videos\VideoId $id
     * @param string                            $video_service_id
     * @param string                            $video_service
     * @param string                            $title
     * @param string                            $description
     */
    public function __construct(VideoId $id, $video_service_id, $video_service, $title, $description)
    {
        $this->id = $id;
        $this->video_service_id = $video_service_id;
        $this->video_service = $video_service;
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator([
            'id'                => $this->getId(),
            'video_service_id'  => $this->getVideoServiceId(),
            'video_service'     => $this->getVideoService(),
            'title'             => $this->getTitle(),
            'description'       => $this->getDescription(),
        ]);
    }

    /**
     * @return HHPnet\Core\Domain\Videos\VideoId
     */
    public function getId()
    {
        return $this->id->getId();
    }

    /**
     * @return string
     */
    public function getVideoServiceId()
    {
        return $this->video_service_id;
    }

    /**
     * @return string
     */
    public function getVideoService()
    {
        return $this->video_service;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
