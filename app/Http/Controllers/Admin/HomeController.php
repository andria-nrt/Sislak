<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Mode\User;
use App\Http\Controllers\Controller;
use App\Model\Logs;
use DB;

class HomeController extends Controller
{
    public function dashboard()
    {
    	return view('admin.dashboard');
    }

protected function schedule($schedule)
{
    $schedule->command('backup:run')->daily()->at('06:00');
}



    public function systemlogs()
    {

    	$data["logs"] = Logs::orderBy('id', 'desc')
            ->get();
        return view('admin.systemlogs', $data);

    }

    public function settings()
    {

        $data["settings"] = DB::table('settings')
        ->first();

        return view('admin.settings', $data);

    }

    public function settingsupdate(Request $request)
    {
       
        $inputData = [
            'company_name' => $request->company_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address
        ];


        DB::table('settings')
        ->where('id',1)
        ->update($inputData);

        $data["settings"] = DB::table('settings')
        ->first();

        if($files=$request->file('logo')){

            request()->validate([

                'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            ]);

        $logo_name = time().'.'.request()->logo->getClientOriginalExtension();
        request()->logo->move(public_path('logo'), $logo_name);

            // $logo_name=$files->getClientOriginalName();
            // $files->move('logo',$logo_name);

                DB::table('settings')
                ->where('id',1)
                ->update([
                'logo' => $logo_name
                ]);
        }

        if($files=$request->file('favicon')){

            request()->validate([

                'favicon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            ]);

        $favicon_name = time().'.'.request()->favicon->getClientOriginalExtension();
        request()->favicon->move(public_path('favicon'), $favicon_name);

            // $logo_name=$files->getClientOriginalName();
            // $files->move('logo',$logo_name);

                DB::table('settings')
                ->where('id',1)
                ->update([
                'favicon' => $favicon_name
                ]);
        }

        // if unsuccessful, then redirect back to the login with the form data
        $flashdata = ['class'=>'success', 'message'=>"Settings Update Successfull "];

        return redirect()->back()->with($flashdata);
    }

    
    
    public function backup()
    {

        return view('admin.backup');

    }

    public function backupdownload()
    {


        //ENTER THE RELEVANT INFO BELOW
        $mysqlHostName      = 'localhost';
        $mysqlUserName      = 'root';
        $mysqlPassword      = '';
        $DbName             = 'expert_accounting';
        $backup_name        = "mybackup.sql";
        $tables             = array("users","messages","posts"); //here your tables...

        $connect = new \PDO("mysql:host=$mysqlHostName;dbname=$DbName;charset=utf8", "$mysqlUserName", "$mysqlPassword",array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $get_all_table_query = "SHOW TABLES";
        $statement = $connect->prepare($get_all_table_query);
        $statement->execute();
        $result = $statement->fetchAll();


        $output = '';
        foreach($tables as $table)
        {
         $show_table_query = "SHOW CREATE TABLE " . $table . "";
         $statement = $connect->prepare($show_table_query);
         $statement->execute();
         $show_table_result = $statement->fetchAll();

         foreach($show_table_result as $show_table_row)
         {
          $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
         }
         $select_query = "SELECT * FROM " . $table . "";
         $statement = $connect->prepare($select_query);
         $statement->execute();
         $total_row = $statement->rowCount();

         for($count=0; $count<$total_row; $count++)
         {
          $single_result = $statement->fetch(\PDO::FETCH_ASSOC);
          $table_column_array = array_keys($single_result);
          $table_value_array = array_values($single_result);
          $output .= "\nINSERT INTO $table (";
          $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
          $output .= "'" . implode("','", $table_value_array) . "');\n";
         }
        }
        $file_name = 'database_backup_on_' . date('y-m-d') . '.sql';
        $file_handle = fopen($file_name, 'w+');
        fwrite($file_handle, $output);
        fclose($file_handle);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file_name));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
           header('Pragma: public');
           header('Content-Length: ' . filesize($file_name));
           ob_clean();
           flush();
           readfile($file_name);
           unlink($file_name);
    

    }

    
    public function currency()
    {

        $data["currencies"] = DB::table('currencies')
        ->get();

        $data["currency_setting"] = DB::table('currency_setting')
        ->join('currencies', 'currencies.id', '=', 'currency_setting.currency')
        ->select('currencies.name','currencies.currency_name', 'currency_setting.*')
        ->first();

        

        return view('admin.currency', $data);

    }

    public function showcursymbol(Request $request)
    {
        $cur_id = $request->id;

        $cur_sym = DB::table('currencies')
        ->where('id',$cur_id)
        ->first();

        $html = '<div class="form-group">
                <label for="symbol">Symbol</label>
                <input required="" type="text" class="form-control" id="symbol" name="symbol" placeholder="Enter Symbol" value="'.$cur_sym->currency_symbol.'" required="">
            </div>';
         
        return $html;
    }

    public function showcurtext(Request $request)
    {
        $cur_id = $request->id;

        $cur_sym = DB::table('currencies')
        ->where('id',$cur_id)
        ->first();

        $html = '<div class="form-group">
                <label for="symbol">Currency Text</label>
                <input required="" type="text" class="form-control" id="currency_text" name="currency_text" placeholder="Enter Currency Text" value="'.$cur_sym->currency_code.'" required="">
            </div>';
         
        return $html;
    }



    public function currencyupdate(Request $request)
    {
       
        $inputData = [
            'currency' => $request->currency,
            'symbol' => $request->symbol,
            'currency_text' => $request->currency_text,
            'currency_position' => $request->currency_position
        ];

        DB::table('currency_setting')
        ->where('id',1)
        ->update($inputData);

        $data["currency_setting"] = DB::table('currency_setting')
        ->first();

        // if unsuccessful, then redirect back to the login with the form data
        $flashdata = ['class'=>'success', 'message'=>"Currency Update Successfull "];

        return redirect()->back()->with($flashdata);
    }

    
    
}