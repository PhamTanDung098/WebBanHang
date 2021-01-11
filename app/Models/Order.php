<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $table = 'tbl_orders';
    protected $primaryKey = 'id';
    protected $fillable = ['customer_id','shipping_id','order_status','order_code'];
}
