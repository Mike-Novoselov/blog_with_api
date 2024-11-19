<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        return UserResource::collection(user::all()); //** почему отрабатывает???
        return UserResource::collection(User::with('userAvatar', 'gallery')->get());

    }

    /**
     * Store a newly created resource in storage.
     * http://127.0.0.1:8000/api/user
     * body
     * raw -> JSON
     * {
     * "name": "John Doe",
     * "email": "johndoe@example.com",
     * "password": "password123"
     * }
     */
    public function store(UserStoreRequest $request)
    {
        // Создаем пользователя
        $created_user = User::create($request->validated());

        // Добавляем аватарку по умолчанию
        $defaultAvatarPath = 'avatars/default_avatar.png'; // Путь к аватарке по умолчанию
        $created_user->userAvatar()->create([
            'avatar_path' => $defaultAvatarPath,
        ]);

        return new UserResource($created_user);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new UserResource(user::with('userAvatar', 'gallery')->findOrFail($id));
//        return new UserResource(user::with('user_avatar', 'gallerie')->findOrFail($id));

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

    /** метод для обновления аватарки
     * /api/user/{id}/avatar
     * post
     * avatar type File
     * value
     */

    public function updateAvatar(Request $request, User $user)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Проверяем, что файл - изображение
        ]);

        // Загружаем новый файл
        $newAvatarPath = $request->file('avatar')->store('avatars');

        // Удаляем старую аватарку, если она не является аватаркой по умолчанию
        if ($user->userAvatar && $user->userAvatar->avatar_path !== 'avatars/default_avatar.png') {
            Storage::delete($user->userAvatar->avatar_path);
        }

        // Обновляем аватарку пользователя
        $user->userAvatar()->updateOrCreate([], [
            'avatar_path' => $newAvatarPath,
        ]);

        return response()->json(['message' => 'Avatar updated successfully'], 200);
    }


}
