<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {
    protected $fillable = [
        'id',
        'name',
        'identifier',
        'description',
        'status',
        'created_on',
        'updated_on',
    ];

    /**
     * Get the project issues
     */
    public function issues() {
        return $this->hasMany('App\Issue');
    }

    /**
     * Get the project comments
     */
    public function comments() {
        return $this->hasMany('App\Comment');
    }
}
