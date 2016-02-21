<?php

namespace App;

use Portal;
use Auth;
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
    public function field() {
        return $this->hasOne('App\ProjectField', 'id', 'field_id');
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

    /**
     * Get the phone record associated with the user.
     */
    public function todo() {
        return $this->hasMany('App\ProjectTodo');
    }

    /**
     * Get the phone record associated with the user.
     */
    public function audit() {
        return $this->hasMany('App\Audit');
    }

    /**
     * Get the phone record associated with the user.
     */
    public function resolveOwner() {
        $portal = Portal::driver('vlgportal');
        $portal->setToken(Auth::token());

        foreach ($portal->portalUsers()['users'] as $user) {
            if ($this->owner_user_id == $user['id']) {
                return $user['name'] . ' ' . $user['last_name'];
            }
        }

        return "Onbekend";
    }

    /**
     * Get the phone record associated with the user.
     */
    public function resolveClient() {
        $portal = Portal::driver('vlgportal');
        $portal->setToken(Auth::token());

        foreach ($portal->portalCompanies()['companies'] as $company) {
            if ($this->client_company_id == $company['id']) {
                return $company['name'];
            }
        }

        return "Onbekend";
    }

    /**
     * Get the phone record associated with the user.
     */
    public function resolveInvolved() {
        $arr = [];
        foreach ($this->thread()->get() as $user) {
            $username = $user->resolveUser();
            if (!in_array($username, $arr))
                array_push($arr, $user->resolveUser());
        }

        return $arr;
    }

    /**
     * Get the phone record associated with the user.
     */
    public function todoAvailableForAttach() {
        $used = $this->reports()->whereNotNull('todo_id')->select('todo_id')->get()->toArray();
        return $this->todo()->whereNotIn('id', $used);
    }

    public function loadDefaultTodo() {
        $todo = new ProjectTodo;
        $todo->message = 'Bestek (met opbouw van asfalt) ';
        $todo->project_id = $this->id;
        $todo->save();

        $todo = new ProjectTodo;
        $todo->message = 'Laagopbouw asfaltcilinder met de mengselcode';
        $todo->project_id = $this->id;
        $todo->save();

        $todo = new ProjectTodo;
        $todo->message = 'Laagdikte';
        $todo->project_id = $this->id;
        $todo->save();

        $todo = new ProjectTodo;
        $todo->message = 'Aantal m2 totaal project';
        $todo->project_id = $this->id;
        $todo->save();

        $todo = new ProjectTodo;
        $todo->message = 'CE-bladen';
        $todo->project_id = $this->id;
        $todo->save();

        $todo = new ProjectTodo;
        $todo->message = 'Streefdichtheid';
        $todo->project_id = $this->id;
        $todo->save();

        $todo = new ProjectTodo;
        $todo->message = 'Refenrentie samenstelling';
        $todo->project_id = $this->id;
        $todo->save();
    }
}
