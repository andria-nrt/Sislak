<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Userrole;

use App\Model\Logs;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["users"] = User::join('user_role', 'users.user_role', '=', 'user_role.id')
            ->select('users.*', 'user_role.role_name')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data["Userrole"] = Userrole::orderBy('id', 'asc')
            ->get();

        return view('admin.users.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'password' => 'required',
            'user_role' => 'required',
            'status' => 'required'
        ]);

        $inputData = [
            'name' => $request->name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'address' => $request->address,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'user_role' => $request->user_role,
            'create_per' => $request->create_per,
            'edit_per' => $request->edit_per,
            'delete_per' => $request->delete_per,
            'report_per' => $request->report_per,
            'admin' => $request->admin,
            'accounts' => $request->accounts,
            'status' => $request->status
        ];
        
        User::create($inputData);

        Logs::add("DESIGNATION", "add", $inputData);

        echo json_encode([
            "status"=>"success",
            "message"=>"DESIGNATION has created successfully"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $data["user"] = User::join('user_role', 'users.user_role', '=', 'user_role.id')
            ->select('users.*', 'user_role.role_name')
            ->find($id);
        $data["Userrole"] = Userrole::orderBy('id', 'asc')
            ->get();
        return view('admin.users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $this->validate($request, [
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'user_role' => 'required',
            'status' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'address' => $request->address,
            'username' => $request->username,
            'user_role' => $request->user_role,
            'create_per' => $request->create_per,
            'edit_per' => $request->edit_per,
            'delete_per' => $request->delete_per,
            'report_per' => $request->report_per,
            'admin' => $request->admin,
            'accounts' => $request->accounts,
            'status' => $request->status
        ];
        if(!empty($request->password)) {
            $data['password'] = bcrypt($request->password);
        }

        Logs::add("DESIGNATION", "edit", $data);

        User::find($id)->update($data);

        echo json_encode([
            "status"=>"success",
            "message"=>"DESIGNATION has updated successfully"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::find($id)->toArray();

        Logs::add("DESIGNATION", "delete", $data);

        User::find($id)->delete();
        echo json_encode([
            "status"=>"success",
            "message"=>"DESIGNATION has updated successfully"
        ]);
    }
}
