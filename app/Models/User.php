<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $guarded = false;

    public function notes(){
        return $this->hasMany(Note::class, "user_id", "id");
    }
}
