<?php

namespace App;

use Auth;
use Portal;
use Illuminate\Database\Eloquent\Model;

class ProjectThread extends Model
{
    /**
     * Get the phone record associated with the user.
     */
    public function resolveUser() {
        $portal = Portal::driver('vlgportal');
        $portal->setToken(Auth::token());

        foreach ($portal->portalUsers()['users'] as $user) {
            if ($this->user_id == $user['id']) {
                return $user['name'] . ' ' . $user['last_name'];
            }
        }

        return "Onbekend";
    }

    /**
     * Get the phone record associated with the user.
     */
    public function project() {
        return $this->hasOne('App\Project', 'id', 'project_id');
    }
}
