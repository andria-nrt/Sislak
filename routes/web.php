<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Wizard
Route::get('install', 'Expert\WizardController@install')->name('install');
Route::post('db-connection', 'Expert\WizardController@dbConnection')->name('dbConnection');
Route::post('wizard-action', 'Expert\WizardController@wizardAction')->name('wizardAction');

//Work-Start
Route::group(['middleware'=>'dbWizard'], function () {

    Route::get('login', 'Expert\HomeController@login')->name('login');
    Route::post('login', 'Expert\HomeController@loginAction')->name('login');
    Route::get('logout', 'Expert\HomeController@logout')->name('logout');

    Route::group(['middleware'=>'userAuth'], function () {
    Route::get('/', 'Expert\HomeController@app')->name('home');

    	//Admin
    	Route::group(['as'=>'Admin.', 'prefix'=>'admin', 'namespace'=>'Admin'], function () {
        	Route::get('dashboard', 'HomeController@dashboard')->name('dashboard');
        	Route::resource('userrole', 'UserroleController');
        	Route::resource('usermanage', 'UserController');
        	Route::get('systemlogs', 'HomeController@systemlogs')->name('systemlogs');
        	Route::get('settings', 'HomeController@settings')->name('settings');
        	Route::post('settingsupdate', 'HomeController@settingsupdate')->name('settingsupdate');

            Route::get('currency', 'HomeController@currency')->name('currency');
            Route::get('showcursymbol', 'HomeController@showcursymbol')->name('showcursymbol');
            Route::get('showcurtext', 'HomeController@showcurtext')->name('showcurtext');
            Route::post('currencyupdate', 'HomeController@currencyupdate')->name('currencyupdate');
                
                
            Route::get('profileupdate', 'UpdateUserController@profileupdate')->name('profileupdate');
            Route::post('updateuser', 'UpdateUserController@updateuser')->name('updateuser');

            Route::get('changepassword', 'UpdateUserController@changepassword')->name('changepassword');
            Route::post('updateuserpass', 'UpdateUserController@updateuserpass')->name('updateuserpass');

            // Route::get('backup', 'HomeController@backup')->name('backup');
            // Route::get('backupdownload', 'HomeController@schedule')->name('backupdownload');

        // Backup routes
            Route::get('backup', 'BackupController@index');
            Route::get('backup/create', 'BackupController@create');
            //Route::get('backup/download/{file_name}', 'BackupController@download');
            Route::get('backup/backup-download/{file_name}', 'BackupController@download');
            Route::get('backup/delete/{file_name}', 'BackupController@delete');
            

    	});

    	
        //Accounts
        Route::group(['as'=>'Accounts.', 'prefix'=>'accounts', 'namespace'=>'Accounts'], function () {
            Route::get('dashboard', 'HomeController@dashboard')->name('dashboard');


            Route::get('chart_of_accounts', 'ChartOfAccountsController@index');
            Route::get('account_types', 'ChartOfAccountsController@accountTypes');
    		
    		Route::resource('general_ledger', 'GeneralLedgerController');
            Route::get('general_ledger_code', 'GeneralLedgerController@generalLedgerCode');

            Route::resource('subsidiary_ledger', 'SubsidiaryLedgerController');
            Route::get('subsidiary_ledger_code', 'SubsidiaryLedgerController@subsidiaryLedgerCode');

            Route::resource('payment_voucher', 'PaymentVoucherController');
            Route::resource('receive_voucher', 'ReceiveVoucherController');
            Route::resource('journal_voucher', 'JournalVoucherController');
            Route::resource('contra_voucher', 'ContraVoucherController');

            //Reports

            Route::get('balance_sheet', 'ReportController@balanceSheet');
            Route::get('balance_sheet/report', 'ReportController@balanceSheetReport')->name('balanceSheet');
            
            Route::get('income_statement', 'ReportController@incomeStatement');
            Route::get('income_statement/report', 'ReportController@incomeStatementReport')->name('incomeStatement');
            
            Route::get('receipts_payments', 'ReportController@receiptsPayments');
            Route::get('receipts_payments/report', 'ReportController@receiptsPaymentsReport')->name('receiptsPayments');
            
            Route::get('trial_balance', 'ReportController@trialBalance');
            Route::get('trial_balance/report', 'ReportController@trialBalanceReport')->name('trialBalance');
            
            Route::get('ledger_report', 'ReportController@ledgerReport');
            Route::get('gl_slLedger', 'ReportController@gl_slLedger')->name('gl_slLedger');
            Route::get('cash_book', 'ReportController@cashBook');
            Route::get('bank_book', 'ReportController@bankBook');
            Route::get('ledger_report/report', 'ReportController@ledgerReportView')->name('ledgerReport');

            Route::get('head_configuration', 'ConfigController@head_configuration')->name('headConfig');
            Route::post('head_configuration/update', 'ConfigController@head_configuration_update')->name('headConfigUpdate');

            Route::resource('migration', 'MigrationController');
    		
        });

    });

});