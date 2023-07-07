<?php
declare(strict_types=1);
namespace App\Services\Posts;

use App\Models\Image;
use App\Models\Post;
use App\Models\Tag;
use App\Repositries\Posts\ImageRepositoryInterface;
use App\Repositries\Posts\PostRepositoryInterface;
use App\Repositries\Posts\PostTagRepositoryInterface;
use App\Services\StoreFileServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

readonly class CreatePostService implements CreatePostServiceInterface
{
    public function __construct(
        private StoreFileServiceInterface $storeFileService,
        private PostRepositoryInterface $postRepository,
        private ImageRepositoryInterface $imageRepository,
        private PostTagRepositoryInterface $postTagRepository,
    ){}

    /**
     * @param Request $request
     * @return void
     * @throws ValidationException
     * @throws \InvalidArgumentException
     */
    public function run(Request $request): void
    {
        $thumnail_image = $request->file('image')[0];
        $images = array_slice($request->file('image'), 1);

        /** @throws  \InvalidArgumentException */
        $thumnail_image_url = $this->storeFileService->run($thumnail_image, directoryKey: 'post_thumnail_image');
        $image_urls = array_map(fn ($image) => $this->storeFileService->run($image, directoryKey: 'post_image'), $images);

        $post = Post::buildValidatedPostEntity(
            title: $request['title'],
            content: $request['content'],
            thumnail_image_url: $thumnail_image_url,
            user_id: Auth::id(),
        );

        try {
            DB::beginTransaction();
            $createdPostId = $this->postRepository->create($post);
            $this->executeInsertIntoImageTable($createdPostId, $image_urls);
            $this->executeInsertIntoPostTagTable($createdPostId, $request['tag']);
            DB::commit();
        } catch (ValidationException $e){
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * @param int $createdPostId
     * @param array $image_urls
     * @return bool
     * @throws \Illuminate\Validation\ValidationException
     */
    private function executeInsertIntoImageTable(int $createdPostId, array $image_urls): bool
    {
        $images = array_map(fn ($image) =>
            Image::buildValidatedImageEntity(
                image_url: $image,
                post_id: $createdPostId,
        ), $image_urls);

        $this->imageRepository->createByPost($images);

        return true;
    }

    /**
     * @param $createdPostId
     * @param $inputTag
     * @return bool
     * @throws \Illuminate\Validation\ValidationException
     */
    private function executeInsertIntoPostTagTable($createdPostId, $inputTag): bool
    {
        $tags = array_map(fn ($tag) =>
            Tag::buildValidatedTag($tag)
        , $inputTag);

        $tagIds = array_map(fn ($tag) =>
            Tag::where('name', $tag->name)->first()->id
        ,$tags);

        $this->postTagRepository->create($createdPostId,$tagIds);

        return true;
    }
}
