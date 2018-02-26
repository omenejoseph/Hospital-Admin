<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_doc', 'dept_id', 'highest_qual', 'has_query', 'is_admin', 'photo_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function roles(){
        return $this->belongsToMany('App\Role');
    }

    public function dept(){
        return $this->belongsTo('App\Dept');
    }

    public function photo(){
        return $this->belongsTo('App\Photo');
    }

    

        /**
        * @param string|array $roles
        */
    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
             return $this->hasAnyRole($roles) || 
             abort(401, 'This action is unauthorized.');
        }
            return $this->hasRole($roles) || 
            abort(401, 'This action is unauthorized.');
    }
        /**
        * Check multiple roles
        * @param array $roles
        */
    public function hasAnyRole($roles)
    {
         return null !== $this->roles()->whereIn('name', $roles)->first();
    }
    /**
    * Check one role
    * @param string $role
    */
    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }   
}
