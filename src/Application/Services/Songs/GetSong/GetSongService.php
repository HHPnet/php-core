<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Application\Services\Songs\GetSong;

use HHPnet\Core\Domain\Songs\SongRepositoryInterface;

class GetSongService
{
    /**
     * @var HHPnet\Core\Domain\Songs\SongRepositoryInterface
     */
    private $repository;

    /**
     * @param HHPnet\Core\Domain\Songs\SongRepositoryInterface $repository
     */
    public function __construct(SongRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param HHPnet\Core\Application\Services\Songs\GetSongRequest $request
     *
     * @return HHPnet\Core\Application\Services\Songs\GetSongResponse
     */
    public function execute(GetSongRequest $request)
    {
        return new GetSongResponse($this->repository->getById($request->songId()));
    }
}
