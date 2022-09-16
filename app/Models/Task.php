<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'board_id', 'user_id'];    
    
    public function board() {
        return $this->belongsTo(Board::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => (new Carbon($value))->diffForHumans()
        );
    }
}
