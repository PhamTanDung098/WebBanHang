<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public  $table = 'tbl_products';
    public $fillable = ['product_name','category_id','brand_id','product_desc','product_price','product_content','product_image','product_size','product_color','product_status'];
}
