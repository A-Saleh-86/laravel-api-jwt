<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    /**

    * @OA\Post(

    *     path="/api/login",

    *     summary="Login",

    *     tags={"Users"},

    *     @OA\RequestBody(

    *         @OA\JsonContent(

    *             type="object",

    *             @OA\Property(property="email", type="email"),

    *             @OA\Property(property="password", type="string")
    *         )

    *     ),

    *     @OA\Response(response=201, description="Product created successfully")

    * )

    */

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
                'status' => 'success',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);

    }

    /**

     * @OA\Post(

     *     path="/api/register",

     *     summary="Register",

     *     tags={"Users"},

     *     @OA\RequestBody(

     *         @OA\JsonContent(

     *             type="object",

     *             @OA\Property(property="name", type="string"),

     *             @OA\Property(property="email", type="email"),

     *             @OA\Property(property="password", type="string"),

     *             @OA\Property(property="role", type="string"),

     *             @OA\Property(property="address", type="string"),
     *         )

     *     ),

     *     @OA\Response(response=201, description="Product created successfully")

     * )

     */

    public function register(Request $request){

        // Normalize the role to lowercase before validation
        $request->merge([
            'role' => strtolower($request->role),
        ]);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:super admin,user',
            'address' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
    
            // Check for specific email error
            if ($errors->has('email')) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Email already in use',
                    'errors' => $errors->all()
                ], 422); 
            }
    
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $errors->all()
            ], 422); 
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role'=> $request->role,
            'address'=> $request->address
        ]);

        $token = Auth::login($user);
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    /**

     * @OA\Post(

     *     path="/api/logout",

     *     summary="Logout",

     *     tags={"Users"},

     *     @OA\RequestBody(

     *         @OA\JsonContent(

     *             type="object",

     *             @OA\Property(property="token", type="string")
     *         )

     *     ),

     *     @OA\Response(response=201, description="Product created successfully")

     * )

     */

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }



}
