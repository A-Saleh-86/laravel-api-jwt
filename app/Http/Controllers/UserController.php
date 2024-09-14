<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @OA\Get(
     *     path="/api/users",
     *     summary="Get all users",
     *     tags={"Users"},
     *     security={{"bearerAuth":{}}}, 
     *     @OA\Response(
     *         response=200,
     *         description="Successful response"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */


    public function index()
    {
        $users = User::all();
        return response()->json([
            'status' => 'success',
            'user' => $users,
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/user/{id}",
     *     summary="Get a user by ID",
     *     tags={"Users"},
     *     security={{"bearerAuth":{}}}, 
     *     @OA\Parameter(
     *         description="User ID",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Successful response"),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=404, description="Product not found")
     * )
     */

    public function show($id)
    {
        $user = User::find($id);
        return response()->json([
            'status' => 'success',
            'user' => $user,
        ]);
    }

    /**

     * @OA\Put(

     *     path="/api/user/{id}",

     *     summary="Update a user",

     *     tags={"Users"},
     *     security={{"bearerAuth":{}}}, 
     *     @OA\Parameter(

     *         description="User ID",

     *         in="path",

     *         name="id",

     *         required=true,

     *         @OA\Schema(type="integer")

     *     ),

     *     @OA\RequestBody(

     *         @OA\JsonContent(

     *             type="object",

     *             @OA\Property(property="name", type="string"),

     *             @OA\Property(property="role", type="string"),

     *             @OA\Property(property="address", type="integer")

     *         )

     *     ),

     *     @OA\Response(response=200, description="User updated successfully")

     * )

     */

    public function update(Request $request, $id)
    {

        // Normalize the role to lowercase before validation
        $request->merge([
            'role' => strtolower($request->role),
        ]);

        $request->validate([
            'name' => 'required|string|max:255',
            'role'=>'required|required|in:super admin,user',
            'address'=>'required'
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->role = $request->role;
        $user->address = $request->address;
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'User updated successfully',
            'user' => $user,
        ]);

       
    }

    /**

     * @OA\Delete(

     *     path="/api/user/{id}",

     *     summary="Delete a User",

     *     tags={"Users"},
     *     security={{"bearerAuth":{}}}, 
     *     @OA\Parameter(

     *         description="User ID",

     *         in="path",

     *         name="id",

     *         required=true,

     *         @OA\Schema(type="integer")

     *     ),

     *     @OA\Response(response=200, description="Product deleted successfully")

     * )

     */

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User deleted successfully',
            'user' => $user,
        ]);
    }
}

