<?php

namespace App\Models;

use App\Actions\Alxcommunity\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Jetstream\Events\TeamCreated;
use Laravel\Jetstream\Events\TeamDeleted;
use Laravel\Jetstream\Events\TeamUpdated;
use Laravel\Jetstream\Team as JetstreamTeam;

class Team extends JetstreamTeam
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'personal_team' => 'boolean',
    ];
    protected $appends = ['avatar'];
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'description',
        'personal_team',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => TeamCreated::class,
        'updated' => TeamUpdated::class,
        'deleted' => TeamDeleted::class,
    ];

    public function getAvatarAttribute() {
        if($avatar = $this->avatar()->get('path')->last()) {
            
            return asset('uploads/'.$avatar->path);
        }

        else return 'https://ui-avatars.com/api/?name='.$this->title;
    }
    public function projects() {
        return $this->hasMany(Project::class);
    }

    public function avatar() {
        return $this->morphMany('App\Models\Media', 'mediaable');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'team_user')->withPivot('role');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
