<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class profile extends Model
{
    //fields allowed for mass assignment
    protected $fillable = ['user_id', 'first_last_name','country','gender','pic'];

    //relation: profile belongs to a user
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    } 
}
