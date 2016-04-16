<?php

namespace spec\HHPnet\Core\Application\Services\Videos;

use PhpSpec\ObjectBehavior;
use HHPnet\Core\Domain\Videos\VideoRepositoryInterface;
use HHPnet\Core\Domain\Videos\Video;
use HHPnet\Core\Application\Services\Videos\GetVideoRequest;

class GetVideoServiceSpec extends ObjectBehavior
{
    /**
     * @var HHPnet\Core\Domain\Videos\VideoRepositoryInterface
     */
    private $repository;

    /**
     * @param HHPnet\Core\Domain\Videos\VideoRepositoryInterface $repository
     */
    public function let(VideoRepositoryInterface $repository)
    {
        $this->repository = $repository;

        $this->beConstructedWith($this->repository);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Application\Services\Videos\GetVideoService');
    }

    /**
     * @param HHPnet\Core\Application\Services\Videos\GetVideoRequest $request
     * @param HHPnet\Core\Domain\Videos\Video                         $video
     */
    public function it_is_possible_to_get_an_existing_video(GetVideoRequest $request, Video $video)
    {
        $request->id()->willReturn(1);

        $this->repository->getById(1)->willReturn($video);

        $this->execute($request)->shouldHaveType('HHPnet\Core\Application\Services\Videos\GetVideoResponse');
    }

    /**
     * @param HHPnet\Core\Application\Services\Videos\GetVideoRequest $request
     */
    public function it_is_not_possible_to_get_a_non_existing_video(GetVideoRequest $request)
    {
        $request->id()->willReturn(1);

        $this->repository->getById(1)->willThrow('\UnexpectedValueException');

        $this->shouldThrow('\UnexpectedValueException')->during('execute', array($request));
    }
}
