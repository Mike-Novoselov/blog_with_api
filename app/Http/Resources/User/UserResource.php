<?php

/**
 * Этот класс используется для форматирования данных перед их отправкой в API-ответах.
 */

namespace App\Http\Resources\User;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\UserAvatarResource;     // Импорт UserAvatarResource
use App\Http\Resources\GalleryResource;             // Импорт GalleryResource


class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this -> id,
            'name' => $this -> name,
            'email' => $this -> email,
//            'password' => $this -> password,
//            'created_at' => $this -> created_at,

//            'user_avatar' => $this->user_avatar,
//            'user_gallery' => $this->user_gallery,

            'UserAvatar' => new UserAvatarResource($this->userAvatar),
            // используется, потому что связь один к одному.
            // В этом случае user_avatar возвращает только одну запись,
            // поэтому мы просто оборачиваем её в User_avatarResource, чтобы применить нужное форматирование.

            'Gallery' => GalleryResource::collection($this->gallery),
            // используется для связи один ко многим. Здесь user_gallery возвращает коллекцию (несколько записей),
            // и метод User_gallerieResource::collection() позволяет применить User_gallerieResource ко всем элементам этой коллекции.

        ];
    }
}
