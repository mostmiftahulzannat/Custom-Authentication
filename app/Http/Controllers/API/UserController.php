<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterStoreRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    private $checkEmail;
    private $user;
    private $validator;
    public function register(Request $request)
    {
        $this->checkEmail = User::where('email',$request->email)->first();

        if ($this->checkEmail)
        {
            return response()->json([
                'status' => false,
                'error' => 'Your email already exists.'
            ],Response::HTTP_BAD_REQUEST);

        }
        $this->user = User::register($request);
        return response()->json([
            'status' => true,
            'token' => $this->user->createToken('api-token')->plainTextToken,
            'message' => 'User registered successfully.'
        ],Response::HTTP_CREATED);

    }
    public function login(Request $request)
    {
        $this->validator = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required',
        ]);
        if($this->validator->fails())
        {
            return response()->json([
                'status' => false,
                'errors' => $this->validator->errors()
            ],Response::HTTP_BAD_REQUEST);
        }
        $this->checkEmail = User::where('email',$request->email)->first();
        if (empty($this->checkEmail))
        {
            return response()->json([
                'status' => false,
                'error' => 'Your email is not registered.'
            ],Response::HTTP_CONFLICT);

        }

        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            return response()->json([
                'status' => false,
                'error' => 'Our credentails is not matched'
            ]);
        }
        $this->user = User::where('email',$request->email)->first();

        return response()->json([
            'status' => true,
            'token' => $this->user->createToken('api-token')->plainTextToken,
            'message' => 'User logged in successfully.'
        ],Response::HTTP_ACCEPTED);
    }

}
