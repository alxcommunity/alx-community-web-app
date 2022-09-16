<?php

namespace App\Actions\Fortify;

use App\Actions\Alxcommunity\Media;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Events\AddingTeamMember;
use Laravel\Jetstream\Events\TeamMemberAdded;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'github_username' => ['required', 'string', 'max:255', 'unique:users'],
            'linkedin_url' => ['nullable', 'string', 'max:255'],
            'profile_picture' => ['nullable', 'string', 'max:2048'],
            'nickname' => ['nullable', 'string', 'max:255'],
            'twitter_username' => ['nullable', 'string', 'max:255'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'github_username' => $input['github_username'],
                'linkedin_url' => $input['linkedin_url'],
                'profile_photo_path' => $input['profile_picture'],
                'nickname' => $input['nickname'],
                'twitter_username' => $input['twitter_username'],
                'password' => Hash::make($input['password']),
            ]), function (User $user) {
                $this->createTeam($user);
                $this->createAvatar($user);
            });
        });
    }

    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user)
    {
        $team = Team::find(1);
        AddingTeamMember::dispatch($team, $user);

        $team->users()->attach(
            $user, ['role' => 'member']
        );
        TeamMemberAdded::dispatch($team, $user);

    }

    protected function createAvatar(User $user) {
        if ($user && !$user['profile_photo_path']) return;
        Media::create($user['profile_photo_path'], 'Avatar/Users', $user, true);
    }
}
