<?php

namespace Database\Seeders;

use App\Actions\Alxcommunity\Media;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    protected $avatarUrl = 'https://alx-intranet.hbtn.io/assets/holberton-logo-full-alx-d053727941512ebe04b797ca87d81a195004e9ff2d8a6aedf4004c5365cf8944.png';


    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::factory(1)->create();
        $team = \App\Models\Team::factory(1)->create();

        Media::create($this->avatarUrl, 'Avatar/Users', $user[0], true);
        Media::create($this->avatarUrl, 'Avatar/Teams', $team[0], true);
    }
}
