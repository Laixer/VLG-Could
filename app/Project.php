<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Get the phone record associated with the user.
     */
    public function status() {
        return $this->hasOne('App\ProjectStatus', 'id', 'status_id');
    }
}
