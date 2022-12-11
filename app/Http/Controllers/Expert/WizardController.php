<?php


namespace App\Http\Controllers\Expert;

use App\Mode\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Model\AisAccountsConfig;
use App\Model\AisCoaTypes;
use App\Model\AisCoaGeneralLedger;
use App\Model\AisCoaSubsidiaryLedger;
use App\Model\AisSubsidiaryCalculation;
use App\Model\AisVouchers;
use App\Model\AisVoucherDetails;

use App\Model\Logs;
use DB;
use DateTime;
use mysqli;
use Config;
use Artisan;

class WizardController extends Controller
{
    public function install()
    {
    	if(DB::connection()->getDatabaseName())
        {
            return redirect()->route('home');
        } else {
            return view('expert.wizard');
        }
    }

    //Database Check
    public function dbConnection(Request $request)
    {
        $output = [];

		try {
			// Create connection
			$conn = new mysqli($request->db_host, $request->db_user, $request->db_password, $request->db_name);
			// Check connection
			if ($conn->connect_error) {
				$output = [
					'status'=>'error',
					'message'=>'Database connection wrong!'
				];
			} else {
				$result = $conn->query("SHOW TABLES FROM ".$request->db_name);
				if ($result && $result->num_rows>0) {
				    $output = [
						'status'=>'error',
						'message'=>'Database is not empty!'
					];
				} else {
					$output = [
						'status'=>'success',
						'message'=>'Database connection ok!'
					];
				}				
			}
			echo json_encode($output);
		} catch (\Exception $e) {
			$output = [
				'status'=>'error',
				'message'=>'Database connection wrong!'
			];
			echo json_encode($output);
    		exit();
		}
    }

    //Wizard Action
    public function wizardAction(Request $request) {
    	$output = [];
    	$db_host = $request->db_host;
    	$db_user = $request->db_user;
    	$db_password = (!empty($request->db_password)) ? $request->db_password : '';
    	$db_name = $request->db_name;

		try {
			// Create connection
			$conn = new mysqli($db_host, $db_user, $db_password, $db_name);
			// Check connection
			if ($conn->connect_error) {
				$output = [
					'status'=>'error',
					'message'=>'Database connection wrong!'
				];
				echo json_encode($output);
			} else {
				$result = $conn->query("SHOW TABLES FROM ".$db_name);
				if ($result && $result->num_rows>0) {
				    $output = [
						'status'=>'error',
						'message'=>'Database is not empty!'
					];
					echo json_encode($output);
				} else {
					try {
						//Action
						Config::write('database.connections.mysql.host', $db_host);
						Config::write('database.connections.mysql.database', $db_name);
						Config::write('database.connections.mysql.username', $db_user);
						Config::write('database.connections.mysql.password', $db_password);

						Artisan::call('migrate', ['--path' => "database/migrations"]);
	    				Artisan::call('db:seed');

	    				//DB update
	    				DB::table('settings')->update([
	    					"company_name" => $request->company_name,
	    					"phone" => $request->phone,
	    					"email" => $request->email,
	    					"address" => $request->address
	    				]);
	    				DB::table('users')->update([
	    					"name" => $request->user_fullname,
	    					"designation" => $request->user_designation,
	    					"mobile" => $request->phone,
	    					"address" => $request->address,
	    					"email" => $request->email,
	    					"username" => $request->user_username,
	    					"password" => bcrypt($request->user_password)
	    				]);

	    				//Message
						$output = [
							'status'=>'success',
							'message'=>'Installation completed!'
						];
						echo json_encode($output);
					} catch (\Exception $e) {
						$output = [
							'status'=>'error',
							'message'=>$e->getMessage()
						];
						echo json_encode($output);
			    		exit();
					}
				}				
			}
		} catch (\Exception $e) {
			$output = [
				'status'=>'error',
				'message'=>'Database connection wrong!'
			];
			echo json_encode($output);
    		exit();
		}
    }

    


}