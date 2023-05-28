<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Board;
use App\Models\Card;
use App\Models\CardList;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create(['email' => 'kozykorpesh.tolep@gmail.com', 'password' => bcrypt('secret')]);
        $boards = Board::factory(10)->create();

        foreach ($boards as $board){
            $cardList = CardList::factory()->create([
                'board_id' => $board->id,
                'user_id' => $user->id,
            ]);

            Card::factory(50)->create([
                'board_id' => $board->id,
                'user_id' => $user->id,
                'card_list_id' => $cardList->id
            ]);
        }
    }
}
