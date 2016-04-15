<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Application\Services\Videos;

use HHPnet\Core\Domain\Videos\VideoRepository;
use HHPnet\Core\Domain\Videos\VideoFactory;

class SaveVideoService
{
    /**
     * @var HHPnet\Core\Domain\Videos\VideoRepository
     */
    private $repository;

    /**
     * @var HHPnet\Core\Domain\Videos\VideoFactory
     */
    private $factory;

    /**
     * @param HHPnet\Core\Domain\Videos\VideoRepository $repository
     * @param HHPnet\Core\Domain\Videos\VideoFactory    $factory
     */
    public function __construct(VideoRepository $repository, VideoFactory $factory)
    {
        $this->repository = $repository;
        $this->factory = $factory;
    }

    /**
     * @param HHPnet\Core\Application\Services\Videos\SaveVideoRequest $request
     *
     * @return HHPnet\Core\Application\Services\Videos\SaveVideoResponse
     */
    public function execute(SaveVideoRequest $request)
    {
        try {
            $this->repository->getByVideoServiceId($request->videoServiceId(), $request->videoService());
            throw new \DomainException('Given video has been registered in our database');
        } catch (\UnexpectedValueException $e) {
        }

        $video = $this->repository->save(
            $this->factory->getVideoEntity(
                null,
                $request->videoServiceId(),
                $request->videoService(),
                $request->title(),
                $request->description()
            )
        );

        return new SaveVideoResponse($video);
    }
}
