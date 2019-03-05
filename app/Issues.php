<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issues extends Model {
    protected $fillable = [
        'id',
        'project_id',
        'assigned_to',
        'author',
        'description',
        'subject',
        'done_ratio',
        'estimated_hours',
        'priority',
        'status',
        'tracker',
        'start_date',
        'closed_on',
        'created_on',
        'updated_on',
    ];
}
