<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Logs extends Model
{
    public $timestamps = false;
    protected $table = "system_logs";
    protected $guarded = ['id'];

    public static function add($table, $action, $changes) {
        switch($action) {
            case 'add':
                $action = "Add New Data";
                break;
            case 'edit':
                $action = "Update Data";
                break;
            case 'delete':
                $action = "Delete Data";
                break;
        }

        date_default_timezone_set('Asia/Dhaka'); 
        $date_time = date("Y-m-d H:i:s"); 
        $user = Auth::user();
        self::create([
            'date_time' => $date_time,
            'user_id' => $user->id,
            'user_name' => $user->name,
            'table' => $table,
            'action' => $action,
            'changes' => implode(", ", $changes)
        ]);
    }
}
