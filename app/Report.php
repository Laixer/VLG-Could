<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    /**
     * Get the phone record associated with the user.
     */
    public function project() {
        return $this->hasOne('App\Project', 'id', 'project_id');
    }
}
