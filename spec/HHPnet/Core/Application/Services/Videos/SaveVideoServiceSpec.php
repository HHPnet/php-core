<?php

namespace spec\HHPnet\Core\Application\Services\Videos;

use PhpSpec\ObjectBehavior;
use HHPnet\Core\Domain\Videos\VideoRepositoryInterface;
use HHPnet\Core\Domain\Videos\VideoFactory;
use HHPnet\Core\Domain\Videos\Video;
use HHPnet\Core\Application\Services\Videos\SaveVideoRequest;

class SaveVideoServiceSpec extends ObjectBehavior
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
     * @param HHPnet\Core\Domain\Videos\VideoRepositoryInterface $repository
     * @param HHPnet\Core\Domain\Videos\VideoFactory             $factory
     */
    public function let(VideoRepositoryInterface $repository, VideoFactory $factory)
    {
        $this->factory = $factory;
        $this->repository = $repository;

        $this->beConstructedWith($this->repository, $this->factory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Application\Services\Videos\SaveVideoService');
    }

    /**
     * @param HHPnet\Core\Application\Services\Videos\SaveVideoRequest $request
     * @param HHPnet\Core\Domain\Videos\Video                          $video
     */
    public function it_is_possible_to_save_a_new_video(SaveVideoRequest $request, Video $video)
    {
        $request->videoServiceId()->willReturn('video_service_id');
        $request->videoService()->willReturn('video_service');
        $request->title()->willReturn('title');
        $request->description()->willReturn('description');

        $this->factory->getVideoEntity(null, 'video_service_id', 'video_service', 'title', 'description')->willReturn($video);

        $this->repository->getByVideoServiceId('video_service_id', 'video_service')->willThrow('\UnexpectedValueException');
        $this->repository->save($video)->willReturn($video);

        $this->execute($request)->shouldHaveType('HHPnet\Core\Application\Services\Videos\SaveVideoResponse');
    }

    /**
     * @param HHPnet\Core\Application\Services\Videos\SaveVideoRequest $request
     */
    public function it_is_not_possible_to_register_a_given_video_twice(SaveVideoRequest $request)
    {
        $request->videoServiceId()->willReturn('video_service_id');
        $request->videoService()->willReturn('video_service');
        $request->title()->willReturn('title');
        $request->description()->willReturn('description');

        $this->factory->getVideoEntity(null, 'video_service_id', 'video_service', 'title', 'description')->willReturn(true);

        $this->shouldThrow('\DomainException')->during('execute', array($request));
    }
}
