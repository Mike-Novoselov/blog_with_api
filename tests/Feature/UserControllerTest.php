<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Тестирование метода index().
     *
     * @return void
     */
    public function test_index_returns_users_with_name_field()
    {
        // 1. Создать тестовые данные
        User::factory()->create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => bcrypt('password123'),
        ]);

        // 2. Отправить GET-запрос к маршруту index
        $response = $this->getJson('/api/user');

        // 3. Убедиться, что запрос выполнен успешно
        $response->assertStatus(200);

        // 4. Проверить, что в данных ответа есть поле "name"
        $response->assertJsonFragment([
            'name' => 'John Doe',
        ]);
    }
}
