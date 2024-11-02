<?php

/**
 * Этот класс используется для форматирования данных перед их отправкой в API-ответах.
 */

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;



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

            'user_avatar' => new User_avatarResource($this->user_avatar),
            // используется, потому что связь один к одному.
            // В этом случае user_avatar возвращает только одну запись,
            // поэтому мы просто оборачиваем её в User_avatarResource, чтобы применить нужное форматирование.

            'user_gallery' => User_gallerieResource::collection($this->user_gallery),
            // используется для связи один ко многим. Здесь user_gallery возвращает коллекцию (несколько записей),
            // и метод User_gallerieResource::collection() позволяет применить User_gallerieResource ко всем элементам этой коллекции.

        ];
    }
}
