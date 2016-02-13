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
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function getNameAsPath()
    {
        return strtolower(str_replace(' ', '_', $this->name));
    }

    /**
     * Get the phone record associated with the user.
     */
    public function status() {
        return $this->hasOne('App\ProjectStatus', 'id', 'status_id');
    }

    /**
     * Get the phone record associated with the user.
     */
    public function reports() {
        return $this->hasMany('App\Report');
    }

    /**
     * Get the phone record associated with the user.
     */
    public function thread() {
        return $this->hasMany('App\ProjectThread');
    }
}
