<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class MenueItemsModel extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $table = 'menu_items';
    
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
        'name', 'description', 'price', 'offer_price', 'menu_id', 'menu_category_id' ,
    ];

    
}
