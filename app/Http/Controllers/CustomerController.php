<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;

use View;
use DB;
use File;
use Storage;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('customer.index');
    }

    public function getCustomerAll(Request $request){
        //if ($request->ajax()){
            $customers = Customer::join('users', 'users.user_id', 'customers.user_id')->select('customers.*','users.email')->orderBy('customer_id')->get();
            return response()->json($customers);

            // $customer = Customer::orderBy('customer_id','DESC')->get();
            // return response()->json($customer);
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
            $users->roles = 'Customer';
            $users->save();
            $lastid = DB::getPdo()->lastInsertId();

            $customers = new Customer();
            $customers->title = $request->title;
            $customers->fname = $request->fname;
            $customers->lname = $request->lname;
            $customers->addressline = $request->addressline;
            $customers->town = $request->town;
            $customers->zipcode = $request->zipcode;
            $customers->phone = $request->phone;
            $customers->user_id = $lastid;

            $files = $request->file('uploads');
            $customers->img_path = 'images/'.time().'-'.$files->getClientOriginalName();

            $customers->save();

            $data = array('status' => 'saved');
            Storage::put('public/images/'.time().'-'.$files->getClientOriginalName(), file_get_contents($files));

            return response()->json(["success" => "Customer Created Successfully.", "Customer" => $customers, "status" => 200]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::Find($id);
        return response()->json($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);

        $customer->title = $request->ctitle;
        $customer->lname= $request->clname;
        $customer->fname = $request->cfname;
        $customer->addressline = $request->caddressline;
        $customer->town = $request->ctown;
        $customer->zipcode = $request->czipcode;
        $customer->phone = $request->cphone;

        $customer->save();

        // $files = $request->file('cuploads');
        // $customer->img_path = 'images/'.time().'-'.$files->getClientOriginalName();

        // $customer->save();

        // $data = array('status' => 'saved');
        // Storage::put('public/images/'.time().'-'.$files->getClientOriginalName(), file_get_contents($files));

        return response()->json($customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);

        if (File::exists("storage/".$customer->img_path)) {
            File::delete("storage/".$customer->img_path);
        }

        $customer->delete();

        $data = array('success' =>'deleted','code'=>'200');
        return response()->json($data);
        
    }
}
