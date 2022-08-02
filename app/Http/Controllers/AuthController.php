<?php

namespace App\Http\Controllers;

use App\Interfaces\AuthRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $authRepository;

    //
    public function __construct(AuthRepositoryInterface $authrepository)
    {
        $this->authRepository = $authrepository;
        $this->middleware('api',['except' => ['register','login']]);
    }

    public function register(Request $request): JsonResponse
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|min:3|max:50',
            'email' => 'email',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);
        if ($validate->fails())
            return response()->json(['success' => false, 'data' => $validate->errors()]);
        else
            return response()->json($this->authRepository->register($validate->validated()));
    }

    public function login(Request $request): JsonResponse
    {
        $validate = Validator::make($request->all(), [
            'email' => 'email',
            'password' => 'required',
        ]);
        if ($validate->fails())
            return response()->json(['success' => false, 'data' => $validate->errors()]);
        else
            return response()->json($this->authRepository->login($validate->validated()));
    }

    public function logout(): JsonResponse
    {
        return response()->json($this->authRepository->logout());
    }

    public function refresh(): JsonResponse
    {
        return response()->json($this->authRepository->refresh());
    }

    public function me()
    {

    }
}
