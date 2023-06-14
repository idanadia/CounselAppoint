<?php
namespace Database\Seeders;

use App\Models\ChatMessage;
use Illuminate\Database\Seeder;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chat_seeds = [
            [
                'senderId' => 1,
                'receiverId' => 2,
                'message' => 'test messages',
            ],
            [
                'senderId' => 1,
                'receiverId' => 2,
                'message' => 'test messages 2',
            ],
            [
                'senderId' => 1,
                'receiverId' => 2,
                'message' => 'test messages 3',
            ],
            [
                'senderId' => 2,
                'receiverId' => 1,
                'message' => 'test messages 4',
            ],
            [
                'senderId' => 2,
                'receiverId' => 1,
                'message' => 'test messages 5',
            ],
            [
                'senderId' => 3,
                'receiverId' => 2,
                'message' => 'test messages',
            ],
            [
                'senderId' => 3,
                'receiverId' => 2,
                'message' => 'test messages 2',
            ],
        ];

        foreach ($chat_seeds as $chat_seed) {
            ChatMessage::firstOrCreate($chat_seed);
        }
    }
}
