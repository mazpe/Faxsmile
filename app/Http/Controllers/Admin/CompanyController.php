<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Company;
use Illuminate\Http\Request;
//use App\Providers\FormServiceProvider;

class CompanyController extends Controller
{
    /**
     * Show companies
     *
     * @return Response
     */
    public function index() {
        return view('admin.company.index',[
            'companies' => Company::all()
        ]);
    }

    /**
     * Show the form to create a new company
     *
     * @return Response
     */
    public function create() {
        return view('admin.company.show');
    }

    /**
     * Store a new company
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'type' => 'required',
            'name' => 'required|unique:companies|max:255',
        ]);

        Company::create($request->all());

        return redirect()->route('company.index')
            ->with('success','Product created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $company= Company::find($id);
        return view('admin.company.show',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'type' => 'required',
            'name' => 'required|unique:companies|max:255',
        ]);
        Company::find($id)->update($request->all());
        return redirect()->route('company.index')
            ->with('success','Company updated successfully');
    }
}
