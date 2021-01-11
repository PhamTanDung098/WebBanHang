<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_Product extends Model
{
    use HasFactory;
    public $table = 'tbl_category_product';
    public $fillable = ['category_name','category_desc','category_status','created_at','updated_at'];
}
