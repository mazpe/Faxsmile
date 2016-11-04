<?php

namespace App\Http\Controllers\Admin\Client;

use App\Client;
use App\Company;
use App\Provider;
use App\EmailConfig;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;



class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request, $id)
    {
//        $this->authorize('create', EmailConfig::class);

        $this->validate($request, [
//            'provider_id' => 'required|numeric',
//            'company_id' => 'required|numeric',
            'client_id' => 'required|numeric',
            'from_email' => 'required'
        ]);

        EmailConfig::create($request->all());

        return redirect()->route('client.show', ['client_id' => $id])
            ->with('success','Client settings updated successfully');
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
    public function edit($client_id)
    {
        $providers = Provider::Pluck('name', 'id');
        $companies = Company::pluck('name', 'id');
        $clients = Client::pluck('name', 'id');

        $client = Client::find($client_id);
        $settings = EmailConfig::where('client_id',$client_id)->first();

        return view('admin.client.settings.edit',compact('client','settings', 'providers', 'companies', 'clients'));
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
        $emailConfig = EmailConfig::where('client_id',$id);

//        $this->authorize('update', $emailConfig);

        $this->validate($request, [
            'client_id' => 'required|numeric',
            'from_email' => 'required'
        ]);

        $emailConfig->update($request->except(['_method','_token']));

        return redirect()->route('client.show', ['client_id' => $id])
            ->with('success','Client settings updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
