<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Userrole;
use App\Model\Logs;
use Auth;

class UserroleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["datalist"] = Userrole::orderBy('id', 'desc')
            ->get();
        return view('admin.userrole.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.userrole.create');
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
            'role_name' => 'required',
        ]);

        $inputData = [
            'role_name' => $request->role_name
        ];
        
        Userrole::create($inputData);

        Logs::add("User Role Manage", "add", $inputData);

        echo json_encode([
            "status"=>"success",
            "message"=>"User Role has created successfully"
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
        $data["data"] = Userrole::find($id);
        return view('admin.userrole.edit', $data);
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
            'role_name' => 'required'
        ]);

        $data = [
            'role_name' => $request->role_name
        ];

        Logs::add("User Role Manage", "edit", $data);

        Userrole::find($id)->update($data);

        echo json_encode([
            "status"=>"success",
            "message"=>"User Role has updated successfully"
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
        $data = Userrole::find($id)->toArray();

        Logs::add("User Role Manage", "delete", $data);

        Userrole::find($id)->delete();
        echo json_encode([
            "status"=>"success",
            "message"=>"User Role has updated successfully"
        ]);
    }
}
