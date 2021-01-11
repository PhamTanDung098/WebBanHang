<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_details extends Model
{
    use HasFactory;
    public $table = 'tbl_order_details';
    protected $fillable = ['order_code','product_id','product_name','product_price','product_sale_quatity','order_code','product_feeship','product_coupon'];
    protected $primaryKey ='id';
}
