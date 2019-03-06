<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'project_id',
        'user_id',
        'comment',
    ];

    /**
     * Get the user
     */
    public function user() {
        return $this->belongsTo('App\User');
    }
}
