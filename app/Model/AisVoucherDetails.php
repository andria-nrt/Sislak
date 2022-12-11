<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class AisVoucherDetails extends Model
{
    public $timestamps = false;
    protected $table = "ais_voucher_details";
    protected $guarded = ['id'];

    
}
