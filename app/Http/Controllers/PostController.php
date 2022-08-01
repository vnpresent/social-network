<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Repositories\PostRepository;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    protected $postRepository;
    protected $postService;

    public function __construct(PostRepository $postRepository,PostService $postService)
    {
        $this->postRepository = $postRepository;
        $this->postService = $postService;
        $this->middleware('auth:api');
    }

    public function index()
    {
        return response()->json($this->postRepository->index());
    }

    public function create(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'title'=>'required|min:5|max:50',
            'content'=>'required|string',
            'tags' => 'required|array|',
            'tags.*' => 'required|string|distinct',
        ]);
        if ($validate->fails())
            return response()->json(['success' => false, 'data' => $validate->errors()]);
        else
            return response()->json($this->postService->create($validate->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return response()->json($this->postRepository->show($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id,Request $request)
    {
        $validate = Validator::make($request->all(),[
            'title'=>'required|min:5|max:50',
            'content'=>'required|string',
            'tags' => 'array',
            'tags.*' => 'string|distinct',
        ]);
        if ($validate->fails())
            return response()->json(['success' => false, 'data' => $validate->errors()]);
        else
            return response()->json($this->postService->update($id,$validate->validated()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
