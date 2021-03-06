<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Devices;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $devices = Devices::all();
        return response()->json([
            'devices'=> $devices
        ]);

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
        // Validate data
        $request->validate([
            'uuid'   => 'required',
            'name'   => 'required',
            'code'   => 'required',
            'status' => 'required'
        ]);

        // Create data
        $devices = new Devices([
            'uuid'        => $request->get('uuid'),
            'name'        => $request->get('name'),
            'description' => $request->get('description'),
            'status'      => $request->get('status'),
            'code'        => $request->get('code')
        ]);
        $devices->save();
        return response()->json([
            'devices' => $devices,
            'message' => 'created'
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
        //
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
         // Validate data
         $request->validate([
            'uuid'   => 'required',
            'name'   => 'required',
            'code'   => 'required',
            'status' => 'required'
        ]);

        $devices = Devices::find($id);
        $devices->uuid =  $request->get('uuid');
        $devices->name = $request->get('name');
        $devices->description = $request->get('description');
        $devices->status = $request->get('status');
        $devices->code = $request->get('code');
        $devices->save();

        return response()->json([
            'devices' => $devices,
            'message' => 'updated'
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
        $devices = Devices::find($id);
        $devices->delete();

        return response()->json([
            'devices' => $devices,
            'message' => 'deleted'
        ]);
    }
}
