<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserResource;
use App\Models\user;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        return UserResource::collection(user::all()); //** почему отрабатывает???
        return UserResource::collection(user::with('user_avatar', 'user_gallery')->get());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        $created_user = user::create($request->validated());
        return new UserResource($created_user);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new UserResource(user::with('user_avatar', 'user_gallery')->findOrFail($id));
//        return new UserResource(user::with('user_avatar', 'user_gallery')->findOrFail($id));

        // findOrFail - если введенный id не найден выдаст страничку 404
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserStoreRequest $request, user $user)
    {
        $user->update($request->validated());
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user $user)
    {
        $user->delete();

        return response(null, 204);
    }
}
