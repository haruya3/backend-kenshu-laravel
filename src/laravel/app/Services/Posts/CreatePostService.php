<?php
declare(strict_types=1);
namespace App\Services\Posts;

use App\Repositries\Posts\ImageRepositoryInterface;
use App\Repositries\Posts\PostRepositoryInterface;
use App\Services\StoreFileServiceInterface;
use Illuminate\Http\Request;

readonly class CreatePostService implements CreatePostServiceInterface
{
    public function __construct(
        private StoreFileServiceInterface $storeFileService,
        private PostRepositoryInterface $postRepository,
        private ImageRepositoryInterface $imageRepository
    ){}

    /**
     * @param Request $request
     * @return void
     * @throws \InvalidArgumentException
     */
    public function run(Request $request): void
    {
        $thumnail_image = $request->file('image')[0];
        $images = array_slice($request->file('image'), 1);

        /** @throws  \InvalidArgumentException */
        $thumnail_image_url = $this->storeFileService->run($thumnail_image, directoryKey: 'post_thumnail_image');
        $image_urls = array_map(fn ($image) => $this->storeFileService->run($image, directoryKey: 'post_image'), $images);

        //****トランザクションを貼る****
        $this->postRepository->create();
        $this->imageRepository->createByPost();
        //tagは中間テーブルを使うがそのレポジトリ層でやるか？？？
    }
}
