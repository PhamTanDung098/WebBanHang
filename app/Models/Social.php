<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;
    public $table = 'tbl_social';
    protected $primaryKey = 'user_id';
    public $timestamps = false;
    protected $fillable = ['provider_user_id','provider','user'];
    public function Login1(){
        return $this->belongsTo(Login::class,'user','id');
    }
    
}
