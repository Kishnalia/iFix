<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;

use View;
use DB;
use File;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('employee.index');
    }

    public function getEmployeeAll(Request $request){
        //if ($request->ajax()){
            $employees = Employee::join('users', 'users.user_id', 'employees.user_id')->select('employees.*','users.email')->orderBy('employee_id')->get();
            return response()->json($employees);
         //}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $users = new User();
            $users->email = $request->email;
            $users->password = bcrypt($request->password);
            // $users->roles = 'Customer';
            $users->roles =  $request->roles;
            $users->save();
            $lastid = DB::getPdo()->lastInsertId();

            $employees = new Employee();
            $employees->title = $request->title;
            $employees->fname = $request->fname;
            $employees->lname = $request->lname;
            $employees->addressline = $request->addressline;
            $employees->town = $request->town;
            $employees->zipcode = $request->zipcode;
            $employees->phone = $request->phone;
            $employees->user_id = $lastid;

            $files = $request->file('uploads');
            $employees->img_path = 'images/'.time().'-'.$files->getClientOriginalName();

            $employees->save();

            $data = array('status' => 'saved');
            Storage::put('public/images/'.time().'-'.$files->getClientOriginalName(), file_get_contents($files));

            return response()->json(["success" => "Customer Created Successfully.", "Employee" => $employees, "status" => 200]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employees = Employee::Find($id);
        return response()->json($employees);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employees = Employee::find($id);

        $employees->title = $request->etitle;
        $employees->lname= $request->elname;
        $employees->fname = $request->efname;
        $employees->addressline = $request->eaddressline;
        $employees->town = $request->etown;
        $employees->zipcode = $request->ezipcode;
        $employees->phone = $request->ephone;

        $employees->save();

        // $files = $request->file('cuploads');
        // $employees->img_path = 'images/'.time().'-'.$files->getClientOriginalName();

        // $employees->save();

        // $data = array('status' => 'saved');
        // Storage::put('public/images/'.time().'-'.$files->getClientOriginalName(), file_get_contents($files));

        return response()->json($employees);








    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employees = Employee::findOrFail($id);

        if (File::exists("storage/".$employees->img_path)) {
            File::delete("storage/".$employees->img_path);
        }

        $employees->delete();

        $data = array('success' =>'deleted','code'=>'200');
        return response()->json($data);
        
    }
}
