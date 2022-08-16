<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class RestrantsModel extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $table = 'restrants';
    
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
        'name', 'message' , 'address', 'phone', 'latitude', 'longitude', 'user_id',
        'orders_allow', 'payment_allow', 'payment_token', 'whatsapp_number',
        'allow_whatsapp_orders', 'wahtsapp_message_body'
    ];
}
