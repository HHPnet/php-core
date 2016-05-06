<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Application\Services\Videos\SaveVideo;

class SaveVideoRequest
{
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
     * @param string $video_service_id
     * @param string $video_service
     * @param string $title
     * @param string $description
     */
    public function __construct($video_service_id, $video_service, $title, $description)
    {
        $this->video_service_id = $video_service_id;
        $this->video_service = $video_service;
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function videoServiceId()
    {
        return $this->video_service_id;
    }

    /**
     * @return string
     */
    public function videoService()
    {
        return $this->video_service;
    }

    /**
     * @return string
     */
    public function title()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function description()
    {
        return $this->description;
    }
}
