<?php

namespace App;

use Auth;
use Portal;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{

    public function __construct($action = null, $project_id = null)
    {
        if ($action)
            $this->action = $action;

        if ($project_id)
            $this->project_id = $project_id;

        if (Auth::check())
            $this->user_id = Auth::id();
    }

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

}
