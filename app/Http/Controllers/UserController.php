<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('auth:api',['except' => ['register','login']]);
    }

    public function index(): JsonResponse
    {
        return response()->json($this->userRepository->index());
    }

    //
    public function me(): JsonResponse
    {
        return response()->json($this->userRepository->me());
    }

    public function update(Request $request):JsonResponse
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|min:3|max:50',
        ]);
        if ($validate->fails())
            return response()->json(['success' => false, 'data' => $validate->errors()]);
        else
            return response()->json($this->userRepository->update($request->name));
    }
}
