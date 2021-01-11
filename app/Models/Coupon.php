<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $table = 'tbl_coupon';
    protected $primaryKey = 'coupon_id';
    protected $fillable = ['coupon_name','coupon_code','coupon_times','coupon_function','coupon_codition'];

}
