<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class AisCoaTypes extends Model
{
    public $timestamps = false;
    protected $table = "ais_coa_types";
    protected $guarded = ['id'];

    
}
