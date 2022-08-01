<?php
namespace App\Services;


use App\Interfaces\PostRepositoryInterface;
use App\Interfaces\TagRepositoryInterface;

class PostService
{
    protected $postRepository;
    protected $tagRepository;

    public function __construct(PostRepositoryInterface $postRepository, TagRepositoryInterface $tagRepository)
    {
        $this->postRepository = $postRepository;
        $this->tagRepository = $tagRepository;
    }

    public function create(array $data)
    {
        $names = [];
        if (isset($data['tags']))
            $names = $this->getTags($data['tags']); // lưu các tag mới vào csdl
        $post = $this->postRepository->create($data); // lưu post
        $tagIds = $this->tagRepository->findByName($names)->pluck('id')->toArray();
        $post->tags()->attach($tagIds);
        return $post;
    }

    public function update($id,array $data)
    {
        $names = [];
        if (isset($data['tags']))
            $names = $this->getTags($data['tags']); // lưu các tag mới vào csdl
        $post = $this->postRepository->update($id,$data); // lưu post
        $tagIds = $this->tagRepository->findByName($names)->pluck('id')->toArray();
        $post->tags()->sync($tagIds);
        return $post;
    }

    public function getTags($tags1)
    {
        $names = $tags1;
        $tags = $this->tagRepository->findByName($names); // lấy các tag dựa vào name
        $duplicateNames = [];
        for ($i = 0; $i < count($names); $i++) { // lấy các tag đã tồn tại trong csdl
            foreach ($tags as $tag) {
                if ($names[$i] === $tag->name) {
                    $duplicateNames[] = $names[$i];
                }
            }
        }
        $newNames = array_diff($names, $duplicateNames); // loại bỏ các tag đã tồn tại
        $this->tagRepository->create($newNames);
        return $names;
    }

}

