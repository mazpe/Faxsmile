<?php

namespace App\Http\Controllers\Admin\Company;

use App\Company;
use App\Provider;
use App\Setting;

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
//        $this->authorize('create', Setting::class);

        $this->validate($request, [
//            'provider_id' => 'required|numeric',
//            'company_id' => 'required|numeric',
            'entity_id' => 'required|numeric',
            'from_email' => 'required'
        ]);

        Setting::create($request->all());

        return redirect()->route('company.show', ['company_id' => $id])
            ->with('success','Company settings updated successfully');
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
    public function edit($company_id)
    {
        $company = Company::find($company_id);
        $settings = Setting::where('entity_id',$company_id)->first();

        return view('admin.company.settings.edit',compact('company','settings'));
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
        $setting = Setting::where('entity_id',$id);

//        $this->authorize('update', $setting);

        $this->validate($request, [
            'entity_id' => 'required|numeric',
            'from_email' => 'required'
        ]);

        $setting->update($request->except(['_method','_token']));

        return redirect()->route('company.show', ['company_id' => $id])
            ->with('success','Company settings updated successfully');
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
