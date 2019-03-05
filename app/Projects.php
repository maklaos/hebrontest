<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model {
    protected $fillable = [
        'id',
        'name',
        'identifier',
        'description',
        'status',
        'created_on',
        'updated_on',
    ];
}
