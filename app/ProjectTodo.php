<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectTodo extends Model
{
    /**
     * Get the phone record associated with the user.
     */
    public function report() {
        return $this->hasOne('App\Report', 'todo_id', 'id');
    }
}
