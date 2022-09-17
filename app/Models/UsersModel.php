<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class UsersModel extends Authenticatable
{
    use HasFactory, SoftDeletes, Notifiable, HasRoles;

    // set user permisson
    // https://www.honeybadger.io/blog/user-roles-permissions-in-laravel/
    protected $table = 'users';

    protected $guard_name = 'web';
    
    /**
     * The primary key associated with the table.
     *
     * @var int
     */
    protected $primaryKey = 'id';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email' , 'phone', 'password', 'is_active', 'balance' , 'remember_token'
    ];
}
