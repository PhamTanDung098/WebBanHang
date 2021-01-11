<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    public $table = 'tbl_admin';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['admin_email','admin_password','admin_name','admin_phone'];
}
