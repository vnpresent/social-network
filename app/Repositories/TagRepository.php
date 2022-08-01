<?php


namespace App\Repositories;

use App\Interfaces\TagRepositoryInterface;
use App\Models\Tag;

class  TagRepository implements TagRepositoryInterface
{
    public function create(array $values)
    {
        $data=[];
        foreach($values as $value)
        {
            $data[] = [
                'name'=>$value,
            ];
        }
        return Tag::insert($data);
    }

    public function findByName(array $names)
    {
        return Tag::whereIn('name', $names)->get();
    }

    public function search($tag)
    {
        return Tag::where('name', $tag)->orWhere('name', 'like', '%' . $tag . '%')->get();
    }

}
