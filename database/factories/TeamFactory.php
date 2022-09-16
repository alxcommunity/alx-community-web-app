<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Team::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => 'ALX Communities Team',
            'description' => 'ALX COMMUNITY TEAM We are here to move alx community one step forward this is the team responsible for maintaing and build alx community development tools and we are happy to help the community 🚀🚀',
            'user_id' => 1,
            'personal_team' => false,
        ];
    }
}
