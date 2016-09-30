<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Client;
use App\Company;
use App\User;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view('admin.client.index',[
            'clients' => Client::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        $companies = Company::Pluck('name', 'id');
        return view('admin.client.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        $this->validate($request, [
            'company_id' => 'required|numeric',
            'name' => 'required|unique:clients|max:255',
        ]);

        $client = Client::create($request->all());

        if ($request->contact_email) {

            $user = User::create([
                'client_id' => $client->id,
                'first_name' => $request->input('contact_first_name'),
                'last_name' => $request->input('contact_last_name'),
                'email' => $request->input('contact_email'),
                'password' => 'ChangeMe1!',
                'remember_token' => str_random(10),
                'note' => 'Client Administrator',
                'active' => 1
            ]);
        }

        return redirect()->route('client.index')
            ->with('success','Client created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $client = Client::find($id);
        return view('admin.client.show',
            compact('client')
        );
    }

    /**
     * Display the specified resource to be edited.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $client = Client::find($id);
        $companies = Company::Pluck('name', 'id');

        return view('admin.client.edit',compact('client','companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'company_id' => 'required|numeric',
            'name' => 'required|max:255',
        ]);

        Client::find($id)->update($request->all());

        return redirect()->route('client.index')
            ->with('success','Client updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Client::find($id)->delete();
        return redirect()->route('client.index')
            ->with('success','Client deleted successfully');
    }
}
