<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomersPaymentsModel extends Model
{
    
    use HasFactory , SoftDeletes;

    protected $table = 'customerspayments';
    
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
        'invoiceStatus', 'order_id', 'amount', 'paymentGateway',
        'paymentId', 'transactionStatus', 'currency', 'cardNumber', 'error'
    ];


}
