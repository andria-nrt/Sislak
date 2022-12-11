<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Userrole extends Model
{
    public $timestamps = false;
    protected $table = "user_role";
    protected $guarded = ['id'];

}