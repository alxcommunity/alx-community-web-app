<?php

namespace App\Http\Controllers;

use App\Actions\Alxcommunity\Media;
use App\Models\Membership;
use App\Models\Project;
use App\Models\Team;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Laravel\Jetstream\Jetstream;
use Laravel\Jetstream\Role;
use Laravel\Jetstream\Rules\Role as RulesRole;
use Laravel\Jetstream\Team as JetstreamTeam;
use Illuminate\Http\File;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::all();
        return Inertia::render('Teams/Index', ['teams' => $teams]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $team = Team::where('id', $id)->with(['users', 'projects.users'])->first();
        if (Auth::user()) {
            $user = Auth::user();
            $permissions = $user->teamPermissions($team);

        }

        return Inertia::render('Teams/Show', ['team' => $team, 'permissions' => $permissions ?? ""]);
    }

    /**
     * settings for team.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function settings(Request $request, $teamId)
    {
 
        $team = Jetstream::newTeamModel()->findOrFail($teamId);

        Gate::authorize('view', $team);
        return Jetstream::inertia()->render($request, 'Teams/Settings', [
            'team' => $team->load('owner', 'users', 'teamInvitations'),
            'availableRoles' => array_values(Jetstream::$roles),
            'availablePermissions' => Jetstream::$permissions,
            'defaultPermissions' => Jetstream::$defaultPermissions,
            'permissions' => [
                'canAddTeamMembers' => Gate::check('addTeamMember', $team),
                'canDeleteTeam' => Gate::check('delete', $team),
                'canRemoveTeamMembers' => Gate::check('removeTeamMember', $team),
                'canUpdateTeam' => Gate::check('update', $team),
            ],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $user = $request->user();
        $team = Team::find($id);

        Gate::forUser($user)->authorize('update', $team);

        Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string', 'max:255'],
        ])->validateWithBag('updateTeamName');

        $team->forceFill([
            'title' => $request['title'],
            'description' => $request['description'],
        ])->save();

        if($request->file('avatar'))
        {
            Media::create($request->file('avatar'), 'Avatar/Teams', $team);
        }

        return back();
    }

    /** 
     * Request to join team
     * @param  \App\Models\Team $team
     * @return \Illuminate\Http\Response
     */
    
     public function Join(Team $team) {
        $user = Auth()->user();
        $team->users()->attach($user, ['role' => 'data', 'is_accpted' => true]);
        return back();
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
