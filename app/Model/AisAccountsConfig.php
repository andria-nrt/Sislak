<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class AisAccountsConfig extends Model
{
    public $timestamps = false;
    protected $table = "ais_accounts_config";
    protected $guarded = ['id'];

    
}
