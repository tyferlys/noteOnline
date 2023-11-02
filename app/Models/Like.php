<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $primaryKey = ['user_id', 'note_id'];
    public $incrementing = false;

    protected $guarded = false;

    public function user(){
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function note(){
        return $this->belongsTo(Note::class, "note_id" , "id");
    }
}
