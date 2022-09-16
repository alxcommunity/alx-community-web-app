<?php

namespace App\Providers;

use App\Actions\Jetstream\AddTeamMember;
use App\Actions\Jetstream\CreateTeam;
use App\Actions\Jetstream\DeleteTeam;
use App\Actions\Jetstream\DeleteUser;
use App\Actions\Jetstream\InviteTeamMember;
use App\Actions\Jetstream\RemoveTeamMember;
use App\Actions\Jetstream\UpdateTeamName;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePermissions();

        Jetstream::createTeamsUsing(CreateTeam::class);
        Jetstream::updateTeamNamesUsing(UpdateTeamName::class);
        Jetstream::addTeamMembersUsing(AddTeamMember::class);
        Jetstream::inviteTeamMembersUsing(InviteTeamMember::class);
        Jetstream::removeTeamMembersUsing(RemoveTeamMember::class);
        Jetstream::deleteTeamsUsing(DeleteTeam::class);
        Jetstream::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the roles and permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::role('admin', 'Administrator', [
            'read_projects',
            'create_project',
            'change_info',
            'invite_users',
            'accept_reject_users',
            'delete_project',
        ])->description('Administrator users can perform any action.');

        Jetstream::role('dev', 'Developer', [
            'read_project',
            'create_project',
            'change_info',
            'invite_users',
            'delete_project',
            'update_project',
        ])->description('Developer users have the ability to read, create, and update.');

        Jetstream::role('member', 'Member', [
            'read_project',
        ])->description('Member users have the ability to read project.');

        Jetstream::role('project dev', 'Project developer', [
            'read_project',
            'update_project',
            'create_board',
            'update_board',
            'edit_board',
            'delete_board',
            'create_task',
            'update_task',
            'delete_task',
            'access_github'
        ])->description('project developer users have the ability to read project.');
    }
}
