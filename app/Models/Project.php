<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = 
    ['title', 'description', 'user_id', 'team_id', 'overview', 'repo'];

    public function team() {
        return $this->belongsTo(Team::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('role');
    }

    public function boards() {
        return $this->hasMany(Board::class);
    }

    public function events() {
        return $this->hasMany(Event::class);
    }
}
