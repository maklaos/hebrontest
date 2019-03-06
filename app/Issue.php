<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model {
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

    /**
     * Get the issue projects
     */
    public function project() {
        return $this->belongsTo('App\Project');
    }
}
