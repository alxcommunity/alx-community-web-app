<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Jetstream\Jetstream;
use Laravel\Jetstream\OwnerRole;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'email', 'password',
        'github_username',
        'linkedin_url',
        'profile_photo_path',
        'nickname',
        'twitter_username',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function hasTeams()
    {
        return $this->allTeams()->isNotEmpty();
    }

    public function project()
    {
        return $this->belongsToMany(Project::class, 'project_user')->withPivot('role');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_user')->withPivot('role');;
    }

    public function currentTeam()
    {
        if (is_null($this->current_team_id) && $this->id) {
            $this->switchTeam($this->allTeams()->first());
        }
        return $this->belongsTo(Jetstream::teamModel(), 'current_team_id');
    }

    /**
     * Determine if the user belongs to the given team.
     *
     * @param  mixed  $team
     * @return bool
     */
    public function belongsToTeam($team)
    {
 
        $data = $team::class === "App\Models\Team" ? $this->teams : $this->project;
        return $data->contains(function ($t) use ($team) {
           
            return $t->id === $team->id;
        }) || $this->ownsTeam($team);
    }

     /**
     * Get the role that the user has on the team.
     *
     * @param  mixed  $team
     * @return \Laravel\Jetstream\Role|null
     */
    public function teamRole($team)
    {
        if ($this->ownsTeam($team)) {
            return new OwnerRole;
        }

        
        if (! $this->belongsToTeam($team)) {
            return;
        }
       
        $role = $team->users
            ->where('id', $this->id)
            ->first()
            ->pivot
            ->role;
        return $role ? Jetstream::findRole($role) : null;
    }

    
    

   
}
