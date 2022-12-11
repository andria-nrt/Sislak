<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class AisVouchers extends Model
{
    public $timestamps = false;
    protected $table = "ais_vouchers";
    protected $guarded = ['id'];

    
}
