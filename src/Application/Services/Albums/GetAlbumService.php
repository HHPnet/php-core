<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Application\Services\Albums;

use HHPnet\Core\Domain\Albums\AlbumRepositoryInterface;

class GetAlbumService
{
    /**
     * @var HHPnet\Core\Domain\Albums\AlbumRepositoryInterface
     */
    private $repository;

    /**
     * @param HHPnet\Core\Domain\Albums\AlbumRepositoryInterface $repository
     */
    public function __construct(AlbumRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param HHPnet\Core\Application\Services\Albums\GetAlbumRequest $request
     *
     * @return HHPnet\Core\Application\Services\Albums\GetAlbumResponse
     */
    public function execute(GetAlbumRequest $request)
    {
        return new GetAlbumResponse($this->repository->getById($request->albumId()));
    }
}
