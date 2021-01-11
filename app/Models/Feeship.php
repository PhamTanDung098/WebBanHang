<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use City;
use Province;
use Wards;

class Feeship extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'feeship';
    protected $primaryKey = 'fee_id';
    protected $fillable = ['matp','maqh','maxp','feeship'];
    public function city(){
        return $this->belongsTo('App\Models\City','matp');
    }
    public function province(){
        return $this->belongsTo('App\Models\Province','maqh');
    }
    public function wards(){
        return $this->belongsTo('App\Models\Wards','maxp');
    }
}
