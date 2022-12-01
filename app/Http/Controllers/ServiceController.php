<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use View;
use Storage;
use DB;
use File;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('service.index');
    }
 
    public function getAllService(Request $request){
            $service = Service::orderBy('service_id','DESC')->get();
            return response()->json($service);
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
        $service = new Service;
        $service->description = $request->description;
        $service->price= $request->price;

        $files = $request->file('uploads');
        $service->img_path = 'images/'.time().'-'.$files->getClientOriginalName();
        
        $service->save();

        $data = array('status' => 'saved');
        Storage::put('public/images/'.time().'-'.$files->getClientOriginalName(), file_get_contents($files));

        return response()->json(["success" => "Service Created Successfully.","service" => $service ,"status" => 200]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::find($id);
        return response()->json($service);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $service = Service::find($id);
        // $service = $service->update($request->all());

        // $service = Service::find($id);
        // return response()->json($service);


        $service = Service::find($id);

        $service->description = $request->sdescription;
        $service->price = $request->sprice;

        $service->save();

        return response()->json($service);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return response()->json(["success" => "Service deleted successfully.","status" => 200]);
    }
}
