<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class UsersSubscriptionsModel extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $table = 'users_subscriptions';
    
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
        'user_id', 'package_id' , 'amount', 'transaction_id', 'recurringId', 'start_date', 'end_date'
    ];
}
