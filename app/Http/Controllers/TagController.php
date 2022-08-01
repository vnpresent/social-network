<?php

namespace App\Http\Controllers;

use App\Interfaces\TagRepositoryInterface;
use App\Models\Tag;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{

    /**
     * @var TagRepositoryInterface
     */
    protected $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function index()
    {
        //
    }

    public function search(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'name'=>'string|required'
        ]);
        if ($validate->fails())
            return response()->json(['success' => false, 'data' => $validate->errors()]);
        else
            return response()->json($this->tagRepository->search($request->name));
    }

    public function create()
    {
        //
    }

    public function store(StoreTagRequest $request)
    {
        //
    }

    public function show(Tag $tag)
    {
        //
    }

    public function edit(Tag $tag)
    {
        //
    }

    public function update(UpdateTagRequest $request, Tag $tag)
    {
        //
    }

    public function destroy(Tag $tag)
    {
        //
    }
}
